<h2>Creating a book</h2>
<form method="POST" action="/books">
    @csrf

    <label>ISBN</label>
    <input type="text" name="isbn">
    <li>{{$errors->first('isbn')}}</li>
    <label>Title</label>
    <input type="text" name="title">
    <li>{{$errors->first('title')}}</li>
    <label>Description</label>
    <input type="text" name="description">
    <li>{{$errors->first('description')}}</li>
    <button>Create</button>
</form>
