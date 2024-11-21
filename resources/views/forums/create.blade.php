@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

    {{-- reset quill editor styles --}}
    <style>
        .ql-snow {
            border: 1px solid var(--bs-border-color) !important;
            background-color: var(--bs-body-bg);
        }

        .ql-toolbar {
            border-bottom: none !important;
            direction: ltr !important;
        }

        .ql-toolbar .ql-stroke {
            fill: none;
            stroke: var(--bs-body-color);
        }

        .ql-toolbar .ql-fill {
            fill: var(--bs-body-color);
            stroke: none;
        }

        .ql-toolbar .ql-picker {
            color: var(--bs-body-color);
        }

        .ql-picker-item {
            color: #222;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('js/forums/create.js') }}"></script>
@endpush

<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <x-forums.layout header="Create Forum Post">
        <div class="forum-list-card bg-body-tertiary py-2 px-3 mb-3">
            <label for="title" class="fs-4 mb-1">Post Title</label>
            <input type="text" name="title" id="title" class="form-control form-control-lg font-serif rounded-0 mb-2" required/>
            <p id="title-error" class="fs-5 text-danger d-none">Title is required.</p>
            <label class="fs-4 mb-1">Content</label>
            <div id="content"></div>
            <p id="content-error" class="fs-5 text-danger d-none">Content is required.</p>
            <div class="mt-3">
                <button id="submit-button" class="btn btn-aabu px-5 rounded-pill">{{ __('common.post_verb') }}</button>
            </div>
        </div>
    </x-forums.layout>
</x-layout>


