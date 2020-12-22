<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index')->withComments($comments);
    }

    public function show(Comment $comment)
    {
        return view('comments.show')->withComment($comment);
    }
}
