<h2>Editing a book</h2>
<form method="POST" action="/books/{{$book->id}}">
    @csrf
    @method('PUT')
    <div>
        <label>ISBN</label>
        <input type="text" name="isbn" value="{{$book->isbn}}">
        @error('isbn')
        <li>{{$errors->first('isbn')}}</li>
        @enderror
    </div>
    <div>
        <label>Title</label>
        <input type="text" name="title" value="{{$book->title}}">
        @error('title')
        <li>{{$errors->first('title')}}</li>
        @enderror
    </div>
    <div>
        <label>Description</label>
        <input type="text" name="description" value="{{$book->description}}">
        @error('description')
        <li>{{$errors->first('description')}}</li>
        @enderror
    </div>
    <div>
        <button>Update</button>
    </div>
</form>
