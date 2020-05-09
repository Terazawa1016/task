<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;
use App\ShareFolder;

class ShareFolderController extends Controller
{
    public function shareCreate()
    {
        return view('share_folder.create');
    }

    public function create(CreateFolder $request)
    {
        $folder = new ShareFolder;

        $folder->title = $request->title;
        $folder->save();

        $user = Auth::user()->folders()->first();

          // フォルダ作成が完了したらそのフォルダに対応する一覧画面へと遷移させる
        return redirect()->route('tasks.index', [
            'folder' => $user->id,
        ]);
    }

}
