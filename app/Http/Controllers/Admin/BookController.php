<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Str;
use App\Models\Category;
class BookController extends Controller
{
    
public function index(Request $request)
{
    
    $books = Book::query();

    if ($request->filled('keyword')) {

        $books->where('title','like',
            '%'.$request->keyword.'%'
        );
    }

    if ($request->type == 'published') {
        $books->where('status','published');
    }

    if ($request->type == 'draft') {
        $books->where('status','draft');
    }

    if ($request->type == 'vip') {
        $books->where('is_vip',1);
    }

    if ($request->type == 'banner') {
        $books->where('is_top',1); 
    }    
    if ($request->type == 'featured') {
    $books->where('featured', 1);
}    

    $books = $books
        ->latest()
        ->paginate(20);

    return view(
        'admin.books.index',
        compact('books')
    );
}   
public function create() {
$categories = Category::where('status', 1)
->orderBy('name')
->get();

return view('admin.books.create', compact('categories'));
}
public function store(Request $request)
{
$request->validate([
'title'       => 'required|string|max:255',
'author'      => 'nullable|string|max:255',
'category_id' => 'nullable|exists:categories,id',
'description' => 'nullable|string',
    'cover'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    'epub_file'   => 'required|file|mimes:epub|max:20480',
]);
if (Book::where('title', $request->title)->exists()) {

return back() ->withInput() ->with('error', 'Tên sách đã tồn tại.');;
}       
$book = new Book();

$book->title = $request->title;
$book->slug = Str::slug($request->title);

$book->author = $request->author;
$book->description = $request->description;

$book->category_id = $request->category_id;

$book->featured = $request->has('featured');
$book->is_top   = $request->has('is_top');
$book->is_vip   = $request->has('is_vip');

$book->status = $request->status ?? 'published';

$book->views = 0;
$book->favorites = 0;

if ($request->hasFile('cover')) {
    $book->cover = $request->file('cover')
        ->store('covers', 'public');
}

if ($request->hasFile('epub_file')) {
    $book->epub_file = $request->file('epub_file')
        ->store('epubs', 'public');
}

$book->save();

return redirect()
    ->route('admin.books.create')
    ->with('success', 'Thêm ebook thành công!');


}
public function drafts()
{
$books = Book::where('status', 'draft')
->latest()
->paginate(20);

return view('admin.books.drafts', compact('books'));

}
public function edit(Book $book)
{
    $categories = Category::all();

    return view('admin.books.edit', compact(
        'book',
        'categories'
    ));
}

public function destroy(Book $book)
{
    $book->delete();

    return back()
        ->with('success', 'Xóa ebook thành công');
}
public function update(Request $request, Book $book)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'author'      => 'nullable|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
        'cover'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        'epub_file'   => 'nullable|file|mimes:epub|max:20480',
    ]);

    $book->title = $request->title;
    $book->slug = Str::slug($request->title);

    $book->author = $request->author;
    $book->description = $request->description;
    $book->category_id = $request->category_id;

    $book->featured = $request->has('featured');
    $book->is_top = $request->has('is_top');
    $book->is_vip = $request->has('is_vip');

    $book->status = $request->status;

    if ($request->hasFile('cover')) {
        $book->cover = $request->file('cover')
            ->store('covers', 'public');
    }

    if ($request->hasFile('epub_file')) {
        $book->epub_file = $request->file('epub_file')
            ->store('epubs', 'public');
    }

    $book->save();

    return redirect()
        ->route('admin.books.index')
        ->with('success', 'Cập nhật ebook thành công');
}
public function watch($slug)
    {
        $book = Book::where('slug',$slug)
            ->firstOrFail();

        return view(
'home.watch',compact('book')
        );
    }
    public function streamEpub($slug)
{
    $book = Book::where('slug', $slug)->first();

    if (!$book) {
        abort(404, 'Book not found.');
    }

    $path = storage_path('app/public/' . $book->epub_file);

    if (!file_exists($path)) {
        abort(404, 'Book file not found.');
    }

    return response()->file($path, [
        'Content-Type' => 'application/epub+zip',
        'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
    ]);

}
}