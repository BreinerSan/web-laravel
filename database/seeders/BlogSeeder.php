<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Crear categorías si no existen
        $categories = [
            'Tecnología',
            'Programación',
            'Web Development',
            'Mobile',
            'DevOps',
            'Tutorial',
            'Noticias',
            'Opinión'
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }

        // Crear algunos blogs de ejemplo
        $user = User::first() ?? User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com'
        ]);

        $sampleBlogs = [
            [
                'title' => 'Introducción a Laravel 11',
                'content' => "Laravel 11 trae muchas mejoras y nuevas características que lo hacen aún más poderoso y fácil de usar.\n\nEntre las principales novedades encontramos:\n\n• Mejor rendimiento en las consultas Eloquent\n• Nuevas validaciones más robustas\n• Mejoras en el sistema de caching\n• Actualizaciones en Blade para mejor performance\n\nEste framework continúa siendo una de las mejores opciones para desarrollo web con PHP, ofreciendo una sintaxis elegante y herramientas poderosas para crear aplicaciones modernas.",
                'category' => 'Programación'
            ],
            [
                'title' => 'Mejores prácticas en desarrollo web',
                'content' => "El desarrollo web moderno requiere seguir ciertas prácticas que garanticen la calidad, mantenibilidad y escalabilidad de nuestros proyectos.\n\nAlgunas de las mejores prácticas incluyen:\n\n• Usar control de versiones (Git)\n• Escribir código limpio y bien documentado\n• Implementar testing automatizado\n• Seguir principios SOLID\n• Usar herramientas de linting y formateo\n• Implementar CI/CD\n\nEstas prácticas no solo mejoran la calidad del código, sino que también facilitan el trabajo en equipo y la entrega continua de valor.",
                'category' => 'Web Development'
            ],
            [
                'title' => 'El futuro de la inteligencia artificial',
                'content' => "La inteligencia artificial está transformando la manera en que desarrollamos software y creamos soluciones tecnológicas.\n\nVemos avances significativos en:\n\n• Asistentes de código como GitHub Copilot\n• Generación automática de tests\n• Optimización de consultas de base de datos\n• Detección automática de bugs\n• Mejoras en la experiencia de usuario\n\nLos desarrolladores que se adapten a estas herramientas tendrán una ventaja competitiva significativa en el mercado laboral.",
                'category' => 'Tecnología'
            ]
        ];

        foreach ($sampleBlogs as $blogData) {
            $category = Category::where('name', $blogData['category'])->first();

            Blog::create([
                'title' => $blogData['title'],
                'content' => $blogData['content'],
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        }
    }
}
