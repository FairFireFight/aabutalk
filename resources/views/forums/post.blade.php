@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ql-render.css') }}">
@endpush

<x-layout title="{{ $title }}" lang="{{ $locale }}">
    {{-- horrible hack --}}
    <x-forums.layout header="
        <div class='d-flex justify-content-between align-items-center'>
            <span class='font-serif'>{{ $post->forum->faculty->name() }}</span>
            <a class='btn btn-aabu px-4 rounded-pill' href='{{ getLocaleURL('/forums/' . $post->forum->id) }}'>Back</a>
        </div>
    ">
        {{-- post --}}
        <div class="forum-list-card bg-body-tertiary px-3 py-2 mb-3">
            {{-- post title and pfp --}}
            <div class="mb-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="https://placehold.co/200x200" class="pfp-75 rounded" alt="Profile Picture">
                    <h2 class="font-serif mb-0">{{ $post->title }}</h2>
                </div>
                <div class="d-flex gap-2 text-body-secondary align-items-center">
                    <div>{{ __('common.by') }} <a href="#">{{ $post->user->username }}</a></div>
                    <div title="{{ $post->created_at->toDayDateTimeString() }}">- {{ $post->created_at->diffForHumans() }}</div>
                    @can('delete-forum-post', $post)
                        <x-delete-button action="{{ '/forums/' . $post->forum->id . '/posts/' . $post->id }}" />
                    @endcan
                </div>
            </div>
            {{-- post content --}}
            <div class="post-content ql-editor p-0">{!! $post->content !!}</div>
        </div>

        {{-- comment form --}}
        @auth
            <div class="forum-list-card bg-body-tertiary px-3 py-2 mb-2">
                <form class="position-relative" action="{{ '/forums/' . $forum->id . '/posts/' . $post->id . '/comment' }}" method="POST">
                    @csrf
                    <textarea class="form-control fs-5" name="content" placeholder="{{ __('common.placeholder_thoughts') }}" required
                        oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';" style="overflow: hidden; resize: none; padding-bottom: 40px;"></textarea>
                    <button type="submit" class="btn btn-sm btn-aabu px-5 rounded-pill position-absolute bottom-0 end-0 me-2 mb-2">
                        {{ __('common.post_verb') }}
                    </button>
                </form>
            </div>
        @endauth

        {{-- comments --}}
        <div>
            <h3>{{ $post->comments->count() . ' ' .  __('common.comments')}}</h3>
            {{-- container --}}
            <div>
                @foreach($post->comments->sortDesc() as $comment)
                    <x-forums.comment :comment="$comment"/>
                @endforeach
            </div>
        </div>
    </x-forums.layout>
</x-layout>
