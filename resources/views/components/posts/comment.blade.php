<div class="d-flex gap-2 border-bottom py-2">
    <img src="{{ asset($comment->user->getProfilePicture()) }}" class="pfp-60 shadow-sm rounded-circle mt-1">
    <div class="flex-grow-1">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ getLocaleURL('/users/' . $comment->user->id) }}" class="text-decoration-none fs-4 m-0">{{ $comment->user->username }}</a>
            <div class="d-flex align-items-center gap-2">
                @can('delete-comment', $comment)
                    <x-delete-button action="{{ '/posts/' . $comment->post->id . '/comments/' . $comment->id }}" />
                @endcan

                <span class="text-secondary">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <p>{{ $comment->content }}</p>
    </div>
</div>
