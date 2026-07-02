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

        return back()->with('success', 'Bình luận thành công');
    }

    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|min:2'
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return back()->with('success', 'Sửa bình luận thành công');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Xoá bình luận thành công');
    }
}