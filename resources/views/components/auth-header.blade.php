@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <h1 size="xl">{{ $title }}</h1>
    <p>{{ $description }}</p>
</div>
