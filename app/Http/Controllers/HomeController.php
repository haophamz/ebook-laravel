<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status',1)
            ->orderBy('sort_order')
            ->get();
$featuredBooks = Book::where('status','published')
    ->where('featured',1)
    ->latest()
    ->take(6)
    ->get();

        $latestBooks = Book::where('status','published')
        ->latest()
        ->take(6)
        ->get();

$categories = Category::where('status',1)
        ->with([
            'books' => function($q){
                $q->where('status','published')
                  ->latest()
                  ->take(6);
            }
        ])
        ->get();

        return view('home.index', compact(
            'banners',
            'featuredBooks',
            'latestBooks',
            'categories'
        ));
    }
    public function latest()
{
    $books = Book::where('status', 'published')
        ->orderByDesc('created_at')
        ->paginate(12);

    return view('books.latest', compact('books'));
}
public function featured()
{
    $books = Book::where('status', 'published')
        ->where('featured', 1)
        ->latest()
        ->paginate(12);

    return view('books.featured', compact('books'));
}
public function memberBooks()
{
    $books = Book::where('status', 'published')
        ->where(function ($q) {
            $q->where('access_type', 'vip')
              ->orWhere('is_vip', 1);
        })
        ->latest()
        ->paginate(12);

    return view('books.member', compact('books'));
}
public function freeBooks()
{
    $books = Book::where('status', 'published')
        ->where('access_type', 'free')
        ->latest()
        ->paginate(12);

    return view('books.free', compact('books'));
}
public function paidBooks()
{
    $books = Book::where('status', 'published')
        ->where('access_type', 'paid')
        ->latest()
        ->paginate(12);

    return view('books.paid', compact('books'));
}
public function search(Request $request)
{
    $keyword = trim($request->q);

    $books = Book::where('status', 'published')
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('author', 'like', "%{$keyword}%");
            });
        })
        ->latest()
        ->paginate(24)
        ->appends([
            'q' => $keyword
        ]);

    return view('books.search', compact('books', 'keyword'));
}
}