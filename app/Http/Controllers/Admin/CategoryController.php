<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $categories = Category::latest()->paginate(20);

    return view('admin.categories.index', compact('categories'));
}

public function create()
{
    return view('admin.categories.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255'
    ]);

    Category::create([
        'name'   => $request->name,
        'slug'   => Str::slug($request->name), 
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success','Thêm danh mục thành công');
}
public function edit(Category $category)
{
    return view(
        'admin.categories.edit',
        compact('category')
    );
}
public function destroy(Category $category)
{
    $category->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Xóa danh mục thành công');
}
public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|max:255'
    ]);

    $category->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Cập nhật danh mục thành công');
}
}
