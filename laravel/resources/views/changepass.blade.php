@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <b>Change {{$user->name}} password</b>
        </div>
        <div class="card-body">
          <form action = "/changepass/<?php echo Auth::user()->id; ?>" method = "post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <div class="password">
              <p>
                <b>
                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>
                  <input name="password" type="password"/>
                  @if ($errors->has('password'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </b>
              </p>
            </div>
            <div class="confrim">
              <p>
                <b>
                  <label for="confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm password:') }}</label>
                  <input name="confirm" type="password"/>
                </b>
              </p>
            </div>
            <div>
              <input type = 'submit' value = "Save new password" />
              <a class="btn btn-link" href="{{ route('info',[Auth::user()->id]) }}">
                <input type = 'submit' value = "Back"/>
              </a>
              <a class="btn btn-link" href="{{ route('home') }}">
                <input type = 'submit' value = "Home"/>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
