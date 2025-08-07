<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Question;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $question = new Question();
        $question->user_id = 20;
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

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Verifica si el usuario autenticado es el propietario de la pregunta
        // if (auth()->user()->id !== $question->user_id) {
        //     return redirect()->route('questions.show', $question)->with('error', 'No tienes permiso para editar esta pregunta.');
        // }

        $question->category_id = $request->category_id;
        $question->title = $request->title;
        $question->description = $request->description;
        $question->save();

        return redirect()->route('questions.show', $question)->with('success', 'Pregunta actualizada exitosamente.');
    }

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
