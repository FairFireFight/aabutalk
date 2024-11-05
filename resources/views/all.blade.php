<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <h1 class="mt-2 mb-1 font-serif">{{ __('common.all') }}</h1>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-10 col-xxl-8">
            {{-- posts container div --}}
            <div id="posts-container">
                @for($i = 1; $i <= 3; $i++)
                    <x-posts.post-card></x-posts.post-card>
                @endfor
            </div>
            <div class="d-flex justify-content-center p-5">
                <div class="spinner-border color-aabu"></div>
            </div>
        </div>
        <div class="col d-none d-xl-block">
            <div class="p-3 bg-body-tertiary">
                <h5 class="font-serif">Welcome to the Talk page!</h5>
                <p class="mb-0">This is where posts from all over AABU are, you can find people to follow and chat with here.</p>
            </div>
        </div>
    </div>
</x-layout>
