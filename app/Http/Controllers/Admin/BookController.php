<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\UserBook;
use App\Models\BookPurchase;

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

if ($request->type == 'free') {
    $books->where('access_type', 'free');
}

if ($request->type == 'vip') {
    $books->where('access_type', 'vip');
}

if ($request->type == 'paid') {
    $books->where('access_type', 'paid');
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
    'access_type' => 'required|in:free,vip,paid',
'price' => 'nullable|numeric|min:0',
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

$book->access_type = $request->access_type ?? 'free';
$book->price = $request->price ?? 0;

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
        'access_type' => 'required|in:free,vip,paid',
'price' => 'nullable|numeric|min:0',
    ]);

    $book->title = $request->title;
    $book->slug = Str::slug($request->title);

    $book->author = $request->author;
    $book->description = $request->description;
    $book->category_id = $request->category_id;

$book->featured = $request->has('featured');
$book->is_top = $request->has('is_top');

$book->access_type = $request->access_type ?? 'free';
$book->price = $request->price ?? 0;

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
    $book = Book::where('slug', $slug)
        ->with(['category'])
        ->firstOrFail();

    // 1. Khởi tạo giá trị mặc định ngay từ đầu
    $isFavorite = false;
    $isPurchased = false;
    $isVip = false;
    $avgRating = 0;
    $reviewCount = 0;
    $reviews = collect(); // Collection rỗng
    $comments = collect(); // Collection rỗng

    // 2. Nếu đã đăng nhập thì mới ghi đè giá trị thật
    if (auth()->check()) {
        $user = auth()->user();
        $isVip = (bool) ($user->is_vip ?? false);

        UserBook::updateOrCreate(
            ['user_id' => $user->id, 'book_id' => $book->id],
            ['last_read_at' => now()]
        );

        $isFavorite = UserBook::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('is_favorite', true)
            ->exists();

        $isPurchased = \App\Models\BookPurchase::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->exists();
    }

    // 3. Lấy dữ liệu rating/comments (kể cả khi chưa đăng nhập)
    $avgRating = $book->reviews()->avg('rating') ?? 0;
    $reviewCount = $book->reviews()->count();
    $reviews = $book->reviews()->with('user')->latest()->get();
    $comments = $book->comments()->with('user')->latest()->get();

    // 4. Trả về view
    return view(
        'home.watch',
        compact(
            'book',
            'isFavorite',
            'isPurchased',
            'isVip',
            'avgRating',
            'reviewCount',
            'reviews',
            'comments'
        )
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
//iu thich
public function favorite(Book $book)
{
    $favorite = UserBook::firstOrNew([
        'user_id' => auth()->id(),
        'book_id' => $book->id,
    ]);

    $favorite->is_favorite = ! $favorite->is_favorite;

    $favorite->save();

    if ($favorite->is_favorite) {
        return back()->with(
            'success',
            'Đã thêm "' . $book->title . '" vào yêu thích'
        );
    }

    return back()->with(
        'success',
        'Đã bỏ "' . $book->title . '" khỏi yêu thích'
    );
}
public function render($slug)
{
    $book = Book::where('slug', $slug)->firstOrFail();

if ($book->access_type == 'vip') {

    // kiểm tra user có VIP

}

if ($book->access_type == 'paid') {

    if (!auth()->check()) {

        return redirect()->route('login');

    }

    $owned = BookPurchase::where(
        'user_id',
        auth()->id()
    )
    ->where(
        'book_id',
        $book->id
    )
    ->exists();

    if (!$owned) {

        return redirect()
            ->route('book.order', $book)
            ->with('error', 'Bạn cần mua ebook trước khi đọc.');

    }

}

    $position = null;

    if (auth()->check()) {

        $userBook = UserBook::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->first();

        $position = $userBook?->reading_position;
    }

    return view('home.render', compact(
        'book',
        'position'
    ));
}
public function saveProgress(Request $request)
{
    UserBook::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
        ],
        [
            'progress' => $request->progress,
            'reading_position' => $request->cfi,
            'last_read_at' => now(),
        ]
    );

    return response()->json([
        'success' => true,
    ]);
}
}

