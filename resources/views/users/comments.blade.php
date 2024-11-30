<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <x-users.layout :user="$user">
        @if($user->comments->count() === 0)
            <h4 class="text-center text-secondary fw-light mt-5">
                {{ __('profile.no_comments') }}
            </h4>
        @endif

        @foreach($user->comments->sortDesc()->all() as $comment)
            <div class="py-2 mb-2">
                <div class="d-flex gap-2">
                    <img src="{{ asset($comment->post->user->getProfilePicture()) }}" class="pfp-50 rounded-circle shadow-sm"/>

                    <div class="small">
                        <p class="text-secondary mb-0">
                            {{ __('profile.commented', ['user' => $comment->user->username]) }} - {{ $comment->created_at->diffForHumans() }}
                        </p>
                        <p class="mb-1">
                            {{ substr($comment->post->content, 0, 50) }}
                            {{ strlen($comment->post->content) > 50 ? '...' : ''}}

                            <span class="text-secondary"> | </span>

                            <a class="text-decoration-none" href="{{ getLocaleURL('/posts/' . $comment->post->id) }}">
                                {{ __('profile.view_post') }}
                            </a>
                        </p>
                        <p class="fw-light fs-5 mb-0">
                            {{ $comment->content }}
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-1">
        @endforeach
    </x-users.layout>
</x-layout>
