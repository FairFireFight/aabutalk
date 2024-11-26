

<x-layout title="{{ $title }}" lang="{{ $locale }}">
    {{-- header --}}
    <div class="d-flex justify-content-between align-items-center my-2 border-bottom">
        <h2 class="font-serif">{{ $post->board->faculty->name() }}</h2>
        <a href="{{ getLocaleURL('/boards/' . $post->board->id) }}" class="btn btn-aabu rounded-pill px-4 mb-1">{{ __('common.back') }}</a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <x-boards.post :post="$post" />
        </div>
        <div class="col-lg-4">
            <x-boards.side-content :board="$post->board" :featured-posts="$featured_posts"/>
        </div>
    </div>
</x-layout>
