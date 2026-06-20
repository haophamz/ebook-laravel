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
//dang ki dang nhap
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
//admin
Route::prefix('admin')
    ->name('admin.')
    ->middleware([
        'auth',
        'verified',
        'admin'
    ])
    ->group(function () {

    Route::resource('books', BookController::class);
    Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');
Route::get('/books/drafts', [BookController::class, 'drafts'])
->name('books.drafts');


    });

