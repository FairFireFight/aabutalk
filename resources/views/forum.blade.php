<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <x-forums.layout header="{{ $forum->faculty->name() }}">
        <div class="d-flex mb-2 justify-content-between">
            <span class="fs-4">7 {{ __('common.posts_plural_ar') }} <span class="fs-6 text-secondary">{{ __('forums.last_days', ['days' => 7]) }}</span></span>
            <a href="/forums/1/create" class="btn btn-aabu rounded-pill px-4">Create Post</a>
        </div>
        <div id="forums-container">
            {{-- all forum posts go here --}}
            @for($i = 0; $i <= 7; $i++)
                <x-forums.post-card />
            @endfor
        </div>
    </x-forums.layout>
</x-layout>
