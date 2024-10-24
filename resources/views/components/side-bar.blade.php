<nav id="sidebar" class="sidebar bg-body-tertiary">
    <div class="nav nav-pills flex-column py-3">
        <a href="#" class="px-4 nav-link active"><i class="bi bi-house me-2"></i> {{ __('common.home') }}</a>
        <a href="#" class="px-4 nav-link link-body-emphasis"><i class="bi bi-rss me-2"></i> {{ __('common.my_feed') }}</a>
        <a href="#" class="px-4 nav-link link-body-emphasis"><i class="bi bi-reply-all me-2"></i> {{ __('common.all') }}</a>

        <hr>

        <h5 class="px-2">{{ __('common.header_colleges') }}</h5>

        {{-- TODO: generate from DB --}}
        <a href="#" class="px-4 nav-link link-body-emphasis">{{ __('common.home') }}</a>
        <a href="#" class="px-4 nav-link link-body-emphasis">{{ __('common.my_feed') }}</a>
        <a href="#" class="px-4 nav-link link-body-emphasis">{{ __('common.all') }}</a>

        <hr>

        <a href="{{ App::isLocale('en') ? '/ar/' : '/en/' }}" class="nav-link link-body-emphasis">
            <i class="bi bi-globe me-2"></i> {{ __('common.language') }}
        </a>
    </div>
</nav>
