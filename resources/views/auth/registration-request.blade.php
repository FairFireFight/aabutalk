<x-auth.layout title="{{ $title }}" lang="{{ $locale }}">
    <div class="row w-100 justify-content-center mx-auto">
        <div class="col-lg-8 col-xl-7">
            <div class="row w-100 justify-content-center g-0 shadow-sm my-2">
                <div class="col-md-6 bg-aabu order-1">
                    <div class="p-3 d-flex flex-column h-100 justify-content-around">
                        <div class="text-center">
                            <h1>AABU Talk</h1>
                        </div>

                        <div class="my-2 text-center w-75 mx-auto">
                            <img src="{{ asset('images/svgs/request.svg') }}" class="w-75 mb-3">
                            <p class="fs-5">{{ __('auth.request_note') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-body-tertiary ">
                    <div class="p-3 h-100">
                        <form class="h-100" action="/register/request" method="POST">
                            <div class="d-flex flex-column justify-content-between h-100">
                                @csrf
                                <div>
                                    <h2 class="font-serif">{{ __('auth.registration_request_header') }}</h2>
                                    {{-- student ID input --}}
                                    <label>{{ __('auth.email_address') }}</label>
                                    <input id="student-id" type="email" class="form-control rounded-0" name="email"
                                           placeholder="email@example.com" required value="{{ old('email') }}"/>

                                    @error('email')
                                        <p class="text-danger">Email is already in use</p>
                                    @enderror

                                    {{-- password & password confirmation inputs --}}
                                    <label>{{ __('auth.password_field') }}</label>
                                    <input id="password" type="password" class="form-control rounded-0 mb-0" name="password"
                                           minlength="6" placeholder="{{ __('auth.password_field') }}" required/>

                                    <label>{{ __('auth.password_confirmation') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control rounded-0 mt-2"
                                           name="password_confirmation" minlength="6" placeholder="{{ __('auth.password_confirmation') }}" required/>
                                    @error('password')
                                        <p class="text-danger mb-0">Passwords do not match</p>
                                    @enderror
                                    <p class="text-secondary mb-2">
                                        {{ __('auth.password_desc') }}
                                    </p>

                                    {{-- username input --}}
                                    <label>{{ __('auth.username') }}</label>
                                    <input id="username" type="text" class="form-control rounded-0" name="username"
                                           placeholder="{{ __('auth.username') }}" required value="{{ old('username') }}"/>
                                    <p class="text-secondary mb-3">{{ __('auth.username_desc') }}</p>

                                    <label>{{ __('auth.dropdown_label') }}</label>
                                    <select name="category" id="category" class="form-select rounded-0 mb-3" required>
                                        <option value="">{{ __('auth.please_select') }}</option>
                                        <option value="professor">{{ __('auth.professor') }}</option>
                                        <option value="employee">{{ __('auth.employee') }}</option>
                                        <option value="business_owner">{{ __('auth.business_owner') }}</option>
                                        <option value="other">{{ __('auth.other') }}</option>
                                    </select>

                                    <label>{{ __('auth.textarea_label') }}  </label>
                                    <textarea class="form-control mb-3 rounded-0" name="details" required>{{ old('details') }}</textarea>
                                </div>

                                {{-- submit button --}}
                                <div class="d-flex justify-content-between align-items-end">
                                    <button type="submit" class="btn btn-aabu rounded-0 px-5">{{ __('auth.submit_application') }}</button>
                                    <a href="{{ getLocaleSwitchURL() }}"><i class="bi bi-globe me-2"></i>{{ __('common.language') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth.layout>
