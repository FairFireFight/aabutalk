<nav id="sidebar" class="sidebar bg-body-tertiary">
    <div class="nav nav-pills flex-column py-3">
        <a href="{{ getLocaleURL('/') }}" class="px-4 nav-link link-body-emphasis"><i class="bi bi-house me-2"></i> {{ __('common.home') }}</a>
        <a href="{{ getLocaleURL('/feed') }}" class="px-4 nav-link {{ request()->is('*/feed') ? 'active' : 'link-body-emphasis' }}"><i class="bi bi-rss me-2"></i> {{ __('common.my_feed') }}</a>
        <a href="{{ getLocaleURL('/all') }}" class="px-4 nav-link {{ request()->is('*/all') ? 'active' : 'link-body-emphasis' }}"><i class="bi bi-reply-all me-2"></i> {{ __('common.all') }}</a>

        <hr>

        <h5 class="px-2">{{ __('common.header_colleges') }}</h5>

        {{-- TODO: generate from DB --}}
        <a href="#" class="px-4 nav-link link-body-emphasis">To be generated</a>
        <a href="#" class="px-4 nav-link link-body-emphasis">Placeholder 1</a>
        <a href="#" class="px-4 nav-link link-body-emphasis">Placeholder 2</a>
        <a href="#" class="px-4 nav-link link-body-emphasis">Placeholder 3</a>
        <a href="#" class="px-4 nav-link link-body-emphasis">Placeholder 4</a>
        <a href="#" class="px-4 nav-link link-body-emphasis">Placeholder 5</a>
        <a href="#" class="px-4 nav-link link-body-emphasis">Placeholder 6</a>

        <hr>

        <a href="#" class="nav-link link-body-emphasis">
            <i class="bi bi-gear me-2"></i> {{ __('common.settings') }}
        </a>

        <a href="{{ getLocaleSwitchURL() }}" class="nav-link link-body-emphasis">
            <i class="bi bi-globe me-2"></i> {{ __('common.language') }}
        </a>
    </div>
</nav>
