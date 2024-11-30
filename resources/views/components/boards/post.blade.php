@pushonce('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ql-render.css') }}">
@endpushonce

<div class="post" >
    {{-- post header --}}
    <div>
        <h1 class="mb-0 font-serif fw-semibold">{{ $post->title }}</h1>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            @can('manage-board-post', $post->board)
                <div class="d-flex gap-2 align-items-center">
                    <x-delete-button class="d-inline" action="{{ '/boards/' . $post->board->id . '/posts/' . $post->id }}" />

                    <form action="{{ '/boards/' . $post->board->id . '/posts/' . $post->id . '/feature' }}" method="POST">
                        @csrf
                        @if($post->featured)
                            <button type="submit" class="btn btn-sm btn-warning rounded-0 py-0">
                                <i class="bi bi-star-fill"></i> Unfeature
                            </button>
                        @else
                            <button type="submit" class="btn btn-sm btn-outline-warning rounded-0 py-0">
                                <i class="bi bi-star"></i> Feature
                            </button>
                        @endif
                    </form>
                </div>
            @endcan

            @cannot('manage-board-post', $post->board)
                @if($post->featured)
                    <span class="text-warning fw-semibold">
                        <i class="bi bi-star-fill"></i> Featured
                    </span>
                @endif
            @endcannot

            <a href="{{ getLocaleURL('/users/' . $post->user->id) }}">{{ $post->user->username }}</a>

            <p class="text-body-secondary mb-0" title="{{ $post->created_at->diffForHumans() }}">
                {{ $post->created_at->translatedFormat('M jS, Y') }}
            </p>
        </div>
    </div>

    {{-- post contents --}}
    <div class="post-content p-0">
        {!! $post->content !!}
    </div>
</div>
