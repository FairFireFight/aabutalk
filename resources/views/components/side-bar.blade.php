@php
    use App\Models\Board;
@endphp
<nav id="sidebar" class="sidebar bg-body-tertiary">
    <div class="nav nav-pills flex-column py-3 h-100">
        <a href="{{ getLocaleURL('/') }}" class="px-4 nav-link link-body-emphasis"><i class="bi bi-house me-2"></i> {{ __('common.home') }}</a>
        @auth
            <a href="{{ getLocaleURL('/feed') }}" class="px-4 nav-link {{ request()->is('*/feed') ? 'active' : 'link-body-emphasis' }}"><i class="bi bi-rss me-2"></i> {{ __('common.my_feed') }}</a>
        @endauth
        <a href="{{ getLocaleURL('/all') }}" class="px-4 nav-link {{ request()->is('*/all') ? 'active' : 'link-body-emphasis' }}"><i class="bi bi-reply-all me-2"></i> {{ __('common.all') }}</a>
        <a href="{{ getLocaleURL('/forums') }}" class="px-4 nav-link {{ request()->is('*/forums') ? 'active' : 'link-body-emphasis' }}"><i class="bi bi-chat-square-text me-2"></i> {{ __('common.forums') }}</a>

        <hr>

        <h5 class="px-2">{{ __('common.header_colleges') }}</h5>

        {{-- TODO: generate from DB --}}
        @foreach(Board::all() as $board)
            <a href="{{ getLocaleURL('/boards/' . $board->id) }}" class="px-4 nav-link {{request()->is('*/boards/' . $board->id) ? 'active' : 'link-body-emphasis'}}">
                <p class="scroll-text m-0">{{ $board->faculty->name() }}</p>
            </a>
        @endforeach

        <hr class="mt-auto">

        {{-- temporary for testing --}}
        <button class="nav-link link-body-emphasis text-start" onclick="toggleTheme()">
            <i class="bi bi-gear me-2"></i> {{ __('common.settings') }}
        </button>

        <a href="{{ getLocaleSwitchURL() }}" class="nav-link link-body-emphasis">
            <i class="bi bi-globe me-2"></i> {{ __('common.language') }}
        </a>
    </div>
</nav>
