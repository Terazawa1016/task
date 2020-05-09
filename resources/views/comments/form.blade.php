@extends('layout')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <form method="post" action="{{route('comment')}}">
              @csrf

              <div class="form-group">
                <label for="comment">コメントを入力してください</label>
                <textarea class="form-control" name="comment" id="comment" required></textarea>
              </div>

              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
