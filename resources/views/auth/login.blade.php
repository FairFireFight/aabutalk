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
                            <img src="{{ asset('images/svgs/new_user.svg') }}" class="w-75">
                        </div>

                        <div class="d-flex w-75 justify-content-between align-items-end mx-auto">
                            <p class="mb-0">{{ __('auth.new_user') }}</p>
                            <a href="{{ getLocaleURL('/register') }}" class="btn btn-light rounded-0">{{ __('auth.create_account') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-body-tertiary ">
                    <div class="p-3 h-100">
                        <form class="h-100" action="/login" method="POST">
                            <div class="d-flex flex-column justify-content-between h-100">
                                @csrf
                                <div>
                                    <h2 class="font-serif">{{ __('common.login') }}</h2>
                                    {{-- student ID input --}}
                                    <label>{{ __('auth.student_id') }}</label>
                                    <input id="student-id" type="text" class="form-control rounded-0 mb-3" name="student_id"
                                           placeholder="{{ __('auth.student_id_placeholder') }}" min="10" max="10" required/>

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
                                    <button type="submit" class="btn btn-aabu rounded-0 px-5">{{ __('common.login') }}</button>
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
