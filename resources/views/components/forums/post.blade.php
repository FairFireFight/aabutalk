<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <x-forums.layout header="{{ $forum }}">
        {{-- post --}}
        <div class="forum-list-card bg-body-tertiary px-3 py-2 mb-3">
            {{-- post title and pfp --}}
            <div class="mb-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="https://placehold.co/200x200" class="pfp-75 rounded" alt="Profile Picture">
                    <h2 class="font-serif mb-0">{{ $post }} title, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, sed.</h2>
                </div>
                <div class="d-flex gap-2 text-body-secondary">
                    <div>{{ __('common.by') }} <a href="#">Jane Droo</a></div>
                    <div>- 3:40pm - 10/29/2024</div>
                </div>
            </div>
            {{-- post content --}}
            <div>
                <p>This is an example of a post's content, displaying different types of formatting available to forum posters. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, minus nisi odio quis ratione reprehenderit tenetur. Dolorem minima nemo temporibus!</p>
                <h3 class="font-serif">A Header Example</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis dolores ducimus ex, pariatur repellat repellendus?</p>

                <ul>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>consectetur adipisicing elit. Culpa exercitationem</li>
                    <li>fugiat laboriosam quia veniam veritatis?</li>
                </ul>

                <h3 class="font-serif">An Image</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, explicabo!</p>

                <img class="img-fluid text-center"src="https://placehold.co/1376x768" alt="post image">
            </div>
        </div>

        {{-- comment form --}}
        <div class="forum-list-card bg-body-tertiary px-3 py-2 mb-2">
            <form class="position-relative" action="{{ getLocaleURL("/forums/forumId/postId") }}" method="POST">
                @csrf
                <textarea class="form-control" name="content" placeholder="{{ __('common.placeholder_thoughts') }}" required
                    oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';" style="overflow: hidden; resize: none; padding-bottom: 40px;"></textarea>
                <button type="submit" class="btn btn-sm btn-aabu px-5 rounded-pill position-absolute bottom-0 end-0 me-2 mb-2">
                    {{ __('common.post_verb') }}
                </button>
            </form>
        </div>

        {{-- comments --}}
        <div>
            <h3>4 {{__('common.comments')}}</h3>
            {{-- container --}}
            <div>
                @for($i = 1; $i <= 4; $i++)
                    <x-forums.comment></x-forums.comment>
                @endfor
            </div>
        </div>
    </x-forums.layout>
</x-layout>
