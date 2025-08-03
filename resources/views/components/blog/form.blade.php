@props(['blog' => null, 'categories', 'method' => 'POST', 'action'])

<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label for="title" class="block text-sm font-medium mb-2">Título</label>
        <input type="text"
               id="title"
               name="title"
               value="{{ old('title', $blog?->title) }}"
               class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white"
               placeholder="Ingresa el título del post..."
               required>
        @error('title')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium mb-2">Categoría</label>
        <select id="category_id"
                name="category_id"
                class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white"
                required>
            <option value="">Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        {{ old('category_id', $blog?->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="content" class="block text-sm font-medium mb-2">Contenido</label>
        <textarea id="content"
                  name="content"
                  rows="10"
                  class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white resize-vertical"
                  placeholder="Escribe el contenido de tu post..."
                  required>{{ old('content', $blog?->content) }}</textarea>
        @error('content')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-4">
        <button type="submit"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
            {{ $blog ? 'Actualizar post' : 'Publicar post' }}
        </button>
        <a href="{{ $blog ? route('blog.show', $blog) : route('blog.index') }}"
           class="px-6 py-2 bg-neutral-600 hover:bg-neutral-700 text-white rounded-lg transition-colors">
            Cancelar
        </a>
    </div>
</form>
