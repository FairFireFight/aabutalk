@push('styles')
    <link rel="stylesheet" href="{{ asset('css/forums.css') }}">
@endpush

<x-layout title="{{ $title }}" lang="{{ $lang }}">
    {{-- header --}}
    <h1 class="my-2 font-serif border-bottom">{{ __('common.forums') }}</h1>

    {{-- main content --}}
    <div class="row">
        {{-- main column --}}
        <div class="col col-lg-8">
            <div class="d-flex mb-2 justify-content-between text-body-secondary">
                <h5>{{ __('common.header_colleges') }}</h5>
                <h5>{{ __('common.posts') }}</h5>
            </div>
            <div id="forums-container">
                {{-- all forum categories go here --}}
                @for($i = 0; $i <= 10; $i++)
                    <x-forums.category-card />
                @endfor
            </div>
        </div>
        {{-- secondary column --}}
        <div class="col d-none d-lg-block">
            <div class="position-sticky" style="top: 5rem">
                <div class="lh-sm alert alert-info rounded-0 py-2 mb-2">
                    <p class="fw-semibold mb-1">{{ __('forums.forums_info_header') }}</p>
                    <p class="m-0">{{ __('forums.forums_info_body') }}</p>
                </div>

                <h4 class="bg-body-tertiary py-2 px-3 mb-2"><i class="bi bi-pin-angle text-danger"></i> {{ __('forums.posts_pinned') }}</h4>
                <div id="pinned-container">
                    @for($i = 0; $i <= 5; $i++)
                        <x-forums.pinned-post/>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</x-layout>
