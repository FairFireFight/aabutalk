<a href="{{ getLocaleURL('/forums/' . $post->forum->id . '/posts/' . $post->id) }}"
   class="d-block position-relative forum-list-card forum-list-card-hover bg-body-tertiary px-2 py-1 mb-2 text-reset text-decoration-none">
    <div class="text-secondary">{{ $post->forum->faculty->name() }}</div>
    <div class="mb-0 fs-5 text-reset text-decoration-none">{{ $post->title }}</div>
    <div class="d-flex justify-content-between text-secondary">
        <span>{{ __('common.by') . ' ' . $post->user->username}}</span>
        <span>{{ $post->created_at->format('m/d/Y') }}</span>
    </div>
</a>
