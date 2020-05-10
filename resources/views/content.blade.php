@extends('layout')

@section('content')
    <div class="container">
        <div>
            <a class="text-center" href="{{ route('login') }}">
                <p class="text-center">ログインしてマイタスクを作成</p>
            </a>
        </div>
      <div class="row">
      <div class="col col-md-12">
        <nav class="panel panel-default">
          <div class="panel-heading">共有フォルダ</div>
          <div class="panel-body">
            <a href="{{route('content.create')}}" class="btn btn-default btn-block">
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
                <a class="btn btn-danger" href="{{route('content.delete', ['folders' => $folders->id])}}">削除</a>
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
