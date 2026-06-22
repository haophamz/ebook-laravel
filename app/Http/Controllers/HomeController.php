<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Banner;

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

}