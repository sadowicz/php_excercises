<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function index() {

        $books = Book::all();

        return view('books.index')->withBooks($books);;
    }

    public function show(Book $book) {

        return view('books.show')->withBook($book);
    }

    public function create() {

        return view('books.create');
    }

    public function store() {

        $book = Book::create($this->validateBook());

        return redirect($book->path());
    }

    public function edit(Book $book) {

        return view('books.edit')->withBook($book);
    }

    public function update(Book $book) {

        $book->update($this->validateBook());

        return redirect($book->path());
    }

    public function destroy(Book $book) {

        $book->delete();

        return redirect(route('books.index'));
    }

    private function validateBook(): array {
        return request()->validate([
            'isbn' => 'required|digits:13',
            'title' => 'required',
            'description' => 'required'
        ]);
    }
}
