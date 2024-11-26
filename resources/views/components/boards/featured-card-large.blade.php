<div class="mt-3 px-2 px-md-3 px-lg-5 py-4 bg-body-secondary border">
    <div class="row">
        <div class="col-lg-6 d-flex flex-column">
            <h1 class="font-serif fst-italic fw-semibold">{{ $post->title }}</h1>

            <div class="fs-5 mb-4 fw-light overflow-hidden" style="max-height: 175px">
                {!! $post->previewText() !!}
            </div>

            <a href="{{ getLocaleURL('/boards/' . $post->board->id . '/posts/' . $post->id) }}" class="mb-3 mb-lg-0 fs-4 mt-auto icon-link icon-link-hover">{{ __('common.read_more') }}<i
                    class="bi bi-arrow-right mb-2"></i></a>
        </div>
        <div class="d-flex col-lg-6 align-items-center justify-content-center">
            @if($post->thumbnail())
                <img src="{{ $post->thumbnail() }}" alt="image" class="img-fluid shadow-sm rounded h-100"
                     style="width: 100%; object-fit: cover">
            @endif
        </div>
    </div>
</div>
