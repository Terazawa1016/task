<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
  public function showCreateForm()
  {
    return view('folders/create');
  }

    // 引数にインポートしたRequestクラスを受け入れる
    //ここでバリデーションの為CreateFolderを第１引数にする
    //このCreateFolderの継承元のFormRequestはRequestと互換性がある
  public function create(CreateFolder $request)
  {
    //フォルダモデルのインスタンスを作成する
    //DBに書き込む処理
    $folder = new Folder();

    //インスタンスのプロパティ($folder)に値を代入
    $folder->title = $request->title;

    //ユーザーに紐づけて保存
    Auth::user()->folders()->save($folder);

    // フォルダ作成が完了したらそのフォルダに対応する一覧画面へと遷移させる
    return redirect()->route('tasks.index', [
      'folder' => $folder->id,
    ]);
  }
}
