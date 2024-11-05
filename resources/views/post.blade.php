<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <div class="row justify-content-center">
        <div class="col-8" style="min-height: calc(100vh - 4rem)">
            <div class="bg-body-tertiary p-3" style="min-height: 100%">
                <div class="d-flex gap-2 mb-3">
                    {{-- profile picture --}}
                    <img src="https://placehold.co/100x100" class="pfp-60 shadow-sm rounded-circle mt-1">
                    <div class="flex-grow-1">
                        {{-- post header --}}
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fs-4 mb-0"><a href="#" class="text-decoration-none">Hoffman Heller</a></p>
                                <p class="text-secondary mb-0">Software Engineering</p>
                            </div>
                            <div class="text-end ms-auto">

                            </div>
                        </div>

                        {{-- post content --}}
                        <div class="mt-1">
                            <p class="text-reset text-decoration-none fs-5 fw-light lh-sm">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Accusamus adipisci dolore exercitationem laborum, libero,
                                nihil officia possimus rem sed similique sit vel veritatis, voluptatem. Eligendi?
                            </p>
                            <div class="d-flex justify-content-center mx-auto mb-2 mt-2">
                                <img src="https://placehold.co/768x480" class="img-fluid" style="max-height: 32rem;" />
                            </div>
                        </div>

                        {{-- post footer --}}
                        <div class="text-secondary d-flex gap-4 align-items-end justify-content-between">
                            <button class="btn btn-outline-aabu py-0 px-4 rounded-pill">25 <i class="bi bi-hand-thumbs-up"></i></button>
                            <p class="mb-0">9:23pm - 11/1/2024</p>
                        </div>
                    </div>
                </div>

                <h2 class="font-serif border-bottom pb-2">12 {{ __('common.comments') }}</h2>

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
