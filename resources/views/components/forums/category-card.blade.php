<div class="forum-list-card forum-list-card-hover d-flex justify-content-between position-relative bg-body-tertiary px-3 py-2 mb-3">
    <div>
        <a href="{{ getLocaleURL('/forums/' . $forum->id) }}" class="fs-4 mb-1 text-reset stretched-link text-decoration-none">{{ $forum->faculty->name() }}</a>
    </div>
    <div class="text-end">
        <span class="badge rounded-0 px-3 bg-aabu">{{ $forum->postsLast7Days() . ' ' . __('common.posts_plural_ar') }}</span>
        <br>
        <span class="text-secondary">{{ __('forums.last_days', ['days' => 7]) }}</span>
    </div>
</div>
