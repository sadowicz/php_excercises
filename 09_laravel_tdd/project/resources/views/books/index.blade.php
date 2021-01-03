<h2>List of books</h2>
@if(count($books))
    <table>
        <tr>
            <th>ISBN</th>
            <th>Title</th>
        </tr>
        @foreach($books as $book)
            <tr>
                <td>{{$book->isbn}}</td>
                <td>{{$book->title}}</td>
                <td>
                    <form method="GET" action="{{$book->path()}}">
                        <button>Details</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <p>No books in database.</p>
@endif

<form method="GET" action="{{route('books.create')}}">
    <button>Create new...</button>
</form>
