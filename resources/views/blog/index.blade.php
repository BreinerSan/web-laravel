<x-forum.layouts.app>
    <div class="py-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold">Blog</h1>
            <a href="{{ route('blog.create') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                Crear nuevo post
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-600 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($blogs->count() > 0)
            <div class="space-y-6">
                @foreach($blogs as $blog)
                    <x-blog.card :blog="$blog" />
                @endforeach
            </div>

            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-xl font-semibold mb-2">No hay posts en el blog</h3>
                <p class="text-neutral-400 mb-6">¡Sé el primero en compartir algo interesante!</p>
                <a href="{{ route('blog.create') }}"
                   class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Crear primer post
                </a>
            </div>
        @endif
    </div>
</x-forum.layouts.app>
