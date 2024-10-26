@push('styles')
    <link rel="stylesheet" href="{{ asset('css/forums.css') }}">
@endpush

<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <h1 class="my-2 font-serif fst-italic border-bottom">Forums</h1>

    <div class="row">
        <div class="col col-lg-8">
            <div class="d-flex justify-content-between text-body-secondary">
                <h5>College or Faculty</h5>
                <h5>Posts</h5>
            </div>
            <div id="forums-container">
                <div class="forum-category">

                </div>
            </div>
        </div>
        <div class="col d-none d-lg-block">
            <div class="bg-body-tertiary">
                <h1>filler</h1>
            </div>
        </div>
    </div>
</x-layout>
