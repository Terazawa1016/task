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

class ShareTaskController extends Controller
{
    public function index(ShareFolder $folder_id) {
        $tasks = $folder_id->shareTask()->get();

        $share_folder = $folder_id;
        // dd($tasks);

        return view('share_tasks.share_task', [
            'tasks' => $tasks,
            'share_folder' => $share_folder,
        ]);
    }

//タスク作成フォーム
  public function showCreateForm(ShareFolder $folder_id)
  {
      
    // $folder = ShareFolder::find($folder_id);
    // dd($folder_id);
// コントローラーメソッドの引数で受け取ってview関数でテンプレートへ
    return view('share_tasks.create', [
      'folder_id' => $folder_id->id,
    ]);
  }

  public function create(ShareFolder $folder_id, CreateTask $request)
  {
    // dd($folder_id);
    $task = new ShareTask();
    $task->title = $request->title;
    $task->share_folder_id = $folder_id->id;
    $task->due_date = $request->due_date;
    $task = $task->save();

//結合しているので$current_folderに紐づくタスクを作成

    return redirect()->route('share_tasks.index', [
      'folder_id' => $folder_id->id,
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

  public function delete(Folder $folder,ShareFolder $folders)
  {

    $folders->where([
        'id'=>$folders->id,
        ])->delete();
    $redirect_id = $folder->where('user_id',Auth::id())->value('id');
    if(empty($redirect_id)) {
      return redirect()->route('folders.create');
    }
    return redirect()->route('tasks.index', [
      'folder' =>$redirect_id,
    ]);
  }
}
