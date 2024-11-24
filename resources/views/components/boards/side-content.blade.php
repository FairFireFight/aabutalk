<div class="mt-3 mt-lg-0 position-sticky" style="top: 5rem">
    {{-- side column content goes here --}}
    <div class="bg-body-tertiary shadow-sm py-4 px-3">
        <h4 class="font-serif fst-italic">{{ $board->faculty->name() }}</h4>
        <p class="m-0">{{ $board->faculty->description() }}</p>
    </div>

    <h3 class="mt-3 fst-italic font-serif border-bottom">{{ __('page.see_also') }}</h3>
    <div class="list-group list-group-flush">
        @for($i = 0; $i < 4; $i++)
            <div class="list-group-item">
                <div class="row">
                    <div class="col-4 p-0">
                        <img src="https://placehold.co/100x100" style="width: 100%; height: 100%; object-fit: cover">
                    </div>
                    <div class="col d-flex flex-column justify-content-center ps-3">
                        <a href="#" class="fs-5 font-serif mb-0">Post Title</a>
                        <p class="text-body-secondary m-0">10/24/2024</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
