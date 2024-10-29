<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <x-forums.layout header="{{ $header }}">
        <div class="d-flex mb-2 justify-content-between text-body-secondary">
            <h5>{{ __('common.header_colleges') }}</h5>
            <h5>{{ __('common.posts') }}</h5>
        </div>
        <div id="forums-container">
            {{-- all forum categories go here --}}
            @for($i = 0; $i <= 10; $i++)
                <x-forums.post-card />
            @endfor
        </div>
    </x-forums.layout>
</x-layout>
