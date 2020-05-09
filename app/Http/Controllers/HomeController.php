<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ShareFolder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  public function index()
  {
    //ログインユーザーを取得
    $user = Auth::user();

    //ログインユーザーに紐づくフォルダを一つ取得
    $folder = $user->folders()->first();


    //まだフォルダを作成していないユーザーはホームをレスポンスする
    if (is_null($folder)) {
      return view('home');
    }

    //フォルダがあればフォルダのタスク一覧にリダイレクト
    return redirect()->route('tasks.index',[
      'folder' => $folder->id,
    ]);
  }
}
