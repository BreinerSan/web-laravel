<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Requests\StoreQuestion;
use App\Http\Requests\UpdateQuestion;
use App\Support\QuestionShowLoader;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::with([
            'user',
            'category'
        ])->latest()->paginate(24);

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('questions.create', compact('categories'));
    }

    public function store(StoreQuestion $request)
    {
        $question = new Question();
        $question->user_id = auth()->id();
        $question->category_id = $request->category_id;
        $question->title = $request->title;
        $question->description = $request->description;
        $question->save();

        return redirect()->route('questions.show', $question)->with('success', 'Pregunta creada exitosamente.');
    }

    public function edit(Question $question){

        $categories = Category::all();
        return view('questions.edit', compact('question', 'categories'));
    }

    public function update(UpdateQuestion $request, Question $question)
    {
        // Verifica si el usuario autenticado es el propietario de la pregunta (Esta validación esta en un Policy)
        // if (auth()->user()->id !== $question->user_id) {
        //     return redirect()->route('questions.show', $question)->with('error', 'No tienes permiso para editar esta pregunta.');
        // }

        $question->category_id = $request->category_id;
        $question->title = $request->title;
        $question->description = $request->description;
        $question->save();

        return redirect()->route('questions.show', $question)->with('success', 'Pregunta actualizada exitosamente.');
    }

    public function show(Question $question, QuestionShowLoader $loader)
    {
        $loader->load($question);

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
