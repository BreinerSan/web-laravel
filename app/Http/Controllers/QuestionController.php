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
}
