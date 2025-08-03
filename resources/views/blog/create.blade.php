<x-forum.layouts.app>
    <div class="py-8">
        <div class="mb-6">
            <a href="{{ route('blog.index') }}"
               class="text-blue-400 hover:text-blue-300 text-sm">
                ← Volver al blog
            </a>
        </div>

        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold mb-8">Crear nuevo post</h1>

            <x-blog.form
                :categories="$categories"
                :action="route('blog.store')"
            />
        </div>
    </div>
</x-forum.layouts.app>
