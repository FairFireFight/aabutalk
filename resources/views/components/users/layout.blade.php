@push('styles')
    <style>
        .profile-picture {
            object-fit: cover;
            position: absolute;
            bottom: 0;
            width: 130px;
            height: 130px;

            border-color: var(--bs-body-bg) !important;
        }

        .cover-picture {
            height: 180px;
            object-fit: cover;
            background-color: var(--aabu-green);
        }
    </style>
@endpush

<div>
    <div>
        {{-- cover picture --}}
        <div>
            <img src="{{ asset($user->getCoverPicture()) }}" class="w-100 cover-picture">
        </div>

        <div class="px-3 px-lg-5" style="position: relative;">
            {{-- profile picture --}}
            <img src="{{ asset($user->getProfilePicture()) }}" class="rounded-circle border border-5 bg-light profile-picture">

            <div class="d-flex justify-content-between align-items-center" style="margin: 0 0 0 145px">
                {{-- profile info --}}
                <div>
                    <div class="fs-3 mb-0">
                        <span>
                            {{ $user->username }}
                        </span>
                        @if($user->hasPermission('admin'))
                            <i title="Admin" class="bi bi-shield-shaded text-warning fs-5"></i>
                        @endif
                        @if($user->hasPermission('moderator'))
                            <i title="Moderator" class="bi bi-shield-shaded text-danger fs-5"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav>
        {{-- nav tabs --}}
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link rounded-0 {{ request()->is('*/users/*') && !request()->is('*/users/*/*') ? 'active' : '' }}"
                   href="{{ getLocaleURL('/users/' . $user->id) }}">Activity</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-0 {{ request()->is('*/users/*/posts') ? 'active' : '' }}"
                   href="{{ getLocaleURL('/users/' . $user->id . '/posts') }}">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-0 {{ request()->is('*/users/*/comments') ? 'active' : '' }}"
                   href="{{ getLocaleURL('/users/' . $user->id . '/comments') }}">Comments</a>
            </li>
            @can('edit-profile', $user)
                <li class="nav-item ms-auto">
                    <a class="nav-link rounded-0 {{ request()->is('*/users/*/settings') ? 'active' : '' }}"
                       href="{{ getLocaleURL('/users/' . $user->id . '/settings') }}">Settings</a>
                </li>
            @endcan
        </ul>
    </nav>

    {{-- content div --}}
    <div class="row">
        <div class="col-lg-4 order-lg-last pt-3">
            <div class="bg-body-tertiary p-3 mt-3 mt-lg-0 position-sticky" style="top: 5rem">
                <div class="pb-3 mb-3 border-bottom">
                    Biograph Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda corporis dolores ex facere iste officia omnis quibusdam, sint suscipit velit.
                </div>

                {{-- user information --}}
                <div>
                    <div class="row">
                        <div class="col-3 fw-semibold">
                            Joined
                        </div>
                        <div class="col">
                            {{ $user->created_at->translatedFormat('F jS, Y') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 fw-semibold">
                            Followers
                        </div>
                        <div class="col">
                            0
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 fw-semibold">
                            Following
                        </div>
                        <div class="col">
                            0
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg order-lg-first">
            {{$slot}}
        </div>
    </div>
</div>
