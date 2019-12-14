<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', function () {
    return view('index');
});
Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('email', 'LoginController@email');
Route::get('confirmemailtoken/{token}', 'LoginController@confirmEmailToken')->name('confirmEmailToken');

Route::group(['prefix' => 'password'], function () {
    Route::post('email', 'PasswordController@email');
    Route::any('reset/{token}', 'PasswordController@reset');
});
Route::group(['prefix' => 'video'], function () {
    Route::get('list', 'VideoController@index');
    Route::post('create', 'VideoController@store');
    Route::get('user', 'UserController@videoList')->middleware('auth:user');
    Route::post('search', 'VideoController@search');
    Route::get('{id}', 'VideoController@show');
    Route::post('{id}', 'VideoController@update')->middleware('auth:user');
    Route::delete('{id}', 'VideoController@destroy')->middleware('auth:user');
});


Route::get('user', 'UserController@index');
Route::post('user/{id}', 'UserController@update');

Route::group(['prefix' => 'news', 'middleware' => 'auth:user'], function () {
    Route::get('/', 'NewsController@index');
    Route::get('count', 'NewsController@count');
});

Route::group(['prefix' => 'admin'], function () {
    Route::any('login', 'Admin\UserController@login')->name('admin.login');
    Route::get('error', 'Admin\ErrorController@index')->middleware(['auth:admin'])->name('admin.error');
    Route::get('', 'Admin\AdminController@index')->middleware(['auth:admin'])->name('admin');
    Route::get('edit', 'Admin\AdminController@edit')->middleware(['auth:admin'])->name('admin.edit');

    Route::group(['prefix' => 'setting', 'middleware' => ['auth:admin', 'rbac']], function () {
        Route::get('', 'Admin\SettingController@index')->name('admin.setting');
        Route::get('avatar', 'Admin\SettingController@avatar')->name('admin.setting.avatar');
        Route::get('image', 'Admin\SettingController@image')->name('admin.setting.image');
        Route::get('video', 'Admin\SettingController@video')->name('admin.setting.video');
    });
    Route::group(['prefix' => 'examine', 'middleware' => ['auth:admin', 'rbac']], function () {
        Route::get('', 'Admin\ExamineController@index')->name('admin.examine.index');
        Route::post('{id}', 'Admin\ExamineController@success');
        Route::post('del/{id}', 'Admin\ExamineController@delete');
    });
    Route::resource('user', 'Admin\UserController')->middleware(['auth:admin', 'rbac']);
    Route::resource('avatar', 'Admin\AvatarController')->middleware(['auth:admin', 'rbac']);
    Route::resource('video', 'Admin\VideoController')->middleware(['auth:admin', 'rbac']);
    Route::get('image', 'Admin\ImageController@index')->middleware(['auth:admin', 'rbac'])->name('image.index');
    Route::get('admin/avatar', 'Admin\AvatarController@adminIndex')->middleware(['auth:admin', 'rbac'])->name('admin.avatar.index');
    Route::resource('admin/users', 'Admin\AdminUserController')->middleware(['auth:admin', 'rbac']);
    Route::resource('role', 'Admin\RoleController')->middleware(['auth:admin', 'rbac']);
    Route::get('auth', 'Admin\AuthController@index')->middleware(['auth:admin', 'rbac'])->name('auth.index');
    Route::resource('info', 'Admin\InfoController')->middleware(['auth:admin', 'rbac']);

    Route::group(['prefix' => 'recovery', 'middleware' => ['auth:admin', 'rbac']], function () {
        Route::get('', 'Admin\RecoveryController@index')->name('recovery.index');
        Route::post('{id}', 'Admin\RecoveryController@recovery');
        Route::post('delete/{id}', 'Admin\RecoveryController@delete');
    });
});


