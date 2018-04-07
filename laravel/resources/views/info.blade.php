@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <b>{{$user->name}}</b>
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
                <input type="submit" value="Edit account"/>
              </a>
              <a class="btn btn-link" href="{{ route('changepass',[Auth::user()->id]) }}">
                  <input type="submit" value="Change password"/>
              </a>
              <a  href="/">
                <input type="submit" value="Home"/>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
