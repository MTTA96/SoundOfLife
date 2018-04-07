@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->name}}</div>
                <div class="card-body">
                        <div class="email">
                          <p><b>Email: {{$user->email}}</b></p>
                        </div>
                        <div class="question">
                          <p><b>Question: {{$user->question}}</b></p>
                        </div>
                        <div class="descr">
                          <p><b>Description: {{$user->descr}}</b></p>
                        </div>
                </div>
              </div>
          </div>
      </div>
  </div>
@endsection
