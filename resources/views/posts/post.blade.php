@push('scripts')
    <script src="{{ asset('js/likePost.js') }}"></script>
@endpush


@php
    use Illuminate\Support\Facades\Auth;

    $comments = $post->comments()->getResults()->sortDesc();
    $commentsCount = $comments->count();
@endphp

<x-layout title="{{ $title }}" lang="{{ $lang }}">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-10 col-xxl-8" style="min-height: calc(100vh - 4rem)">
            <div class="bg-body-tertiary p-3" style="min-height: 100%">
                <div class="d-flex gap-2">
                    {{-- profile picture --}}
                    <img src="{{ $post->user->getProfilePicture() }}" class="pfp-60 shadow-sm rounded-circle mt-1">
                    <div class="flex-grow-1">
                        {{-- post header --}}
                        <div class="d-flex align-items-start">
                            <div>
                                <p class="fs-4 mb-0"><a href="{{ getLocaleURL('/users/' . $post->user->id) }}" class="text-decoration-none">{{ $post->user->username }}</a></p>
                                <p class="text-secondary mb-0">{{ $post->user->major() }}</p>
                            </div>
                            <div class="text-end text-secondary ms-auto">
                                {{ $post->created_at->diffForHumans() }}
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
                    <h2 class="font-serif me-auto mb-0">{{ "$commentsCount " . __('common.comments') }}</h2>

                    <div class="d-flex gap-2">
                        @auth
                            @php
                                $liked = Auth::user()->likesPost($post);
                            @endphp

                            <button onclick="likePost(this)" id="{{ $post->id }}"
                                    class="btn {{ $liked ? 'btn-aabu' : 'btn-outline-aabu' }} py-0 my-1 px-4 rounded-pill">
                                    {{ $post->likes()->count() }} <i class="bi bi-hand-thumbs-up"></i>
                            </button>
                        @endauth

                        @guest
                            <button class="btn btn-outline-aabu py-0 my-1 px-4 rounded-pill" disabled>
                                {{  $post->likes()->count() }} <i class="bi bi-hand-thumbs-up"></i>
                            </button>
                        @endguest

                        @can('delete-post', $post)
                            <x-delete-button action="{{ '/posts/' . $post->id }}" />
                        @endcan
                    </div>
                </div>

                {{-- comment form --}}
                @auth
                    <div class="forum-list-card bg-body-tertiary py-2 mb-2">
                        <form class="position-relative" action="{{ "/posts/{$post->id}/comments" }}" method="POST">
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
                    @if($commentsCount == 0)
                        <div class="d-flex justify-content-center text-secondary fs-4 mt-3">{{ __('common.no_comments') }}</div>
                    @else
                        @foreach ($comments as $comment)
                            <x-posts.comment :comment="$comment"/>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
