@pushonce('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ql-render.css') }}">
@endpushonce

<div class="post" >
    {{-- post header --}}
    <div class="d-flex justify-content-between">
        <h1 class="mb-0 font-serif fw-semibold">{{ $post->title }}</h1>

        <div class="flex-shrink-0 d-flex flex-column align-items-end">
            <a href="#">{{ $post->user->username }}</a>
            <p class="text-body-secondary mb-0" title="{{ $post->created_at->diffForHumans() }}">
                {{ $post->created_at->translatedFormat('F jS, Y') }}
            </p>
        </div>
    </div>

    {{-- post contents --}}
    <div class="post-content p-0">
        {!! $post->content !!}
    </div>
</div>
