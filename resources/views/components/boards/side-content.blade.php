<div class="mt-3 mt-lg-0 position-sticky" style="top: 5rem">
    {{-- side column content goes here --}}
    <div class="bg-body-tertiary shadow-sm py-4 px-3">
        <h4 class="font-serif fst-italic">{{ $board->faculty->name() }}</h4>
        <p class="m-0">{{ $board->faculty->description() }}</p>
    </div>

    <h3 class="mt-3 fst-italic font-serif border-bottom">{{ __('page.see_also') }}</h3>
    <div class="list-group list-group-flush">
        @foreach($featuredPosts as $post)
            <x-boards.featured-post-list :post="$post"/>
        @endforeach
    </div>
</div>
