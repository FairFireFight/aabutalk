<div class="forum-list-card bg-body-tertiary py-2 px-3 mb-3">
    <div class="d-flex gap-3">
        <div class="d-flex flex-column align-items-center text-center border-end pe-3">
            <img class="pfp-100 rounded" src="https://placehold.co/100x100" alt="Profile Image">
            <a href="#">{{ $comment->user->username }}</a>
            <span class="text-secondary">{{ $comment->user->major() }}</span>
        </div>

        <div class="d-flex flex-column justify-content-between w-100">
            {{-- comment content --}}
            <div>
                <p>{{ $comment->content }}</p>
            </div>
            <div class="mb-0 d-flex w-100 justify-content-end text-secondary align-items-center gap-2">
                @can('delete-forum-comment', $comment)
                    <form action="{{ '/forums/' . $comment->forumPost->forum->id . '/posts/' . $comment->forumPost->id . '/comment/' . $comment->id }}"
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn fs-5 text-danger rounded-pill py-0 px-0"><i class="bi bi-trash"></i></button>
                    </form>
                @endcan

                <span title="{{ $comment->created_at->toDayDateTimeString() }}">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>
