<!-- extends lead to main layout app.blade.php -->
@extends('layouts.app')

<!-- actual layout of the view -->
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <!-- {{$user->name}} stand for username from $user in controller -->
          <b>Edit {{$user->name}}</b>
        </div>
        <div class="card-body">
          <!-- form for function post -->
          <form action = "/infoedit/<?php echo Auth::user()->id; ?>" method = "post">
            <!-- dont know what this for -->
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <div class="name">
              <p>
                <b>
                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name:') }}</label>
                  <input name="name" value="{{$user->name}}"/>
                  @if ($errors->has('name'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif
                </b>
              </p>
            </div>
            <div class="email">
              <p>
                <b>
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email:') }}</label>
                  <input name="email" value="{{$user->email}}"/>
                  @if ($errors->has('email'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </b>
              </p>
            </div>
            <div class="question">
              <p>
                <b>
                  <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question:') }}</label>
                  <input name="question" value="{{$user->question}}"/>
                  @if ($errors->has('question'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('question') }}</strong>
                  </span>
                  @endif
                </b>
              </p>
            </div>
            <div class="answer">
              <p>
                <b>
                  <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer:') }}</label>
                  <input name="answer" value="{{$user->answer}}" type="password"/>
                  @if ($errors->has('answer'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('answer') }}</strong>
                  </span>
                  @endif
                </b>
              </p>
            </div>
            <div class="descr">
              <p>
                <b>
                  <label for="descr" class="col-md-4 col-form-label text-md-right">{{ __('Description:') }}</label>
                  <input name="descr" value="{{$user->descr}}"/>
                </b>
              </p>
            </div>
            <div>
              <input type = 'submit' value = "Save changes" />
              <a class="btn btn-link" href="{{ route('info',[Auth::user()->id]) }}">
                <input type = 'submit' value = "Back"/>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
