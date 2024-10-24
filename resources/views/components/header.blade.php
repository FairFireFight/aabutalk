<div class="bg-aabu fixed-top z-2 px-1 px-md-3 d-flex align-items-center justify-content-between" style="height: 4rem">
    <div class="d-flex gap-2">
        <button class="d-inline d-md-none btn fs-2 text-white px-2 py-0" id="sidebar-toggle">
            <i class="bi bi-list"></i>
        </button>

        <a href="{{ '/' . App::currentLocale() . '/'}}" class="d-flex align-items-center text-reset text-decoration-none">
            <img class="me-2" src="{{ asset('images/header logo.png') }}" alt="logo" style="height: 50px">
            <span class="fs-1 fw-light">AABU Talk</span>
        </a>
    </div>

    <div class="d-flex gap-2">
        <a href="/login" class="btn btn-light">{{ __('common.login') }}</a>
        <a href="/register" class="btn btn-outline-light">{{ __('common.register') }}</a>
    </div>
</div>
