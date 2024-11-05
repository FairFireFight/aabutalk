<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-10 col-xxl-8" style="min-height: calc(100vh - 4rem)">
            <div class="bg-body-tertiary p-3" style="min-height: 100%">
                <div class="d-flex gap-2">
                    {{-- profile picture --}}
                    <img src="https://placehold.co/100x100" class="pfp-60 shadow-sm rounded-circle mt-1">
                    <div class="flex-grow-1">
                        {{-- post header --}}
                        <div class="d-flex align-items-start">
                            <div>
                                <p class="fs-4 mb-0"><a href="#" class="text-decoration-none">{{ $post->user->username }}</a></p>
                                <p class="text-secondary mb-0">Software Engineering</p>
                            </div>
                            <div class="text-end text-secondary ms-auto">
                                11/1/2024<br>
                                9:23pm
                            </div>
                        </div>

                        {{-- post content --}}
                        <div class="mt-1">
                            <p class="text-reset text-decoration-none fs-5 fw-light lh-sm">
                                {{ $post->content }}
                            </p>

                            <x-posts.post-images :images="$post->getImagePaths()" :post="$post" />
                        </div>
                    </div>
                </div>

                <div class="d-flex py-2 border-bottom align-items-end">
                    <h2 class="font-serif me-auto mb-0">12 {{ __('common.comments') }}</h2>
                    <button class="btn btn-outline-aabu py-0 my-1 px-4 rounded-pill">25 <i class="bi bi-hand-thumbs-up"></i></button>
                </div>

                {{-- comment form --}}
                @auth
                    <div class="forum-list-card bg-body-tertiary py-2 mb-2">
                        <form class="position-relative" action="{{ getLocaleURL("/forums/forumId/postId") }}" method="POST">
                            @csrf
                            <textarea class="form-control" name="content" placeholder="{{ __('common.placeholder_thoughts') }}" required
                                      oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';" style="overflow: hidden; resize: none; padding-bottom: 40px;"></textarea>
                            <button type="submit" class="btn btn-sm btn-aabu px-5 rounded-pill position-absolute bottom-0 end-0 me-2 mb-2">
                                {{ __('common.post_verb') }}
                            </button>
                        </form>
                    </div>
                @endauth

                {{-- comments container --}}
                <div id="comments-container">
                    @for ($i = 1; $i <= 6; $i++)
                        <x-posts.comment />
                    @endfor
                </div>
            </div>
        </div>
    </div>
</x-layout>
