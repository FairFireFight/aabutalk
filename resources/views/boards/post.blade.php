<x-layout title="{{ $title }}" lang="{{ $locale }}">
    {{-- header --}}
    <div class="d-flex justify-content-between align-items-center my-2 border-bottom">
        <h2 class="font-serif">{{ $post->board->faculty->name() }}</h2>
        <a href="{{ getLocaleURL('/boards/' . $post->board->id) }}" class="btn btn-aabu rounded-0 px-4 mb-1">{{ __('common.back') }}</a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <x-boards.post :post="$post" />
            @if($post->forum_post_id !== null)
                <a class="btn btn-outline-aabu py-1 px-4 rounded-0 my-2"
                    href="{{ getLocaleURL('/forums/' . $post->board->faculty->forum->id . '/posts/' . $post->forum_post_id) }}">
                    <i class="bi bi-chat-square-text me-2"></i>{{ __('forums.discuss_on_forum') }}
                </a>
            @endif
        </div>
        <div class="col-lg-4">
            <x-boards.side-content :board="$post->board" :featured-posts="$featured_posts"/>
        </div>
    </div>

    <x-footer/>
</x-layout>
