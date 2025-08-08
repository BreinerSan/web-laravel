<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Comment extends Component
{
    public Model $commentable;
    public bool $showForm = false;
    public string $content = '';

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function addComment(){
        $this->validate([
            'content' => 'required|string|max:255',
        ]);

        $this->commentable->comments()->create([
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);

        $this->content = '';
        $this->showForm = false;

        // Otra opcion es
        $this->reset('content', 'showForm');
    }

    public function render()
    {
        return view('livewire.comment', [
            'comments' => $this->commentable->comments
        ]);
    }
}
