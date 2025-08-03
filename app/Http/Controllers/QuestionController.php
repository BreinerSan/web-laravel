<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function show(Question $question)
    {
        // Basicamente hace que a la consulta que ya existe agregale los datos de la categoria y el usuario
        $question->load('answers', 'category', 'user');

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
