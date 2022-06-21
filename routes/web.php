<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
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

Auth::routes();

Route::group(['controller'=>'App\Http\Controllers\Home\IndexController'],function(){
  Route::get('/',"home")->name('home');
  Route::get('/about',"about")->name('about');
});
Route::group(['namespace'=>'App\Http\Controllers\Personal','prefix'=>'personal','middleware'=>'auth'],function(){
  Route::get('/','IndexController')->name('personal.index');
});
Route::group(['prefix'=>'posts'],function(){
  Route::get('/test', function(){
    return view('layouts.app1');
  });
  Route::group(['namespace'=>'App\Http\Controllers\Comment','prefix'=>'comments','middleware'=>['auth']],function(){
    Route::get('/','IndexController')->name('comment.index');
    Route::get('/create','StoreController')->name('comment.create');
    Route::post('/create','StoreController')->name('comment.store');
    Route::patch('/{comment}','UpdateController')->name('comment.update');
    Route::get('/{comment}/edit','DeleteController')->name('comment.edit');
    Route::delete('/{comment}','DeleteController')->name('comment.delete')->middleware('can:delete,comment');
  });
  Route::group(['namespace'=>'App\Http\Controllers\Post'],function(){
    Route::get('/','IndexController')->name('post.index');
    Route::match(['GET',"POST"],'/search','SearchController')->name('post.search');
    Route::group(['middleware'=>'auth'],function(){
      Route::get('/create','CreateController')->name('post.create');
      Route::post('/store','StoreController')->name('post.store');
      //Route::group(['middleware'=>'can:update,user'],function(){
        Route::get('/{post}/edit','EditController')->name('post.edit')->middleware('can:update,post');
        Route::patch('/{post}/update','UpdateController')->name('post.update')->middleware('can:update,post');
        Route::delete('/{post}','DeleteController')->name('post.delete');//->middleware('can:delete,post');
      //});
      Route::post('/{post}/like', 'LikeController')->name('post.like');
    });
    Route::get('/{post}', 'ShowController')->name('post.show');

  });
  Route::group(['namespace'=>'App\Http\Controllers\Tag','prefix'=>'tags'],function(){
    Route::get('/',function(){return redirect()->route('post.index');})->name('tag.index.empty');
    Route::get('/{tag:slug}','IndexController')->name('tag.index');
  });
  Route::group(['namespace'=>'App\Http\Controllers\Category','prefix'=>'categories'],function(){
    Route::get('/{category:slug}','IndexController' )->name('category.index');
  });
  
});

Route::group(['namespace'=>'App\Http\Controllers\Admin','prefix'=>'admin','middleware'=>'admin'],function () {
    Route::group(['namespace'=>'Main'],function () {
        Route::get('/', 'IndexController')->name('admin.main.index');
    });
    Route::group(['namespace'=>'Post','prefix'=>'posts'],function () {
      Route::get('/', 'IndexController')->name('admin.post.index');
      Route::get('/create', 'CreateController')->name('admin.post.create');
      Route::post('/create', 'StoreController')->name('admin.post.store');
      Route::get('/{post}', 'ShowController')->name('admin.post.show');
      Route::get('/{post}/edit', 'EditController')->name('admin.post.edit');
      Route::patch('/{post}/update', 'UpdateController')->name('admin.post.update');
      Route::delete('/', 'MultiDeleteController')->name('admin.post.multidelete');
      Route::delete('/{post}', 'DeleteController')->name('admin.post.delete');

    });
    Route::group(['namespace'=>'Category','prefix'=>'categories'],function () {
      Route::get('/', 'IndexController')->name('admin.category.index');
      Route::get('/create', 'CreateController')->name('admin.category.create');
      Route::post('/create', 'StoreController')->name('admin.category.store');
      Route::get('/{category}', 'ShowController')->name('admin.category.show');
      Route::get('/{category}/edit', 'EditController')->name('admin.category.edit');
      Route::patch('/{category}', 'UpdateController')->name('admin.category.update');
      Route::delete('/', 'MultiDeleteController')->name('admin.category.multidelete');
      Route::delete('/{category}', 'DeleteController')->name('admin.category.delete');
    });
    Route::group(['namespace'=>'Tag','prefix'=>'tags'],function () {
      Route::get('/', 'IndexController')->name('admin.tag.index');
      Route::get('/create', 'CreateController')->name('admin.tag.create');
      Route::post('/create', 'StoreController')->name('admin.tag.store');
      Route::get('/{tag}', 'ShowController')->name("admin.tag.show");
      Route::get('/{tag}/edit', 'EditController')->name('admin.tag.edit');
      Route::patch('/{tag}', 'UpdateController')->name('admin.tag.update');
      Route::delete('/', 'MultiDeleteController')->name('admin.tag.multidelete');
      Route::delete('/{tag}', 'DeleteController')->name('admin.tag.delete');
    });
    Route::group(['namespace'=>'User','prefix'=>'users'],function () {
      Route::get('/', 'IndexController')->name('admin.user.index');
      Route::get('/create', 'CreateController')->name('admin.user.create');
      Route::post('/create', 'StoreController')->name('admin.user.store');
      Route::get('/{user}/edit', 'EditController')->name('admin.user.edit');
      Route::get('/{user}', 'ShowController')->name('admin.user.show');
      Route::patch('/{user}', 'UpdateController')->name('admin.user.update');
      Route::delete('/', 'MultiDeleteController')->name('admin.user.multidelete');
      Route::delete('/{user}', 'DeleteController')->name('admin.user.delete');
    });
    Route::group(['namespace'=>'Comment','prefix'=>'comments'],function () {
      // Route::get('/', 'IndexController')->name('admin.user.index');
      // Route::get('/create', 'CreateController')->name('admin.user.create');
      // Route::post('/create', 'StoreController')->name('admin.user.store');
      // Route::get('/{user}/edit', 'EditController')->name('admin.user.edit');
      // Route::get('/{user}', 'ShowController')->name('admin.user.show');
      // Route::patch('/{user}', 'UpdateController')->name('admin.user.update');
      // Route::delete('/', 'MultiDeleteController')->name('admin.user.multidelete');
      // Route::delete('/{user}', 'DeleteController')->name('admin.user.delete');
      Route::get('/','IndexController')->name('admin.comment.index');
      Route::get('/create','StoreController')->name('admin.comment.create');
      Route::post('/create','StoreController')->name('admin.comment.store');
      Route::get('/{comment}','ShowController')->name('admin.comment.show');
      Route::patch('/{comment}','UpdateController')->name('admin.comment.update');
      Route::get('/{comment}/edit','UpdateController')->name('admin.comment.edit');
      Route::delete('/{comment}','DeleteController')->name('admin.comment.delete');
      Route::delete('/', 'MultiDeleteController')->name('admin.comment.multidelete');
    });
});
