<?php //use GrahamCampbell\Markdown\Facades\Markdown; ?>

<h2>Viewing a book</h2>
<li>ISBN: {{$book->isbn}}</li>
<li>Title: {{$book->title}}</li>
<li>Description: @markdown {{$book->description}} @endmarkdown</li>

<form method="GET" action="/books/{{$book->id}}/edit">
    <button>Edit</button>
</form>
