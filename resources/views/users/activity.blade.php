<x-layout title="{{ $title }}" lang="{{ $locale }}">
    <x-users.layout :user="$user">
        @foreach($user->posts->all() as $post)
            <x-posts.post-card :post="$post"/>
        @endforeach
    </x-users.layout>
</x-layout>
