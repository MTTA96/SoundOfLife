@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <img src="/storage/Avatar/{{ $user->avatar_img }}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;">
          <b>{{$user->name}}</b>
          <form enctype="multipart/form-data" action="/info" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
        <div class="card-body">
          <div class="email">
            <p>
              <b>
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Email:') }}</label> {{$user->email}}
              </b>
            </p>
          </div>
          <div class="question">
            <p>
              <b>
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Question:') }}</label> {{$user->question}}
              </b>
            </p>
          </div>
          <div class="descr">
            <p>
              <b>
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description:') }}</label> {{$user->descr}}
              </b>
            </p>
          </div>
            <div>
              <a  href="{{ route('infoedit',[Auth::user()->id]) }}">
                <input class="btn btn-success" type="submit" value="Edit account"/>
              </a>
              <a href="{{ route('changepass',[Auth::user()->id]) }}">
                  <input class="btn btn-danger" type="submit" value="Change password"/>
              </a>
              <a  href="/">
                <input class="btn btn-primary" type="submit" value="Home"/>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
