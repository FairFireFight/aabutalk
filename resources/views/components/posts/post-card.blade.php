<div class="pt-2 pb-1 border-top">
    <div class="d-flex gap-2">
        {{-- profile picture --}}
        <img src="https://placehold.co/100x100" class="pfp-60 shadow-sm rounded-circle mt-1">
        <div class="flex-grow-1 pb-3">
            {{-- post header --}}
            <div class="d-flex align-items-center">
                <div>
                    <p class="fs-4 mb-0"><a href="#" class="text-decoration-none">{{ $post->user->username }}</a></p>
                    <p class="text-secondary mb-0">Software Engineering</p>
                </div>
            </div>

            {{-- post content --}}
            <div class="mt-1">
                <a href="{{ getLocaleURL('/posts/' . $post->id) }}" class="text-reset text-decoration-none fs-5 fw-light lh-sm">
                    {{ $post->content }}
                </a>

                <x-posts.post-images :images="$post->getImagePaths()" :post="$post" />
            </div>
        </div>
    </div>

    {{-- post footer --}}
    <div class="pt-2 pb-1 border-top text-secondary">
        <div class="d-flex gap-4 align-items-center">
            <button class="btn btn-sm btn-outline-aabu py-0 px-4 rounded-pill">25 <i class="bi bi-hand-thumbs-up"></i></button>
            <p class="mb-0">14 {{ __('common.comments') }}</p>
            <p class="ms-auto mb-0">{{ $post->createdAt }}</p>
        </div>
    </div>
</div>
