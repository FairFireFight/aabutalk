@push('styles')
    <link rel="stylesheet" href="{{ asset('css/forums.css') }}">
@endpush

{{-- header --}}
<h1 class="my-2 border-bottom">
    {!! $header !!}
</h1>

{{-- main content --}}
<div class="row">
    {{-- main column --}}
    <div class="col col-lg-8">
        <main>
            {{ $slot }}
        </main>
    </div>
    {{-- secondary column --}}
    <div class="col d-none d-lg-block">
        <div class="position-sticky" style="top: 5rem">
            <div class="lh-sm bg-body-tertiary rounded-0 py-2 px-3 mb-2">
                <p class="fw-semibold mb-1">{{ __('forums.forums_info_header') }}</p>
                <p class="m-0">{{ __('forums.forums_info_body') }}</p>
            </div>

            <h4 class="bg-body-tertiary py-2 px-3 mb-2"><i class="bi bi-pin-angle text-danger"></i> {{ __('forums.posts_pinned') }}</h4>
            <div id="pinned-container">
                @foreach($pinnedPosts as $post)
                    <x-forums.pinned-post :post="$post"/>
                @endforeach
            </div>
        </div>
    </div>
</div>

<x-footer></x-footer>
