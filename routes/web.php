<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CommentController; 
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\VipPlanController;
use App\Http\Controllers\VipController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\RevenueController;

Route::get('/admin/revenue', [RevenueController::class, 'index'])
    ->name('admin.revenue.index');
//post prgress
Route::post('/reading-progress', [BookController::class, 'saveProgress'])
    ->middleware('auth')
    ->name('reading.progress');
//goi thanh vien
Route::get(
    '/goi-thanh-vien',
    [VipPlanController::class,'pricing']
)->name('pricing');
//mua goi
Route::middleware('auth')->group(function () {
Route::post('/vip/subscribe', [VipController::class, 'subscribe'])
    ->name('vip.subscribe');
    Route::get(
        '/vip/order/{order}',
        [VipController::class,'order']
    )->name('vip.order');

    Route::get(
        '/vip/checkout/{order}',
        [VipController::class,'checkout']
    )->name('vip.checkout');

    Route::get(
        '/vip/check-payment/{order}',
        [VipController::class,'checkPayment']
    )->name('vip.check-payment');
    Route::post('/order/{order}/coupon', [VipController::class, 'applyCoupon'])
    ->name('order.coupon');
    Route::delete('/order/{order}/coupon', [VipController::class, 'removeCoupon'])->name('order.coupon.remove');

});
//login noi bo
Route::get('/go-to-login', function () {

    session(['url.intended' => url()->previous()]);

    return redirect()->route('login');

})->name('go-to-login');
Route::post(
    '/book/{book}/review',
    [ReviewController::class, 'store']
)->middleware('auth')
 ->name('reviews.store');
Route::post(
    '/book/{book}/comment',
    [CommentController::class, 'store']
)->middleware('auth')
 ->name('comments.store');

Route::get('/sach/{slug}', [BookController::class,'watch'])
    ->name('home.watch');
    //render
    Route::get('/render/{slug}', [BookController::class, 'render'])
    ->name('home.render');
    //iu
    Route::post(
    '/favorite/{book}',
    [BookController::class,'favorite']
)->middleware('auth')
 ->name('book.favorite');
//dang ki dang nap
Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');

})->name('logout');
route::get("/test", function () {
    return view('welcome');
});
Route::get('/register', [RegisterController::class, 'index'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');
Route::get('/', [HomeController::class, 'index'])
->name('home');
Route::get('/login', function () {

    if (auth()->check() && auth()->user()->hasVerifiedEmail()) {
        return redirect()->route('home');
    }

    return view('auth.login');

})->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->name('login.store');
    //login cua google
    Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
/*
|--------------------------------------------------------------------------
| Email Verification
|--------------------------------------------------------------------------
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Đã gửi lại email xác thực.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/check-verified', function () {

    return response()->json([
        'verified' => auth()->check()
            ? auth()->user()->hasVerifiedEmail()
            : false
    ]);

})->middleware('auth');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {

    $request->validate([
        'email' => 'required|email'
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return back()->with(
        $status === Password::RESET_LINK_SENT
            ? 'success'
            : 'error',
        __($status)
    );

})->name('password.email');

/*
|--------------------------------------------------------------------------
| Reset Password
|--------------------------------------------------------------------------
*/

Route::get('/reset-password/{token}', function (string $token) {

    return view('auth.reset-password', [
        'token' => $token
    ]);

})->name('password.reset');

Route::post('/reset-password', function (Request $request) {

    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        ),

        function ($user, $password) {

            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(
                Str::random(60)
            );

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')
            ->with('success', 'Đổi mật khẩu thành công')
        : back()->withErrors([
            'email' => __($status)
        ]);

})->name('password.update');
//goi vip

//admin
Route::prefix('admin')
    ->name('admin.')
    ->middleware([
        'auth',
        'verified',
        'admin'
    ])    ->group(function () {
    //VIP
Route::resource(
    'vip-plans',
    VipPlanController::class
    
);

 Route::resource('coupons', CouponController::class);
Route::get('/books/drafts', [BookController::class, 'drafts'])
->name('books.drafts');

    Route::resource('books', BookController::class);
    Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');
//banner
Route::resource(
    'banners',
    BannerController::class
);
//danh muc
Route::resource('categories', CategoryController::class);
Route::patch('/members/{member}/lock', [MemberController::class, 'lock'])
    ->name('members.lock');

Route::patch('/members/{member}/unlock', [MemberController::class, 'unlock'])
    ->name('members.unlock');
 Route::resource('members', MemberController::class);
    });

//account 
Route::middleware('auth')->prefix('tai-khoan')->group(function () {

    Route::get('/', [AccountController::class,'profile'])
        ->name('account.profile');

    Route::post('/cap-nhat', [AccountController::class,'update'])
        ->name('account.update');
    Route::get('/yeu-thich', [AccountController::class,'favorites'])
        ->name('account.favorites');

    Route::get('/lich-su-doc', [AccountController::class,'history'])
        ->name('account.history');
Route::get('/doi-mat-khau',
    [AccountController::class,'password'])
    ->name('account.password');

Route::post('/doi-mat-khau',
    [AccountController::class,'updatePassword'])
    ->name('account.password.update');

});
