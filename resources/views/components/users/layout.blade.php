@push('styles')
    <style>
        .profile-picture {
            object-fit: cover;
            position: absolute;
            bottom: 3px;
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
        <div>
            <img src="{{ asset($user->getCoverPicture()) }}" class="w-100 cover-picture">
        </div>
        <div class="px-3 px-lg-5" style="position: relative;">
            <!-- profile image -->
            <img src="{{ asset($user->getProfilePicture()) }}" class="rounded-circle border border-5 bg-light profile-picture">

            <div class="d-flex justify-content-between align-items-center" style="margin: 0 0 0 145px">
                <!-- profile info -->
                <div>
                    <span class="fs-4 mb-0"> {{ $user->username }} </span>
                    <p class="text-secondary mb-2">0 Followers / 0 Following</p>
                </div>

                <!-- settings icon div -->
                <div>
                    @can('edit-profile', $user)
                        @if(!request()->is('users/*/settings'))
                            <a class="text-reset" href="{{ getLocaleURL('/users/' . $user->id . '/settings') }}">
                                <i class="bi bi-gear fs-4"></i>
                            </a>
                        @else
                            <a href="/users/{{ $user->id }}" class="fs-5">Back</a>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div>
        @if(!request()->is('users/*/settings'))
            <!-- profile nav bar -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link rounded-0 {{ request()->is('*/users/*') ? 'active' : '' }}"
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
            </ul>
        @endif
        <!-- content div -->
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
