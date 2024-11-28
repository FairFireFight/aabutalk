@php use Illuminate\Support\Facades\Auth; @endphp
<div class="pt-2 pb-1 border-bottom">
    <div class="d-flex gap-2">
        {{-- profile picture --}}
        <img src="{{ $post->user->getProfilePicture() }}" class="pfp-60 shadow-sm rounded-circle mt-1">
        <div class="flex-grow-1 pb-3">
            {{-- post header --}}
            <div class="d-flex align-items-center">
                <div>
                    <p class="fs-4 mb-0"><a href="{{ getLocaleURL('/users/' . $post->user->id) }}" class="text-decoration-none">{{ $post->user->username }}</a></p>
                    <p class="text-secondary mb-0">{{ $post->user->major() }}</p>
                </div>
            </div>

            {{-- post content --}}
            <div class="mt-1">
                <a href="{{ getLocaleURL('/posts/' . $post->id) }}" class="d-block text-reset text-decoration-none fs-5 fw-light lh-sm">
                    {{ $post->content }}
                </a>

                <x-posts.post-images :images="$post->getImagePaths()" :post="$post" />
            </div>
        </div>
    </div>

    {{-- post footer --}}
    <div class="pt-2 pb-1 text-secondary">
        <div class="d-flex gap-3 align-items-center">
            @auth
                @php
                    $liked = Auth::user()->likesPost($post)
                @endphp

                <button onclick="likePost(this)" id="{{ $post->id }}"
                        class="btn btn-sm {{ $liked ? 'btn-aabu' : 'btn-outline-aabu' }} py-0 px-4 rounded-pill">
                    {{  $post->likes()->count() }} <i class="bi bi-hand-thumbs-up"></i>
                </button>
            @endauth
            @guest
                <p class="mb-0">{{ $post->likes()->count()  }} <i class="bi bi-hand-thumbs-up"></i></p>
            @endguest

            <p class="mb-0">{{ $post->comments()->count() . ' ' . __('common.comments') }}</p>
            <div class="ms-auto mb-0 d-flex align-items-center gap-2">
                @can('delete-post', $post)
                    <x-delete-button action="{{ '/posts/' . $post->id }}" />
                @endcan
                {{ $post->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
</div>
