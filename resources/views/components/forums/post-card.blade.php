<div class="forum-list-card d-flex justify-content-between bg-body-tertiary px-3 py-2 mb-3">
    <div>
        <a href="{{ getLocaleURL('/forums/' . $post->forum->id . '/posts/' . $post->id) }}" class="fs-4 mb-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{ $post->title }}</a>

        <p class="m-0">{{ __('common.by') }} <a class="text-decoration-none" href="#">{{ $post->user->username }}</a></p>
    </div>
    <div class="text-end text-secondary">
        <span>27 {{ __('common.comments') }}</span>
        <br>
        <span title="{{ $post->created_at->toDayDateTimeString() }}">{{ $post->created_at->diffForHumans() }}</span>
    </div>
</div>
