<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    public function delete(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }

    public function update(User $user, Question $question): bool
    {
        /*
         * Verifica que seas el dueño de la pregunta y que no tenga respuestas ni comentarios.
         */
        $isOwner = $user->id === $question->user_id;

        $sEmpty = $question->answers()->count() === 0 && $question->comments()->count() === 0;

        return $isOwner && $sEmpty;
    }
}
