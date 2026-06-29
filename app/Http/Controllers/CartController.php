<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $total = $items->sum(function ($item) {
            return $item->price;
        });

        return view('cart.index', compact(
            'items',
            'total'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->access_type != 'paid') {

            return back()->with(
                'error',
                'Sách này không thể thêm vào giỏ hàng.'
            );

        }

        Cart::firstOrCreate(

            [
                'user_id' => auth()->id(),
                'book_id' => $book->id,
            ],

            [
                'price' => $book->price,
            ]

        );

        return back()->with(
            'success',
            'Đã thêm vào giỏ hàng.'
        );
    }

    public function update(Request $request, Cart $cart)
    {
        abort_unless(
            $cart->user_id == auth()->id(),
            403
        );

        return back();
    }

    public function destroy(Cart $cart)
    {
        abort_unless(
            $cart->user_id == auth()->id(),
            403
        );

        $cart->delete();

        return back()->with(
            'success',
            'Đã xóa khỏi giỏ hàng.'
        );
    }
}