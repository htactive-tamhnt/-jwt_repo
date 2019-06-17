<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Đăng kí và đăng nhập
Route::post('register', 'ApiController@register');
Route::post('login', 'ApiController@login');

// Dùng auth.jwt middleware để check user
Route::group(['middleware' => 'auth.jwt'], function () {
    // Hiển thị user và đăng xuất
    Route::post('logout', 'ApiController@logout');
    Route::get('user', 'ApiController@getAuthUser');
    Route::resource('comments','CommentController');
});