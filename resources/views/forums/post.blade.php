@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ql-render.css') }}">
@endpush

<x-layout title="{{ $title }}" lang="{{ $locale }}">
    {{-- horrible hack --}}
    <x-forums.layout :pinned-posts="$pinnedPosts" header="
        <div class='d-flex justify-content-between align-items-center'>
            <span class='font-serif'>{{ $post->forum->faculty->name() }}</span>
            <a class='btn btn-aabu px-4 rounded-0' href='{{ getLocaleURL('/forums/' . $post->forum->id) }}'>{{ __('common.back') }}</a>
        </div>
    ">
        @if(session('success-pin'))
            <div class="alert alert-success rounded-0 fw-semibold">
                {{ session('success-pin') }}
            </div>
        @endif

        {{-- post --}}
        <div class="forum-list-card bg-body-tertiary px-3 py-2 mb-3">
            {{-- post title and pfp --}}
            <div class="mb-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset($post->user->getProfilePicture()) }}" class="pfp-75 rounded" alt="Profile Picture">
                    <h2 class="font-serif mb-0">{{ $post->title }}</h2>
                </div>
                <div class="d-flex gap-2 text-body-secondary align-items-center">
                    <div>{{ __('common.by') }} <a href="{{ getLocaleURL('/users/' . $post->user->id) }}">{{ $post->user->username }}</a></div>
                    <div title="{{ $post->created_at->toDayDateTimeString() }}">- {{ $post->created_at->diffForHumans() }}</div>
                    @can('delete-forum-post', $post)
                        <x-delete-button action="{{ '/forums/' . $post->forum->id . '/posts/' . $post->id }}" />
                    @endcan

                    @canany(['admin', 'moderator'])
                        <form action="{{ '/forums/' . $post->forum->id . '/posts/' . $post->id . '/pin' }}" method="POST">
                            @csrf
                            <button class="btn p-0 text-info-emphasis" type="submit"><i class="bi-pin-angle fs-5"></i> {{ $post->pinned ? 'Unpin' : 'Pin' }}</button>
                        </form>
                    @endcanany
                </div>
            </div>
            {{-- post content --}}
            <div class="post-content p-0">{!! $post->content !!}</div>
        </div>

        <h3>{{ $post->comments->count() . ' ' .  __('common.comments')}}</h3>
        {{-- comment form --}}
        @auth
            <div class="forum-list-card bg-body-tertiary px-3 py-2 mb-3">
                <form class="position-relative" action="{{ '/forums/' . $forum->id . '/posts/' . $post->id . '/comment' }}" method="POST">
                    @csrf
                    <textarea class="form-control fs-5" name="content" placeholder="{{ __('common.placeholder_thoughts') }}" required
                        oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';" style="overflow: hidden; resize: none; padding-bottom: 40px;"></textarea>
                    <button type="submit" class="btn btn-sm btn-aabu px-5 rounded-0 position-absolute bottom-0 end-0 me-2 mb-2">
                        {{ __('common.post_verb') }}
                    </button>
                </form>
            </div>
        @endauth

        {{-- comments container --}}
        <div>
            @foreach($post->comments->sortDesc() as $comment)
                <x-forums.comment :comment="$comment"/>
            @endforeach
        </div>
    </x-forums.layout>
</x-layout>
