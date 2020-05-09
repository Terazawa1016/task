@extends('layout')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col col-md-offset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">フォルダを追加する</div>
            <div class="panel-body">
              {{--エラーの文を表示--}}
              @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $message)
                  <p>{{$message}}</p>
                  @endforeach
                </ul>
              </div>
              @endif
              {{--エラー文ここまで--}}
              <form action="{{route('folders.create')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="title">フォルダ名</label>
                  {{--valueの所は入力エラーでフォーム画面に戻ったときに値を残したままにする--}}
                  <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}" />
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
