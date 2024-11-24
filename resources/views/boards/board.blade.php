<x-layout title="{{ $board->faculty->name() }}" lang="{{ $lang }}">
    {{-- Leading card--}}
    <div class="mt-3 px-2 px-md-3 px-lg-5 py-4 bg-body-secondary border">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column">
                <h1 class="font-serif fst-italic fw-semibold">Title of a longer featured blog post</h1>
                <h5 class="mb-4 fw-light">Multiple lines of text that form the lede, informing new readers quickly and
                    efficiently about what’s most interesting in this post’s contents. Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Accusamus id, nam officiis pariatur quod sed.</h5>
                <a href="#" class="mb-3 mb-lg-0 fs-4 mt-auto icon-link icon-link-hover">{{ __('common.read_more') }}<i
                        class="bi bi-arrow-right mb-2"></i></a>
            </div>
            <div class="d-flex col-lg-6 align-items-center justify-content-center">
                <img src="https://placehold.co/600x400/white/black" alt="image" class="img-fluid shadow-sm"
                     style="width: 100%; max-height: 400px; object-fit: cover">
            </div>
        </div>
    </div>

    {{-- Secondary cards --}}
    <div class="row gx-3 mt-3">
        <div class="col-md-6">
            <div class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm">
                <div class="col p-4 d-flex flex-column">
                    <h3 class="mb-0 font-serif">Featured post</h3>
                    <div class="mb-1 text-body-secondary">Nov 12</div>
                    <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to
                        additional content.</p>
                    <a href="#" class="icon-link icon-link-hover">
                        {{ __('common.read_more') }}<i class="bi bi-arrow-right mb-1"></i>
                    </a>
                </div>
                <div class="col-5 d-none d-xl-block">
                    <img src="https://placehold.co/400x400/444/FFF?text=Thumbnail"
                         style="width: 100%; height: 250px; object-fit: cover">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm">
                <div class="col p-4 d-flex flex-column">
                    <h3 class="mb-0 font-serif">Featured post</h3>
                    <div class="mb-1 text-body-secondary">Nov 12</div>
                    <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to
                        additional content.</p>
                    <a href="#" class="icon-link icon-link-hover">
                        {{ __('common.read_more') }}<i class="bi bi-arrow-right mb-1"></i>
                    </a>
                </div>
                <div class="col-5 d-none d-xl-block">
                    <img src="https://placehold.co/400x400/444/FFF?text=Thumbnail" alt="image"
                         style="width: 100%; height: 250px; object-fit: cover">
                </div>
            </div>
        </div>
    </div>

    {{-- Main content section --}}
    <div class="row">
        {{-- main content coloumn --}}
        <div class="col-lg-8">
            <h3 class="fst-italic font-serif">{{ __('page.latest_by', ['name' => $board->faculty->name()]) }}</h3>

            <div id="posts-container" class="mb-3">
                @foreach($posts as $post)
                    <hr class="mt-3 mb-2">
                    <x-boards.post :post="$post"/>
                @endforeach
            </div> {{-- /boards container --}}

            <div>
                {{ $posts->links('components.pagination') }}
            </div>
        </div>

        {{-- secondary coloumn --}}
        <div class="col-lg-4">
            @can('create-board-post', $board)
                <a href="{{ getLocaleURL('/boards/' . $board->id . '/create') }}" class="btn btn-aabu rounded-pill mb-3 w-100">
                    {{ __('forums.create_post') }}
                </a>
            @endcan
            <x-boards.side-content :board="$board"/>
        </div>
    </div>

    <x-footer/>
</x-layout>
