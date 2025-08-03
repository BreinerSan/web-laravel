<x-forum.layouts.app>
    <div class="py-8">
        <div class="mb-6">
            <a href="{{ route('blog.show', $blog) }}"
               class="text-blue-400 hover:text-blue-300 text-sm">
                ← Volver al post
            </a>
        </div>

        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold mb-8">Editar post</h1>

            <x-blog.form
                :blog="$blog"
                :categories="$categories"
                :action="route('blog.update', $blog)"
                method="PUT"
            />
        </div>
    </div>
</x-forum.layouts.app>
