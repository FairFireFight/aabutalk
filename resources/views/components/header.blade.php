<div class="bg-aabu-blur fixed-top z-2 px-1 px-md-3 d-flex align-items-center justify-content-between shadow-sm" style="height: 4rem;">
    <div class="d-flex gap-2">
        <button class="d-inline d-lg-none btn fs-2 text-white px-2 py-0" id="sidebar-toggle">
            <i class="bi bi-list"></i>
        </button>

        <a href="{{ getLocaleURL('/') }}" class="d-flex align-items-center text-reset text-decoration-none">
            <img class="me-2" src="{{ asset('images/header logo.png') }}" alt="logo" style="height: 50px">
            <span class="fs-1 fw-light">Talk</span>
        </a>
    </div>

    @guest
        <div class="btn-group">
            <a href="{{ getLocaleURL('/login') }}" class="btn btn-light rounded-start-pill ps-3 pe-2">{{ __('common.login') }}</a>
            <a href="{{ getLocaleURL('/register') }}" class="btn btn-outline-light rounded-end-pill ps-2 pe-3">{{ __('common.register') }}</a>
        </div>
    @endguest
    @auth
        <div class="dropdown">
            <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
               class="text-reset text-decoration-none d-flex align-items-center gap-1">
                <i class="bi bi-caret-down-fill"></i>
                <img src="https://placehold.it/100x100" alt="Options Dropdown" class="pfp-50 rounded-circle shadow" />
            </a>

            <div class="dropdown-menu mt-2 bg-body-tertiary rounded-0" style="width: 250px">
                <div class="text-center d-block mb-1">
                    <a href="#">
                        <img src="https://placehold.it/100x100" alt="Profile Image" class="pfp-100 rounded-circle" />
                    </a>
                </div>

                <div class="d-flex flex-column align-items-center mb-2">
                    <span class="mb-1">{{ Auth::user()->username }}</span>
                    <span class="text-secondary" style="font-size: 0.9rem">{{ Auth::user()->email }}</span>
                </div>

                <div class="text-center mb-2">
                    <x-logout />
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#" class="nav-link text-body"><i class="bi bi-person me-1"></i> {{ __('common.my_account') }}</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-body"><i class="bi bi-gear me-1"></i> {{ __('common.settings') }}</a></li>
                    <li class="nav-item">
                        <a href="{{ getLocaleSwitchURL() }}" class="nav-link text-body">
                            <i class="bi bi-globe me-1"></i> {{ __('common.language') }}
                        </a>
                    </li>
                    <hr class="my-1">
                    <li class="nav-item"><a href="/admin/dashboard" class="nav-link text-body" target="_blank"><i class="bi bi-speedometer2 me-1"></i> Admin</a></li>
                </ul>
            </div>
        </div>
    @endauth
</div>
