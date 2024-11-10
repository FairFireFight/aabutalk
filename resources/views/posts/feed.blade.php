@push('scripts')
    <script src="{{ asset('js/postForm.js') }}"></script>
    <script src="{{ asset('js/feed.js') }}"></script>
    <script src="{{ asset('js/likePost.js') }}"></script>
@endpush

<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-10 col-xxl-8">
            <h1 class="mt-2 mb-3 pb-2 border-bottom font-serif">{{ __('common.my_feed') }}</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-10 col-xxl-8">
            {{-- create post form --}}
            <div>
                <form action="/posts" method="POST" enctype="multipart/form-data">
                    @csrf
                    <textarea id="text-area" type="text" name="content"
                              class="form-control form-control-lg mb-2 rounded-0"
                              placeholder="{{ __('feed.textarea_placeholder') }}"
                              rows="5" style="resize: none;"
                              maxlength="512"></textarea>

                    <input id="file-input" class="form-control mb-2 rounded-0" type="file" name="images[]" multiple/>

                    <div id="image-container" class="d-flex flex-wrap gap-1"></div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        {{-- character limit display --}}
                        <p id="char-limit" class="text-secondary m-0"> 0 / 512</p>
                        <button id="submit-button" type="submit" class="btn btn-aabu px-4 py-0 rounded-pill" disabled>{{ __('common.post_verb') }}</button>
                    </div>
                </form>
            </div>

            {{-- posts container div --}}
            <div id="posts-container">
                <h4 class="text-center text-secondary border-top pt-3">No Posts</h4>
            </div>
            <div id="loading-spinner" class="d-flex justify-content-center p-5">
                <div class="spinner-border color-aabu"></div>
            </div>
        </div>
    </div>
</x-layout>
