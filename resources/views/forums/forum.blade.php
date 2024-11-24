<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <x-forums.layout header="{{ $forum->faculty->name() }}" :pinned-posts="$pinnedPosts">
        <div class="d-flex mb-2 justify-content-between">
            <span class="fs-4">{{ $forum->postsLast7Days() . ' ' . __('common.posts_plural_ar') }} <span
                        class="fs-6 text-secondary">{{ __('forums.last_days', ['days' => 7]) }}</span></span>
            @auth
                <a href="{{ getLocaleURL('/forums/' . $forum->id . '/create') }}"
                   class="btn btn-aabu rounded-pill px-4">{{ __('forums.create_post') }}</a>
            @endauth
        </div>
        <div id="forums-container">
            {{-- all forum posts go here --}}
            @foreach($forumPosts as $forumPost)
                <x-forums.post-card :post="$forumPost"/>
            @endforeach

            {{ $forumPosts->links('pagination::pagination') }}
        </div>
    </x-forums.layout>
</x-layout>
