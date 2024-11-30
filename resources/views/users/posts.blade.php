<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <x-users.layout :user="$user">
        @if($user->posts->count() === 0)
            <h4 class="text-center text-secondary fw-light mt-5">
                User Has No Posts
            </h4>
        @endif

        @foreach($user->posts->sortDesc()->all() as $post)
            <x-posts.post-card :post="$post"/>
        @endforeach
    </x-users.layout>
</x-layout>
