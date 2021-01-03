<?php //use GrahamCampbell\Markdown\Facades\Markdown; ?>

<h2>Viewing a book</h2>
<li>ISBN: {{$book->isbn}}</li>
<li>Title: {{$book->title}}</li>
<li>Description: @markdown {{$book->description}} @endmarkdown</li>

<form method="GET" action="{{$book->path()}}/edit">
    <button>Edit</button>
</form>
<form method="POST" action="{{$book->path()}}">
    @csrf
    @method('DELETE')
    <button>Delete</button>
</form>
