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

    return view(
        'home.index',
        compact('banners')
    );
}
}
