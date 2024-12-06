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
                        <h2 class="font-serif">Verify Email</h2>
                        <p>We've sent an email to {{ auth()->user()->email }}</p>
                        <p>In order to continue, you must click the link provided to verify your account.</p>

                        <p class="text-secondary">Email not sent? <a href="/email/verify/send">Send Again</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth.layout>
