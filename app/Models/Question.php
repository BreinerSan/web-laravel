<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHeart;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory, HasHeart;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Metodo propio de laravel que se ejecuta cuando se elimina un modelo
    protected static function booted()
    {
        static::deleting(function ($question){
            $question->hearts()->delete();

            $question->comments()->get()->each(function ($comment) {
                // Elimino los corazones
                $comment->hearts()->delete();
                // Elimina cada comentario asociado a la pregunta
                $comment->delete();
            });

            // Elimina las respuestas asociadas a la pregunta
            $question->answers()->get()->each(function ($answer) {
                // Elimino los corazones de las respuestas
                $answer->hearts()->delete();
                // Elimino los comentarios de las respuestas
                $answer->comments()->get()->each(function ($comment) {
                    $comment->hearts()->delete();
                    $comment->delete();
                });
                // Elimina cada respuesta asociada a la pregunta
                // $answer->delete();
            });
        });
    }

}
