<x-auth.layout title="{{ $title }}" lang="{{ $locale }}">
    <div class="row w-100 justify-content-center mx-auto">
        <div class="col-lg-8 col-xl-7">
            <div class="row w-100 justify-content-center g-0 shadow-sm my-2">
                <div class="col-md-6 bg-aabu order-1">
                    <div class="p-3 d-flex flex-column h-100 justify-content-between">
                        <div class="text-center">
                            <h1>AABU Talk</h1>
                        </div>

                        <div class="my-2 text-center">
                            <img src="{{ asset('images/svgs/non-students.svg') }}" class="w-50">
                        </div>

                        <div class="d-flex w-75 justify-content-between align-items-end mx-auto">
                            <p class="mb-0">{{ __('auth.new_user') }}</p>
                            <a href="{{ getLocaleURL('/register') }}" class="btn btn-light px-3 rounded-pill">{{ __('auth.create_account') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-body-tertiary ">
                    <div class="p-3 h-100">
                        <form class="h-100" action="/login" method="POST">
                            <div class="d-flex flex-column justify-content-between h-100">
                                @csrf
                                <div>
                                    <h2 class="font-serif">{{ __('auth.login_non_student') }}</h2>
                                    {{-- student ID input --}}
                                    <label>{{ __('auth.email_address') }}</label>
                                    <input id="student-id" type="email" class="form-control rounded-0 mb-3" name="email"
                                           placeholder="email@example.com" required/>

                                    {{-- password & password confirmation inputs --}}
                                    <label>{{ __('auth.password_field') }}</label>
                                    <input id="password" type="password" class="form-control rounded-0 mb-2" name="password"
                                           minlength="6" placeholder="{{ __('auth.password_field') }}" required/>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember_me" value="" id="remember_me">
                                        <label class="form-check-label" for="remember_me">
                                            {{ __('auth.remember_me') }}
                                        </label>
                                    </div>
                                </div>

                                {{-- submit button --}}
                                <div class="d-flex justify-content-between align-items-end">
                                    <button type="submit" class="btn btn-aabu rounded-pill px-5">{{ __('common.login') }}</button>
                                    <a href="{{ getLocaleSwitchURL() }}"><i class="bi bi-globe me-2"></i>{{ __('common.language') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p><a href="{{ getLocaleURL('/login') }}">{{ __('common.login') }}</a></p>
        </div>
    </div>
</x-auth.layout>
