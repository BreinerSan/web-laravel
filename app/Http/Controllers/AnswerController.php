<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $question->answers()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);

        // Redirect back to the question page
        return back();
    }
}
