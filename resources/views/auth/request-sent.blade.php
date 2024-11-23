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
                    </div>
                </div>
                <div class="col-md-6 bg-body-tertiary ">
                    <div class="p-3 h-100">
                        <h2 class="font-serif mb-4">{{ __('auth.registration_request_header') }}</h2>
                        <h5>{{ __('auth.request_sent') }}</h5>
                        <h5 class="mb-4">{{ __('auth.request_sent_body') }}</h5>
                        <p>{{ __('auth.meantime') }} <a href="{{ getLocaleURL('/') }}">{{ __('auth.continue_guest') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth.layout>
