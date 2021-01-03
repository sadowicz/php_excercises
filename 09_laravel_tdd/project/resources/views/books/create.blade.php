<h2>Creating a book</h2>
<form method="POST" action="{{route('books.index')}}">
    @csrf
    <div>
        <label>ISBN</label>
        <input type="text" name="isbn" value="{{old('isbn')}}">
        @error('isbn')
        <li>{{$errors->first('isbn')}}</li>
        @enderror
    </div>
    <div>
        <label>Title</label>
        <input type="text" name="title" value="{{old('title')}}">
        @error('title')
        <li>{{$errors->first('title')}}</li>
        @enderror
    </div>
    <div>
        <label>Description</label>
        <input type="text" name="description" value="{{old('description')}}">
        @error('description')
        <li>{{$errors->first('description')}}</li>
        @enderror
    </div>
    <div>
        <button>Create</button>
    </div>
</form>
