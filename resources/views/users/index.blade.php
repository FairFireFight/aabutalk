<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-10 col-xxl-8">
            <h1 class="mb-3 pb-1 border-bottom font-serif">People</h1>

            <h4 class="font-serif">People you may know</h4>
            <div class="w-100 d-flex flex-nowrap overflow-x-auto pb-3 gap-3">
                @for($i = 0; $i < 6; $i++)
                    <x-users.user-card-large/>
                @endfor
            </div>

            <hr class="mt-1 mb-3">

            <h4 class="font-serif">Search people</h4>
            <form class="mb-2" action="{{ getLocaleURL('/users') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="query">
                    <button class="btn btn-aabu px-3 py-0" type="submit"><i class="bi bi-search fs-5"></i></button>
                </div>
            </form>

            <div>
                <p class="my-2 text-secondary">Showing first 10 results</p>
                @for($i = 0; $i < 10; $i++)
                    <x-users.user-card-list/>
                @endfor
            </div>

            <x-footer/>
        </div>
    </div>
</x-layout>
