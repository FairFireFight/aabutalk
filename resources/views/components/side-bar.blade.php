@php
    use App\Models\Board;
@endphp
<nav id="sidebar" class="sidebar bg-body-tertiary">
    <div class="nav nav-pills flex-column py-3">
        <a href="{{ getLocaleURL('/') }}" class="px-4 nav-link link-body-emphasis"><i class="bi bi-house me-2"></i> {{ __('common.home') }}</a>
        @auth
            <a href="{{ getLocaleURL('/feed') }}" class="px-4 nav-link {{ request()->is('*/feed') ? 'active' : 'link-body-emphasis' }}"><i class="bi bi-rss me-2"></i> {{ __('common.my_feed') }}</a>
        @endauth
        <a href="{{ getLocaleURL('/all') }}" class="px-4 nav-link {{ request()->is('*/all') ? 'active' : 'link-body-emphasis' }}"><i class="bi bi-reply-all me-2"></i> {{ __('common.all') }}</a>
        <a href="{{ getLocaleURL('/forums') }}" class="px-4 nav-link {{ request()->is('*/forums') ? 'active' : 'link-body-emphasis' }}"><i class="bi bi-chat-square-text me-2"></i> {{ __('common.forums') }}</a>

        <hr>

        <h5 class="px-2">{{ __('common.header_colleges') }}</h5>

        @foreach(Board::all() as $board)
            <a href="{{ getLocaleURL('/boards/' . $board->id) }}" class="px-4 nav-link {{request()->is('*/boards/' . $board->id) ? 'active' : 'link-body-emphasis'}}">
               {{ $board->faculty->name() }}
            </a>
        @endforeach
    </div>
</nav>
