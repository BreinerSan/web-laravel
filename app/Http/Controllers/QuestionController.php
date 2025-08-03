<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function show(Question $question)
    {

        $userId = 20;

        // Obtenemos la pregunta con las relaciones necesarias
        $question->load([
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
        ]);

        return view('questions.show', compact('question'));
    }

    public function destroy(Question $question)
    {
        // Verifica si el usuario autenticado es el propietario de la pregunta
        // if (auth()->user()->id !== $question->user_id) {
        //     return redirect()->route('questions.show', $question)->with('error', 'No tienes permiso para eliminar esta pregunta.');
        // }

        // Elimina la pregunta
        $question->delete();

        return redirect()->route('home');
    }
}
