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

        return view('books.index');
    }

    public function show(Book $book) {

        return view('books.show')->withBook($book);
    }

    public function create() {

        return view('books.create');
    }

    public function store() {

        request()->validate([
            'isbn'=>'required|digits:13',
            'title'=>'required',
            'description'=>'required'
        ]);

        $book = new Book();

        $book->isbn = request('isbn');
        $book->title = request('title');
        $book->description = request('description');

        $book->save();

        return redirect('/books');
    }
}
