<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-10 col-xxl-8">
            <h1 class="mb-3 pb-1 border-bottom font-serif">{{ __('common.people') }}</h1>

            @if($recommendedUsers !== null)
                <h4 class="font-serif">{{ __('profile.people_recommended') }}</h4>
                <div class="w-100 d-flex flex-nowrap overflow-x-auto pb-3 gap-3">
                    @foreach($recommendedUsers as $user)
                        <x-users.user-card-large :user="$user"/>
                    @endforeach
                </div>

                <hr class="mt-1 mb-3">
            @endif

            <h4 class="font-serif">{{ __('profile.search') }}</h4>
            <form class="mb-2" action="{{ getLocaleURL('/users') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded-0" placeholder="{{ __('profile.search_placeholder') }}" name="query" value="{{ $query ?? '' }}">
                    <button class="btn btn-aabu px-3 py-0 rounded-0" type="submit"><i class="bi bi-search fs-5"></i></button>
                </div>
            </form>

            <div>
                @if($query && $results->count() === 10)
                    <p class="my-2 text-secondary">{{ __('profile.first_ten') }}</p>
                @endif
                @if($results === null)
                    <h3 class="text-center text-secondary my-5 fw-light">{{ __('profile.search') }}</h3>
                @else
                    @if($results->isEmpty())
                        <h3 class="text-center text-secondary my-5 fw-light">{{ __('common.no_results') }}</h3>
                    @else
                        @foreach($results as $user)
                            <x-users.user-card-list :user="$user"/>
                        @endforeach
                    @endif
                @endif
            </div>

            <x-footer/>
        </div>
    </div>
</x-layout>
