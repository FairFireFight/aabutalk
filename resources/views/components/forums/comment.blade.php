<div class="forum-list-card bg-body-tertiary py-2 px-3 mb-3">
    <div class="d-flex gap-3">
        <div class="d-flex flex-column align-items-center text-center border-end pe-3">
            <img class="pfp-100 rounded" src="{{ asset($comment->user->getProfilePicture()) }}" alt="Profile Image">
            <a href="{{ getLocaleURL('/users/' . $comment->user->id) }}">{{ $comment->user->username }}</a>
            <span class="text-secondary" style="font-size: 0.75rem">{{ $comment->user->major() }}</span>
        </div>

        <div class="d-flex flex-column justify-content-between w-100">
            {{-- comment content --}}
            <div>
                <p class="fs-5">{{ $comment->content }}</p>
            </div>
            <div class="mb-0 d-flex w-100 justify-content-end text-secondary align-items-center gap-2">
                @can('delete-forum-comment', $comment)
                    <x-delete-button action="{{ '/forums/' . $comment->forumPost->forum->id . '/posts/' . $comment->forumPost->id . '/comment/' . $comment->id }}" />
                @endcan

                <span title="{{ $comment->created_at->toDayDateTimeString() }}">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>
