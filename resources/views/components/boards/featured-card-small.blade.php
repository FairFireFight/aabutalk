<div class="col-md-6">
    <div class="row g-0 border overflow-hidden flex-md-row shadow-sm h-100">
        <div class="col p-4 d-flex flex-column justify-content-start">
            <h4 class="mb-0 font-serif">{{ $post->title }}</h4>
            <div class="mb-1 text-body-secondary">{{ $post->created_at->format('M d') }} - {{ $post->created_at->diffForHumans() }}</div>
            <div class="card-text mb-auto overflow-hidden" style="max-height: 100px">
                {!!  $post->previewText() !!}
            </div>
            <a href="{{ getLocaleURL('/boards/' . $post->board->id . '/posts/' . $post->id ) }}" class="icon-link icon-link-hover mt-auto">
                {{ __('common.read_more') }}<i class="bi bi-arrow-right mb-1"></i>
            </a>
        </div>
        <div class="col-5 d-none d-xl-block">
            @if($post->thumbnail())
                <img src="{{ $post->thumbnail() }}"
                     style="width: 100%; height: 100%; object-fit: cover">
            @endif
        </div>
    </div>
</div>
