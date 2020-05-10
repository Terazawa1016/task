<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {     return view('welcome'); });

// --------------------------------------------------------------------------

Route::get('/content', 'ContentController@index')->name('content');
Route::get('/content/create', 'ContentController@shareCreate')->name('content.create');
Route::post('/content/create', 'ContentController@create');
Route::get('/{folders}/content/delete','ContentController@delete')->name('content.delete');


Route::get('/share_folders/create', 'ShareFolderController@shareCreate')->name('share_folders.create');
Route::post('/share_folders/create', 'ShareFolderController@create');

 // タスクの作成機能
 Route::get('/{folder_id}/share_tasks', 'ShareTaskController@index')->name('share_tasks.index');
 Route::get('/{folder_id}/share_tasks/create', 'ShareTaskController@showCreateForm')->name('share_tasks.create');
 Route::post('/{folder_id}/share_tasks/create', 'ShareTaskController@create');

 // タスクの編集機能
 Route::get('/{folder_id}/share_tasks/{task}/edit','ShareTaskController@showEditForm')->name('share_tasks.edit');
 Route::post('/{folder_id}/share_tasks/{task}/edit','ShareTaskController@edit');
 Route::get('/{folder}/share_delete/{folders}','ShareTaskController@delete')->name('share_folders.delete');

// ---------------------------------------------------------------------------

Route::group(['middleware' => 'auth'], function() {

  Route::get('/', 'HomeController@index')->name('home');

  // フォルダ作成機能のURL
  Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
  Route::post('/folders/create', 'FolderController@create');

    // タスク一覧ページをIDによって表示する為、{id}を用意する
    Route::get('/{folder}/tasks', 'TaskController@index')->name('tasks.index');

    // タスクの作成機能
    Route::get('/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/{folder}/tasks/create', 'TaskController@create');

    // タスクの編集機能
    Route::get('/{folder}/tasks/{task}/edit','TaskController@showEditForm')->name('tasks.edit');
    Route::post('/{folder}/tasks/{task}/edit','TaskController@edit');
    Route::get('/{folder}/delete','TaskController@delete')->name('folders.delete');

  //入力フォーム画面を返却するルート
  Route::get('/comment', 'CommentController@showForm')->name('comment');
  //入力を受け付けるルート
  Route::post('/comment', 'CommentController@create');
  //入力後にリダイレクトする完了画面のルート
  Route::get('/comment/thanks', 'CommentController@thanks')->name('comment.thanks');

});

// 認証確認

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

