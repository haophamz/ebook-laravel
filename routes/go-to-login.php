<?php

// File: routes/go-to-login.php
// Include file này vào routes/web.php bằng cách thêm dòng:
//     require __DIR__.'/go-to-login.php';
// hoặc copy nội dung bên dưới (bỏ phần require) thẳng vào web.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/go-to-login', function (Request $request) {

    $redirect = $request->query('redirect');

    // Chỉ chấp nhận redirect nội bộ (cùng domain), tránh open-redirect
    if ($redirect && str_starts_with($redirect, url('/'))) {
        $request->session()->put('url.intended', $redirect);
    }

    // ===== DEBUG: mở /go-to-login?redirect=...&debug=1 để xem session ngay,
    // KHÔNG chuyển trang, để kiểm tra giá trị đã lưu đúng chưa =====
    if ($request->query('debug')) {
        return response()->json([
            'redirect_param_received' => $redirect,
            'passed_url_check' => $redirect ? str_starts_with($redirect, url('/')) : false,
            'session_intended_after_set' => $request->session()->get('url.intended'),
            'session_id' => $request->session()->getId(),
            'app_url' => url('/'),
        ]);
    }

    return redirect()->route('login');

})->name('go-to-login');


// ===== Route phụ để kiểm tra session ở bước SAU, ngay trước khi login =====
// Mở /debug-session ở TAB MỚI (cùng trình duyệt) sau khi đã vào trang /login
// để xem session.url.intended còn giữ nguyên hay đã mất.
Route::get('/debug-session', function (Request $request) {
    return response()->json([
        'intended' => $request->session()->get('url.intended'),
        'session_id' => $request->session()->getId(),
        'all_session_keys' => array_keys($request->session()->all()),
    ]);
});