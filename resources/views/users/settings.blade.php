<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <x-users.layout :user="$user">
        <h4 class="font-serif mt-3">{{ __('common.settings') }}</h4>
        <div class="dropdown">
            <button class="btn btn-aabu px-4 rounded-0 dropdown-toggle" data-bs-toggle="dropdown" type="button">
                {{ __('profile.preferred_theme') }}
            </button>
            <ul class="dropdown-menu rounded-0">
                <li><button class="dropdown-item theme-setting" data-value="auto">{{ __('profile.auto') }}</button></li>
                <li><button class="dropdown-item theme-setting" data-value="dark">{{ __('profile.dark') }}</button></li>
                <li><button class="dropdown-item theme-setting" data-value="light">{{ __('profile.light') }}</button></li>
            </ul>
        </div>

        <h4 class="font-serif mt-3">{{ __('profile.update_info') }}</h4>
        <form action="{{ '/users/' . $user->id . '/update/info'}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row gx-1 mt-2">
                {{-- email address display --}}
                <div class="col-lg-6">
                    <label class="mb-1">{{ __('auth.email_address') }}</label>
                    <input type="text" class="form-control rounded-0" style="direction: ltr" readonly disabled value="{{ $user->email }}" />
                    <p class="form-text">{{ __('profile.email_note') }}</p>
                </div>

                {{-- username input --}}
                <div class="col-lg-6">
                    <label class="mb-1">{{ __('auth.username') }}</label>
                    <input type="text" class="form-control rounded-0" value="{{ $user->username }}" required name="username"/>
                    <p class="form-text">{{ __('profile.username_note') }}</p>
                </div>
            </div>

            {{-- bio text area --}}
            <label class="mb-1">{{ __('profile.biography') }}</label>
            <textarea name="bio" class="form-control rounded-0" rows="4" placeholder="{{ __('profile.biography_placeholder') }}">{{ $user->biography }}</textarea>

            <button type="submit" class="btn btn-aabu rounded-0 px-5 mt-3">{{ __('common.save') }}</button>
        </form>

        <hr>

        <form action="{{ '/users/' . $user->id . '/update/pictures'}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <h4 class="font-serif mt-3">{{ __('profile.update_avatar') }}</h4>
            {{-- avatar preview --}}
            <div class="d-flex gap-2 align-items-end">
                <img class="avatar-preview rounded-circle shadow-sm" src="{{ asset($user->getProfilePicture()) }}" alt="128x128 Preview" width="128" height="128" style="object-fit: cover">
                <img class="avatar-preview rounded-circle shadow-sm" src="{{ asset($user->getProfilePicture()) }}" alt="64x64 Preview" width="64" height="64" style="object-fit: cover">
                <img class="avatar-preview rounded-circle shadow-sm" src="{{ asset($user->getProfilePicture()) }}" alt="32x32 Preview" width="32" height="32" style="object-fit: cover">
            </div>

            <input id="avatar-input" type="file" name="avatar" class="form-control mt-3 rounded-0"
                   accept="image/png, image/jpeg, image/bmp"/>
            <p class="form-text">.PNG, .JPEG, .BMP</p>

            <h4 class="font-serif mt-3">{{ __('profile.update_cover') }}</h4>

            {{-- cover preview --}}
            <img class="cover-preview w-100 shadow-sm" src="{{ asset($user->getCoverPicture()) }}" style="object-fit: cover; max-height: 250px">

            <input id="cover-input" type="file" name="cover" class="form-control mt-3 rounded-0"
                   accept="image/png, image/jpeg, image/bmp"/>
            <p class="form-text">.PNG, .JPEG, .BMP</p>
            <button type="submit" class="btn btn-aabu rounded-0 px-5 mb-3">{{ __('common.save') }}</button>
        </form>
    </x-users.layout>
    <x-footer/>

    @push('scripts')
        <script src="{{ asset('js/settings.js') }}"></script>
    @endpush
</x-layout>


