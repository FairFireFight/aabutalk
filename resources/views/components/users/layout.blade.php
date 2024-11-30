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

            <div class="d-flex justify-content-between align-items-center" style="margin: 0 145px">
                {{-- profile info --}}
                <div>
                    <div class="fs-3 mb-0">
                        @if($user->hasPermission('admin'))
                            <i title="Admin" class="bi bi-shield-shaded text-warning fs-5"></i>
                        @endif
                        @if($user->hasPermission('moderator'))
                            <i title="Moderator" class="bi bi-shield-shaded text-danger fs-5"></i>
                        @endif
                        <span>
                            {{ $user->username }}
                        </span>
                        <span class="text-secondary fs-6">
                            {{ $user->major() }}
                        </span>
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
                   href="{{ getLocaleURL('/users/' . $user->id) }}"><i class="bi bi-postcard me-2"></i>{{ __('common.posts') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-0 {{ request()->is('*/users/*/comments') ? 'active' : '' }}"
                   href="{{ getLocaleURL('/users/' . $user->id . '/comments') }}"><i class="bi bi-chat me-2"></i>{{ __('common.comments') }}</a>
            </li>
            @can('edit-profile', $user)
                <li class="nav-item ms-auto">
                    <a class="nav-link rounded-0 {{ request()->is('*/users/*/settings') ? 'active' : '' }}"
                       href="{{ getLocaleURL('/users/' . $user->id . '/settings') }}"><i class="bi bi-gear me-2"></i>{{ __('common.settings') }}</a>
                </li>
            @endcan
        </ul>
    </nav>

    {{-- content div --}}
    <div class="row">
        <div class="col-lg-4 order-lg-last pt-3">
            <div class="bg-body-tertiary p-3 mt-3 mt-lg-0 position-sticky" style="top: 5rem">
                @can('follow-user', $user)
                    <button class="btn btn-outline-aabu rounded-0 w-100">
                        <i class="bi bi-person-plus me-2"></i>{{ __('profile.follow_verb') . ' ' . $user->username }}
                    </button>
                    <hr>
                @endcan
                <div>
                    Biograph Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda corporis dolores ex facere iste officia omnis quibusdam, sint suscipit velit.
                </div>
                <hr>
                {{-- user information --}}
                <div>
                    <div class="row">
                        <div class="col-3 fw-semibold">
                            {{ __('profile.joined') }}
                        </div>
                        <div class="col">
                            {{ $user->created_at->translatedFormat('F jS, Y') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 fw-semibold">
                            {{ __('profile.followers') }}
                        </div>
                        <div class="col">
                            0
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 fw-semibold">
                            {{ __('profile.following') }}
                        </div>
                        <div class="col">
                            0
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 fw-semibold">
                            {{ __('common.posts') }}
                        </div>
                        <div class="col">
                            {{ $user->posts->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- main content --}}
        <div class="col-lg order-lg-first">
            {{$slot}}
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('js/likePost.js')}}"></script>
@endpush
