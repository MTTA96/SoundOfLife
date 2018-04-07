@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->name}}</div>
                <div class="card-body">
                        <div class="email">
                            {{$user->email}}
                        </div>
                        <div class="question">
                            {{$user->question}}
                        </div>
                </div>
              </div>
          </div>
      </div>
  </div>
@endsection
