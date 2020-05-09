@extends('layout')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <p class="card-title">あなたのコメント</p>
            <p class="card-text">{{$comment->body}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
