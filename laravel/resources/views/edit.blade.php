@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <b>Edit {{$user->name}}</b>
                </div>
                <div class="card-body">
                  <form action = "/infoedit/<?php echo Auth::user()->id; ?>" method = "post">
                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                  <div class="name">
                    <p>
                      <b>
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name:') }}</label>
                        <input name="name" value="{{$user->name}}"/>
                      </b>
                    </p>
                  </div>
                  <div class="email">
                    <p>
                      <b>
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email:') }}</label>
                        <input name="email" value="{{$user->email}}"/>
                      </b>
                    </p>
                  </div>
                  <div class="question">
                    <p>
                      <b>
                        <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question:') }}</label>
                        <input name="question" value="{{$user->question}}"/>
                      </b>
                    </p>
                  </div>
                  <div class="answer">
                    <p>
                      <b>
                        <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer:') }}</label>
                        <input name="answer" value="{{$user->answer}}" type="password"/>
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
                  </div>
                  </form>
                </div>
              </div>
          </div>
      </div>
  </div>
@endsection
