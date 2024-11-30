<div class="px-2 px-sm-3 px-md-4 py-2 bg-body-tertiary border mb-2 position-relative">
    <div class="d-flex">
        <img src="{{ asset($user->getProfilePicture()) }}" class="pfp-50 rounded-circle shadow-sm me-3" />
        <div>
            <a href="{{ getLocaleURL('/users/' . $user->id) }}" class="mb-0 fs-5 text-decoration-none stretched-link">{{ $user->username }}</a>
            <p class="text-secondary small mb-0">{{ $user->major() }}</p>
        </div>
    </div>
</div>
