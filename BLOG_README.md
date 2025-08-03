# Blog Laravel

## Funcionalidades del Blog

El sistema de blog incluye las siguientes funcionalidades:

### 1. **Lista de Posts (Blog Index)**
- **Ruta**: `/blog`
- **Vista**: Muestra todos los posts del blog paginados
- **Características**:
  - Tarjetas de preview con título, autor, fecha y categoría
  - Extracto del contenido (limitado a 300 caracteres)
  - Botones de editar y eliminar
  - Enlace "Leer más"
  - Botón para crear nuevo post

### 2. **Ver Post Individual (Blog Show)**
- **Ruta**: `/blog/{id}`
- **Vista**: Muestra el post completo
- **Características**:
  - Título completo
  - Contenido completo con formato preservado
  - Información del autor y fecha
  - Categoría del post
  - Botones de editar y eliminar

### 3. **Crear Post (Blog Create)**
- **Ruta**: `/blog/create`
- **Vista**: Formulario para crear nuevo post
- **Campos**:
  - Título (requerido)
  - Categoría (requerido)
  - Contenido (requerido, textarea multilínea)

### 4. **Editar Post (Blog Edit)**
- **Ruta**: `/blog/{id}/edit`
- **Vista**: Formulario para editar post existente
- **Características**:
  - Formulario pre-poblado con datos actuales
  - Misma validación que crear

### 5. **Eliminar Post (Blog Destroy)**
- **Método**: DELETE via formulario
- **Confirmación**: JavaScript confirm dialog
- **Redirección**: De vuelta al índice del blog

## Estructura de Archivos

### Controlador
- `app/Http/Controllers/BlogController.php` - Controlador con todos los métodos CRUD

### Modelo
- `app/Models/Blog.php` - Modelo con relaciones a User y Category

### Vistas
- `resources/views/blog/index.blade.php` - Lista de posts
- `resources/views/blog/show.blade.php` - Post individual
- `resources/views/blog/create.blade.php` - Crear post
- `resources/views/blog/edit.blade.php` - Editar post

### Componentes Blade
- `resources/views/components/blog/card.blade.php` - Tarjeta de post para lista
- `resources/views/components/blog/form.blade.php` - Formulario reutilizable

### Rutas
```php
Route::resource('blog', BlogController::class);
```

Esto genera automáticamente todas las rutas RESTful:
- `GET /blog` → index
- `GET /blog/create` → create
- `POST /blog` → store
- `GET /blog/{blog}` → show
- `GET /blog/{blog}/edit` → edit
- `PUT /blog/{blog}` → update
- `DELETE /blog/{blog}` → destroy

## Base de Datos

### Tabla blogs
- `id` - Primary key
- `user_id` - Foreign key a users
- `category_id` - Foreign key a categories
- `title` - Título del post
- `content` - Contenido del post (text)
- `created_at` - Fecha de creación
- `updated_at` - Fecha de actualización

### Relaciones
- **Blog** pertenece a **User** (belongsTo)
- **Blog** pertenece a **Category** (belongsTo)

## Diseño y UI

- Utiliza el layout `app.blade.php` existente
- Diseño oscuro consistente con el resto de la aplicación
- Uso de Tailwind CSS para estilos
- Componentes reutilizables
- Responsive design
- Animaciones suaves (transitions)

## Navegación

El enlace "Blog" en la navbar principal ahora funciona y dirige a `/blog`.

## Datos de Prueba

El sistema incluye:
- `BlogFactory` para generar posts de prueba
- `BlogSeeder` para datos de ejemplo
- Integración con `DatabaseSeeder` existente

## Próximas Mejoras Sugeridas

1. **Autenticación**: Integrar con el sistema de auth de Laravel
2. **Autorización**: Solo permitir editar/eliminar posts propios
3. **Búsqueda**: Filtrar posts por título o contenido
4. **Filtros**: Filtrar por categoría o autor
5. **Comentarios**: Sistema de comentarios en posts
6. **Tags**: Sistema de etiquetas adicional a categorías
7. **Editor WYSIWYG**: Mejorar la experiencia de escritura
8. **Imágenes**: Subida y gestión de imágenes
9. **SEO**: URLs amigables y meta descriptions
10. **RSS**: Feed RSS para el blog
