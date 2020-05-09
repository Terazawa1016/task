<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;
use App\ShareFolder;
use App\ShareTask;

class TaskController extends Controller
{

  // indexを表示する動作を定義
  //ルーティングで定義したURLの変数部分を受け取る
  public function index (Folder $folder)
  {
    if (Auth::user()->id !== $folder->user_id) {
      abort(403);
    }

  // FolderモデルのallのクラスメソッドでDBのデータ全て取得
    $folders = Auth::user()->folders()->get();

  //選ばれたフォルダ取得
    $tasks = $folder->tasks()->get();

    $share_folders = ShareFolder::paginate(5);

    // dd($share_folder);

    // $share_tasks = $share_folder->first();

    return view('tasks/index', [
      'folders' => $folders,
      'current_folder_id' => $folder->id,
      'tasks' => $tasks,
      // ↓共有テーブル情報
      'share_folders' => $share_folders,
    ]);
  }

//タスク作成フォーム
  public function showCreateForm(Folder $folder)
  {

// コントローラーメソッドの引数で受け取ってview関数でテンプレートへ
    return view('tasks/create', [
      'folder_id' => $folder->id,
    ]);
  }

  public function create(Folder $folder, CreateTask $request)
  {

    $task = new Task();
    $task->title = $request->title;
    $task->due_date = $request->due_date;

//結合しているので$current_folderに紐づくタスクを作成
    $folder->tasks()->save($task);

    return redirect()->route('tasks.index', [
      'folder' => $folder->id,
    ]);
  }

// タスク編集
  public function showEditForm(Folder $folder, Task $task)
  {

    $this->checkRelation($folder, $task);

// 編集対象のタスクデータを取得してテンプレートに渡す
    return view('tasks/edit', [
      'task' => $task,
    ]);
  }

// バリデーションの結果をテンプレートに表示
  public function edit(Folder $folder, Task $task, EditTask $request)
  {
    $this->checkRelation($folder, $task);

// 編集対象の$taskに入力値を詰めてsaveする
    $task->title = $request->title;
    $task->status = $request->status;
    $task->due_date = $request->due_date;
    $task->save();

// $taskのタスク属する一覧ページへリダイレクト
    return redirect()->route('tasks.index', [
      'folder' =>$task->folder_id,
    ]);
  }

  private function checkRelation(Folder $folder, Task $task)
  {
    if ($folder->id !== $task->folder_id) {
      abort(404);
    }
  }

  public function delete(Folder $folder)
  {
    $folder->where('id',$folder->id)->delete();
    $redirect_id = $folder->where('user_id',Auth::id())->value('id');
    if(empty($redirect_id)) {
      return redirect()->route('folders.create');
    }
    return redirect()->route('tasks.index', [
      'folder' =>$redirect_id,
    ]);
  }
}
