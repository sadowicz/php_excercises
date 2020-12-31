<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function index() {

        return view('books.index');
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
    }
}
