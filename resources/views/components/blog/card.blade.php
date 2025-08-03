@props(['blog'])

<article class="bg-neutral-800 rounded-lg p-6 border border-neutral-700 hover:border-neutral-600 transition-colors">
    <div class="flex items-start justify-between mb-4">
        <div class="flex-1">
            <h2 class="text-xl font-semibold mb-2">
                <a href="{{ route('blog.show', $blog) }}"
                   class="text-white hover:text-blue-400 transition-colors">
                    {{ $blog->title }}
                </a>
            </h2>

            <div class="flex items-center gap-4 text-sm text-neutral-400">
                <span>Por {{ $blog->user->name ?? 'Usuario' }}</span>
                <span>•</span>
                <span>{{ $blog->created_at->diffForHumans() }}</span>
                <span>•</span>
                <span class="px-2 py-1 bg-neutral-700 rounded text-xs">
                    {{ $blog->category->name ?? 'Sin categoría' }}
                </span>
            </div>
        </div>
    </div>

    <div class="prose prose-invert max-w-none mb-4">
        <p class="text-neutral-300">
            {{ Str::limit($blog->content, 300) }}
        </p>
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('blog.show', $blog) }}"
           class="text-blue-400 hover:text-blue-300 text-sm font-medium">
            Leer más →
        </a>

        <div class="flex gap-2">
            <a href="{{ route('blog.edit', $blog) }}"
               class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white text-xs rounded transition-colors">
                Editar
            </a>
            <form action="{{ route('blog.destroy', $blog) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('¿Estás seguro de eliminar este post?')"
                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs rounded transition-colors">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</article>
