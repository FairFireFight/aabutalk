<div class="list-group-item">
    <div class="row">
        <div class="col-4 p-0">
            @if($post->thumbnail())
                <img src="{{ $post->thumbnail() }}" style="width: 100%; height: 100%; object-fit: cover">
            @endif
        </div>
        <div class="col d-flex flex-column justify-content-center ps-3">
            <a href="{{ getLocaleURL('/boards/' . $post->board->id . '/posts/' . $post->id) }}"
               class="fs-5 font-serif mb-0">{{ $post->title }}</a>
            <p class="text-body-secondary m-0">{{ $post->created_at->format('d/m/YY') }}</p>
        </div>
    </div>
</div>
