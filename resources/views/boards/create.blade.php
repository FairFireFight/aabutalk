@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ql-bootstrap.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/forums/create.js') }}"></script>
@endpush

<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="d-flex justify-content-between align-items-end my-2 pb-0 border-bottom">
                <h2 class="font-serif mb-0">Create Board Post</h2>
                <a href="{{ getLocaleURL('/boards/' . $board->id) }}" class="btn btn-aabu px-4 rounded-pill mb-1">Back</a>
            </div>

            <p class="text-secondary fs-5 mb-0">{{ $board->faculty->name() }}</p>
            <div class="py-2 mb-2">
                <label for="title" class="fs-4 mb-1">{{ __('forums.post_title') }}</label>
                <input type="text" name="title" id="title" class="form-control form-control-lg font-serif rounded-0 mb-2"  placeholder="{{ __('forums.post_title') }}..."/>
                <p id="title-error" class="fs-5 text-danger d-none">{{ __('forums.title_required') }}</p>
                <label class="fs-4 mb-1">{{ __('forums.post_content') }}</label>
                <div id="content"></div>
                <p id="content-error" class="fs-5 text-danger d-none">{{ __('forums.content_required') }}</p>
                <div class="mt-3">
                    <button id="submit-button" class="btn btn-aabu px-5 rounded-pill">{{ __('common.post_verb') }}</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
