<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
public function show($slug)
    {
        // 1. Tìm danh mục theo slug, nếu không thấy trả về trang 404
        $category = Category::where('slug', $slug)->firstOrFail();

        // 2. Lấy danh sách sách thuộc danh mục này và phân trang (ví dụ: 12 cuốn một trang)
        // Dùng 'with' nếu cần eagers load quan hệ (như reviews hay tags nếu có)
        $books = $category->books()->paginate(12);

        // 3. Trả về view kèm dữ liệu
        return view('category.show', compact('category', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
