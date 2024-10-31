<x-auth.layout title="{{ $title }}" lang="{{ $locale }}">
    <div class="row w-100 justify-content-center mx-auto">
        <div class="col-lg-8 col-xl-7">
            <div class="row w-100 justify-content-center g-0 shadow-sm my-2">
                <div class="col-md-6 bg-aabu order-1">
                    <div class="p-3 d-flex flex-column h-100 justify-content-between">
                        <div class="text-center">
                            <h1>AABU Talk</h1>
                        </div>

                        <div class="px-5 py-2">
                            <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item text-center active">
                                        <div class="d-flex align-items-center justify-content-center flex-column" style="min-height: 340px">
                                            <img src="{{ asset('images/svgs/chatting.svg') }}" class="d-block mx-auto w-75" data-bs-interval="5000">
                                            <p class="mt-2 mb-0 fs-5">{{ __('auth.carousel_talk') }}</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex align-items-center justify-content-center flex-column" style="min-height: 340px">
                                            <img src="{{ asset('images/svgs/searching.svg') }}" class="d-block mx-auto w-75" data-bs-interval="5000">
                                            <p class="mt-2 mb-0 fs-5">{{ __('auth.carousel_search') }}</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex align-items-center justify-content-center flex-column" style="min-height: 340px">
                                            <img src="{{ asset('images/svgs/blogging.svg') }}" class="d-block mx-auto w-75" data-bs-interval="5000">
                                            <p class="mt-2 mb-0 fs-5">{{ __('auth.carousel_blogging') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ getLocaleURL('/login') }}" class="btn btn-light rounded-0">{{ __('auth.login_instead') }}</a>
                            <a href="{{ getLocaleURL('/') }}" class="btn btn-outline-light rounded-0">{{ __('auth.continue_guest') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-body-tertiary ">
                    <div class="p-3 h-100">
                        <form class="h-100" action="/register" method="POST">
                            <div class="d-flex flex-column justify-content-between h-100">
                                @csrf
                                <div>
                                    <h2 class="font-serif">{{ __('auth.create_account') }}</h2>
                                    {{-- student ID input --}}
                                    <label>{{ __('auth.student_id') }}</label>
                                    <input id="student-id" type="text" class="form-control rounded-0" name="student_id"
                                           placeholder="{{ __('auth.student_id_placeholder') }}" min="10" max="10" required/>
                                    <p class="text-secondary">
                                        {{ __('auth.student_id_desc') }}
                                    </p>

                                    {{-- password & password confirmation inputs --}}
                                    <label>{{ __('auth.password_field') }}</label>
                                    <input id="password" type="password" class="form-control rounded-0 mb-2" name="password"
                                           minlength="6" placeholder="{{ __('auth.password_field') }}" required/>

                                    <label>{{ __('auth.password_confirmation') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control rounded-0"
                                           name="password_confirmation" minlength="6" placeholder="{{ __('auth.password_confirmation') }}" required/>
                                    <p class="text-secondary">
                                        {{ __('auth.password_desc') }}
                                    </p>

                                    {{-- username input --}}
                                    <label>{{ __('auth.username') }}</label>
                                    <input id="username" type="text" class="form-control rounded-0 mb-2" name="username"
                                           placeholder="{{ __('auth.username') }}" required/>
                                    <p class="text-secondary">{{ __('auth.username_desc') }}</p>
                                </div>

                                {{-- submit button --}}
                                <div class="d-flex justify-content-between align-items-end">
                                    <button type="submit" class="btn btn-aabu rounded-0 px-5">{{ __('auth.register') }}</button>
                                    <a href="{{ getLocaleSwitchURL() }}"><i class="bi bi-globe me-2"></i>{{ __('common.language') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <p><a href="#">{{ __('auth.registration_request') }}</a></p>
        </div>
    </div>
</x-auth.layout>
