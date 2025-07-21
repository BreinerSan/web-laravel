<h1>Titulo: {{ $question->title }}</h1>
<p>Pregunta: {{ $question->description }}</p>

<h2>Respuestas</h2>

<ul>
    @foreach($question->answers as $answer)
        <li>{{ $answer->content }}</li>
    @endforeach
</ul>
