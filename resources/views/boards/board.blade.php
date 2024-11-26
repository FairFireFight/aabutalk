<x-layout title="{{ $board->faculty->name() }}" lang="{{ $lang }}">
    {{-- Leading card --}}

    {{-- Secondary cards --}}
    <div class="row gx-3 mt-3">
        <x-boards.featured-card-small/>
        <x-boards.featured-card-small/>
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

                    @if($board->id != 0)
                        <a href="{{ getLocaleURL('/forums/' . $board->faculty->forum->id . '/posts/' . $post->forum_post_id) }}">
                            {{ __('forums.discuss_on_forum') }}
                        </a>
                    @endif
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
