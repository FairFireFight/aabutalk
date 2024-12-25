<div class="dropdown">
    <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
       class="text-reset text-decoration-none d-flex align-items-center gap-1">
        <i class="bi bi-caret-down-fill"></i>
        <img src="{{ asset($user->getProfilePicture()) }}" alt="Options Dropdown" class="pfp-50 rounded-circle shadow" />
    </a>

    <div class="dropdown-menu mt-2 bg-body-tertiary rounded-0" style="width: 250px">
        <div class="text-center d-block mb-1">
            <a href="{{ getLocaleURL('/users/' . $user->id) }}">
                <img src="{{ asset($user->getProfilePicture()) }}" alt="Profile Image" class="pfp-100 rounded-circle" />
            </a>
        </div>

        <div class="d-flex flex-column align-items-center mb-2">
            <span class="mb-1">{{$user->username }}</span>
            <span class="text-secondary" style="font-size: 0.9rem; direction: ltr">{{ $user->email }}</span>
        </div>

        <div class="row mx-3 mb-2">
            <div class="col text-center">
                <span class="fs-5">{{ $user->followers()->count() }}</span> <br>
                <span class="text-secondary">{{ __('profile.followers') }}</span>
            </div>
            <div class="col text-center">
                <span class="fs-5">{{ $user->following()->count() }}</span> <br>
                <span class="text-secondary">{{ __('profile.following') }}</span>
            </div>
        </div>

        <div class="mb-2 w-100">
            <x-logout />
        </div>

        <ul class="custom nav flex-column">
            <li class="nav-item"><a href="{{ getLocaleURL('/users/' . $user->id) }}" class="nav-link text-body"><i class="bi bi-person me-1"></i> {{ __('common.my_account') }}</a></li>
            <li class="nav-item"><a href="{{ getLocaleURL('/users/' . $user->id . '/settings') }}" class="nav-link text-body"><i class="bi bi-gear me-1"></i> {{ __('common.settings') }}</a></li>
            <li class="nav-item">
                <a href="{{ getLocaleSwitchURL() }}" class="nav-link text-body">
                    <i class="bi bi-globe me-1"></i> {{ __('common.language') }}
                </a>
            </li>

            @can('admin')
                <hr class="my-1">
                <li class="nav-item"><a href="/admin/dashboard" class="nav-link text-body" target="_blank"><i class="bi bi-speedometer2 me-1"></i> Admin</a></li>
            @endcan
        </ul>
    </div>
</div>
