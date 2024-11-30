<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <x-users.layout :user="$user">
        @foreach($user->comments->all() as $comment)
            <x-posts.post-card :post="$comment->post"/>
        @endforeach
    </x-users.layout>
</x-layout>
