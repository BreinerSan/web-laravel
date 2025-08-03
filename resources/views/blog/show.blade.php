<x-forum.layouts.app>
    <div class="py-8">
        <div class="mb-6">
            <a href="{{ route('blog.index') }}"
               class="text-blue-400 hover:text-blue-300 text-sm">
                ← Volver al blog
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-600 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <article class="bg-neutral-800 rounded-lg p-8 border border-neutral-700">
            <header class="mb-8">
                <h1 class="text-3xl font-bold mb-4">{{ $blog->title }}</h1>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4 text-neutral-400">
                        <span>Por {{ $blog->user->name ?? 'Usuario' }}</span>
                        <span>•</span>
                        <span>{{ $blog->created_at->format('d M Y') }}</span>
                        <span>•</span>
                        <span class="px-2 py-1 bg-neutral-700 rounded text-xs">
                            {{ $blog->category->name ?? 'Sin categoría' }}
                        </span>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('blog.edit', $blog) }}"
                           class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm rounded transition-colors">
                            Editar
                        </a>
                        <form action="{{ route('blog.destroy', $blog) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('¿Estás seguro de eliminar este post?')"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded transition-colors">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="prose prose-invert max-w-none">
                <div class="text-neutral-200 leading-relaxed whitespace-pre-line">
                    {{ $blog->content }}
                </div>
            </div>
        </article>

        <div class="mt-8 text-center">
            <a href="{{ route('blog.index') }}"
               class="px-6 py-3 bg-neutral-700 hover:bg-neutral-600 text-white rounded-lg transition-colors">
                Ver más posts
            </a>
        </div>
    </div>
</x-forum.layouts.app>
