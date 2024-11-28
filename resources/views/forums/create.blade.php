@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ql-bootstrap.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/forums/create.js') }}"></script>
@endpush

<x-layout title="{{ $title }}" lang="{{ $locale }}">
    @push('body-top')
        <x-processing-operation/>
    @endpush
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <x-forums.layout :pinned-posts="$pinnedPosts" header="Create Forum Post">
        <div class="forum-list-card bg-body-tertiary py-2 px-3 mb-2">
            <label for="title" class="fs-4 mb-1">{{ __('forums.post_title') }}</label>
            <input type="text" name="title" id="title" class="form-control form-control-lg font-serif rounded-0 mb-2"  placeholder="{{ __('forums.post_title') }}..."/>
            <p id="title-error" class="fs-5 text-danger d-none">{{ __('forums.title_required') }}</p>
            <label class="fs-4 mb-1">{{ __('forums.post_content') }}</label>
            <div id="content"></div>
            <p id="content-error" class="fs-5 text-danger d-none">{{ __('forums.content_required') }}</p>
            <div class="mt-3">
                <button id="submit-button" class="btn btn-aabu px-5 rounded-0">{{ __('common.post_verb') }}</button>
            </div>
        </div>
    </x-forums.layout>
</x-layout>


