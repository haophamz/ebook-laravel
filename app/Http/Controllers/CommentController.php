<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'content' => 'required|min:2'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'content' => $request->content,
        ]);

        return back()->with(
            'success',
            'Bình luận thành công'
        );
    }
}