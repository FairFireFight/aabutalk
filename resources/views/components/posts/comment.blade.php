<div class="d-flex gap-2 border-bottom py-2">
    <img src="https://placehold.co/100x100" class="pfp-60 shadow-sm rounded-circle mt-1">
    <div class="flex-grow-1">
        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="text-decoration-none fs-4 m-0">{{ $comment->user->username }}</a>
            <div class="d-flex align-items-center gap-2">
                @can('delete-comment', $comment)
                    <form action="{{ '/posts/' . $comment->post->id . '/comments/' . $comment->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn fs-5 text-danger rounded-pill py-0 px-0"><i class="bi bi-trash"></i></button>
                    </form>
                @endcan

                <span class="text-secondary">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <p>{{ $comment->content }}</p>
    </div>
</div>
