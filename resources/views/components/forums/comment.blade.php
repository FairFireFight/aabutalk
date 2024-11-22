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
            <p class="mb-0 text-end text-secondary" title="{{ $comment->created_at->toDayDateTimeString() }}">
                {{ $comment->created_at->diffForHumans() }}
            </p>
        </div>
    </div>
</div>
