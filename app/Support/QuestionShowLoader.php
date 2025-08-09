<?php

namespace App\Support;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionShowLoader
{
    public function load(Question $question): Question
    {
        return $question->load($this->getRelations());
    }

    public function getRelations(): array
    {
        $userId = Auth::id();

        // Cargamos las relaciones necesarias para mostrar la pregunta
        return [
            'user',
            'category',

            'answers' => fn ($query) => $query->with([
                'user',
                'hearts' => fn ($query) => $query->where('user_id', $userId),
                'comments' => fn ($query) => $query->with([
                    'user',
                    'hearts' => fn ($query) => $query->where('user_id', $userId),
                ])
            ]),

            'comments' => fn ($query) => $query->with([
                'user',
                'hearts' => fn ($query) => $query->where('user_id', $userId),
            ]),

            'hearts' => fn ($query) => $query->where('user_id', $userId),
        ];
    }
}
