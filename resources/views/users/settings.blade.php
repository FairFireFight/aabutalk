<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <x-users.layout :user="$user">
        <h4 class="font-serif mt-3">Update info</h4>
        <div class="dropdown">
            <button class="btn btn-aabu px-4 dropdown-toggle" data-bs-toggle="dropdown" type="button">
                Preferred Theme
            </button>
            <ul class="dropdown-menu">
                <li><button class="dropdown-item theme-setting">Auto</button></li>
                <li><button class="dropdown-item theme-setting">Dark</button></li>
                <li><button class="dropdown-item theme-setting">Light</button></li>
            </ul>
        </div>

        <h4 class="font-serif mt-3">Update info</h4>
        <form action="{{ '/users/' . $user->id . '/update/info'}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row gx-1 mt-2">
                {{-- email address display --}}
                <div class="col-lg-6">
                    <label class="mb-1">{{ __('auth.email_address') }}</label>
                    <input type="text" class="form-control rounded-0" readonly disabled value="{{ $user->email }}" />
                    <p class="form-text">Email address cannot be changed.</p>
                </div>

                {{-- username input --}}
                <div class="col-lg-6">
                    <label class="mb-1">{{ __('auth.username') }}</label>
                    <input type="text" class="form-control rounded-0" value="{{ $user->username }}" required name="username"/>
                    <p class="form-text">Change your username here.</p>
                </div>
            </div>

            {{-- bio text area --}}
            <label class="mb-1">Biography</label>
            <textarea name="bio" class="form-control rounded-0" rows="4" placeholder="Tell us about yourself..."></textarea>

            <button type="submit" class="btn btn-aabu rounded-0 px-5 mt-3">Save</button>
        </form>

        <hr>

        <h4 class="font-serif mt-3">Update Profile Picture</h4>
        {{-- avatar preview --}}
        <div class="d-flex gap-2 align-items-end">
            <img class="avatar-preview rounded-circle" src="{{ asset($user->getProfilePicture()) }}" alt="128x128 Preview" width="128" height="128" style="object-fit: cover">
            <img class="avatar-preview rounded-circle" src="{{ asset($user->getProfilePicture()) }}" alt="64x64 Preview" width="64" height="64" style="object-fit: cover">
            <img class="avatar-preview rounded-circle" src="{{ asset($user->getProfilePicture()) }}" alt="32x32 Preview" width="32" height="32" style="object-fit: cover">
        </div>

        <form action="{{ '/users/' . $user->id . '/update/pictures'}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input id="avatar-input" type="file" name="avatar" class="form-control mt-3 rounded-0"
                   accept="image/png, image/jpeg, image/bmp"/>
            <p class="form-text">.PNG, .JPEG, .BMP</p>

            <h4 class="font-serif mt-3">Update Cover Picture</h4>

            {{-- cover preview --}}
            <img class="cover-preview w-100" src="{{ asset($user->getCoverPicture()) }}" style="object-fit: cover; max-height: 250px">

            <input id="cover-input" type="file" name="cover" class="form-control mt-3 rounded-0"
                   accept="image/png, image/jpeg, image/bmp"/>
            <p class="form-text">.PNG, .JPEG, .BMP</p>
            <button type="submit" class="btn btn-aabu rounded-0 px-5 mb-3">Save</button>
        </form>
    </x-users.layout>
    <x-footer/>

    @push('scripts')
        <script src="{{ asset('js/settings.js') }}"></script>
    @endpush
</x-layout>


