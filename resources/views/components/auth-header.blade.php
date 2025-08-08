@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <h1 class="text-2xl font-bold text-black dark:text-white mb-2">{{ $title }}</h1>
    <p>{{ $description }}</p>
</div>
