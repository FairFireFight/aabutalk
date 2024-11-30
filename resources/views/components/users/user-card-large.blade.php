<div class="bg-body-tertiary p-2 border d-inline-block position-relative" style="min-width: 185px; max-width: 185px; height: 250px">
    <div class="d-flex flex-column align-items-center h-100">
        <img src="{{ asset($user->getProfilePicture()) }}" class="pfp-100 rounded-circle shadow-sm" />
        <h5 class="mx-2 mb-0 text-center">{{ $user->username }}</h5>
        <p class="mx-2 mb-1 text-center text-secondary">{{ $user->major() }}</p>
        <a href="{{ getLocaleURL('/users/' . $user->id) }}"
           class="btn btn-sm btn-outline-aabu py-1 w-100 rounded-0 mb-1 mt-auto stretched-link">
            {{ __('profile.view_profile') }}
        </a>
    </div>
</div>
