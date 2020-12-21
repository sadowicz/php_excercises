<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function show() {

        return view('comments', [
            'comments' => Comment::all(),
            ]);
    }

    public function showComment($id) {

        return view('comments', [
            'comments' => null,
            'title' => Comment::select('title')->where('id','=',$id)->first()['title'],
            'text' => Comment::select('text')->where('id','=',$id)->first()['text']
        ]);
    }
}
