@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="conteiner">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクを編集する</div>
          <div class="panel-body">
            @if($errors->any())
            <div class="alert alert-danger">
              @foreach($errors->all() as $message)
              <p>{{$message}}</p>
              @endforeach
            </div>
            @endif
            <form
                action="{{route('share_tasks.edit', ['folder_id' => $task->share_folder_id, 'task' => $task->id])}}"
                method="POST"
            >
            @csrf
            <div class="form-group">
              <label for="title">タイトル</label>

        {{--old('title', $task->title)をvalueに指定。
          old関数は直前の入力値を取得する。それを第２引数でデフォルト状態（$task->title）--}}
              <input type="text" class="form-control" name="title" id="title" value="{{old('title') ?? $task->title}}" />
            </div>
            <div class="form-group">
              <label for="status">状態</label>

        {{--配列の定数をSTATUS(モデルで定義してる)でforeachでループしてoption要素を出力している--}}
              <select name="status" id="status" class="form-control">

        {{--old('status',$task->status)は直前の入力値またはDBに登録済みの値を比べて
        一致していたらoptionタグの中に'selected'を出力--}}
                @foreach(\App\Task::STATUS as $key => $val)
                <option value="{{$key}}" "{{$key == old('status', $task->status) ? 'selected' : ''}}">
                {{$val['label']}}
                </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="due_date">期限</label>
              <input type="text" class="form-control" name="due_date" id="due_date"
                    value="{{old('due_date') ?? $task->formatted_due_date}}" />
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary">送信</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection
