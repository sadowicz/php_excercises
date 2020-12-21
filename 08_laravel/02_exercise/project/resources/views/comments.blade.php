<h2>Comments</h2>
<br>
@if($comments == null)
    <h1>{{ $title }}</h1>
    <p>{{ $text }}</p>
    @else
        @foreach($comments as $comment)
            <a href="/comments/{{ $comment->id }}">{{ $comment->title }}</a>
        @endforeach
@endif
