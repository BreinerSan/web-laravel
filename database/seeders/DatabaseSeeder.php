<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Blog;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(19)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'dev@test.com',
        ]);

        $categories = Category::factory(4)->create();

        // La sentencia fn() => basicamente es una funcion inferida o funcion flecha el cual hace que se ejecute la funcion cada vez que se crea un usuario
        $questions = Question::factory(30)->create([
            'category_id' => fn() => $categories->random()->id,
            'user_id' => fn() => User::inRandomOrder()->first()->id
        ]);

        $answers = Answer::factory(50)->create([
            'question_id' => fn() => $questions->random()->id,
            'user_id' => fn() => User::inRandomOrder()->first()->id
        ]);

        Comment::factory(100)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,
            'commentable_id' => $answers->random()->id,
            'commentable_type' => Answer::class
        ]);

        Comment::factory(100)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,
            'commentable_id' => $questions->random()->id,
            'commentable_type' => Question::class
        ]);

        Blog::factory(5)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,
            'category_id' => fn() => $categories->random()->id
        ]);
    }
}
