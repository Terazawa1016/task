<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShareFolder;
use App\Http\Requests\CreateFolder;

class ContentController extends Controller
{
    public function index()    
    {
      $share_folders = ShareFolder::paginate(5);  
      return view('content',compact('share_folders'));
    }

    public function shareCreate()
    {
        return view('content_create');
    }

    public function create(CreateFolder $request)
    {
        $folder = new ShareFolder;

        $folder->title = $request->title;
        $folder->save();

          // フォルダ作成が完了したらそのフォルダに対応する一覧画面へと遷移させる
        return redirect()->route('content');
    }
    public function delete(ShareFolder $folders)
    {
  
      $folders->where([
          'id'=>$folders->id,
          ])->delete();

      return redirect()->route('content');
    }
}
