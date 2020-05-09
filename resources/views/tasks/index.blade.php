@extends('layout')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col col-md-4">
          <nav class="panel panel-default">
            <div class="panel-heading">フォルダ</div>
            <div class="panel-body">
              <a href="{{route('folders.create')}}" class="btn btn-default btn-block">
                フォルダを追加
              </a>
            </div>
            <div class="list-group">

  {{--コントローラから渡されたデータを参照させる--}}
              @foreach($folders as $folder)
              <div class="list-group-item d-flex justify-content-between {{$current_folder_id === $folder->id ? 'active' : ''}}">
  {{--ルーティングの設定を関数routeでURLを作り出している--}}
  {{--$current_folder_id、観覧しているフォルダのIDとIDの合致した場合にactiveというHTMLクラス--}}
                <div>
                    <a href="{{route('tasks.index', ['folder' => $folder->id])}}"
                      class="{{$current_folder_id === $folder->id ? 'active' : ''}}">
                      {{$folder->title}}
                    </a>
                </div>
                <div>
                  <a class="btn btn-danger" href="{{route('folders.delete', ['folder' => $folder->id])}}">削除</a>
                </div>
              </div>
              @endforeach
            </div>
          </nav>
        </div>
        <div class="column col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading">タスク</div>
            <div class="panel-body">
              <div class="text-right">
                <a href="{{route('tasks.create', ['folder' => $current_folder_id])}}" class="btn btn-default btn-block">
                  タスクを追加する
                </a>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>タイトル</th>
                  <th>状態</th>
                  <th>期限</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($tasks as $task)
                <tr>
                  <td>{{$task->title}}</td>
                  <td>
                    <span class="label">{{$task->status_label}}</span>
                  </td>
                  <td>{{$task->due_date}}</td>

          {{--ルーティングの設定を関数routeでURLを作り出している--}}
                  <td><a href="{{route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id])}}">編集</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
      <div class="col col-md-12">
        <nav class="panel panel-default">
          <div class="panel-heading">共有フォルダ</div>
          <div class="panel-body">
            <a href="{{route('share_folders.create')}}" class="btn btn-default btn-block">
              フォルダを追加
            </a>
          </div>
          <div class="list-group">

{{--コントローラから渡されたデータを参照させる--}}
            @foreach($share_folders as $folders)
            <div class="list-group-item d-flex justify-content-between">
{{--ルーティングの設定を関数routeでURLを作り出している--}}
{{--$current_folder_id、観覧しているフォルダのIDとIDの合致した場合にactiveというHTMLクラス--}}
              <div>
                  <a href="{{ route('share_tasks.index', ['folder_id' => $folders->id]) }}">
                    {{$folders->title}}
                  </a>
              </div>
              <div>
                <a class="btn btn-danger" href="{{route('share_folders.delete', ['folder' => $folder->id,'folders' => $folders->id])}}">削除</a>
              </div>
            </div>
            @endforeach
          </div>
        </nav>
        <ul class="page">{{ $share_folders->links() }}</ul>

      </div>
    </div>
  </div>
@endsection
