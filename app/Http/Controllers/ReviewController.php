<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string|max:1000',
        ]);

        Review::updateOrCreate(

            [
                'user_id' => auth()->id(),
                'book_id' => $book->id,
            ],

            [
                'rating' => $request->rating,
                'content' => $request->content,
            ]
        );

        return back()->with(
            'success',
            'Đánh giá thành công'
        );
    }
}