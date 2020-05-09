@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="column col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">共有タスク</div>
              <div class="panel-body">
                <div class="text-right">
                  <a href="{{route('share_tasks.create', ['folder_id' => $share_folder->id])}}" class="btn btn-default btn-block">                    

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
                  {{-- @php 
                  $taskv = $task->ShareTask;
                  dd($taskv);
                  @endphp --}}
    
                  <tr>
                    <td>{{$task->title}}</td>
                    <td>
                      <span class="label">{{$task->status_label}}</span>
                    </td>
                    <td>{{$task->due_date}}</td>
    
            {{--ルーティングの設定を関数routeでURLを作り出している--}}
                    {{-- <td><a href="{{route('share_tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id])}}">編集</a></td> --}}
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
          <a class="my-navbar-brand" href="/"><i class="fas fa-angle-double-left">戻る</i></a>

        </div>
    </div>
</div>
@endsection
