@extends('BackEnd.english.layouts.master2')
@section('title')
<title>Login | Eat&amp;Goo - Every where, Everytime you can use</title>
@stop
@section('content')
<section class="blog-single">
  <div class="container">
     <!-- error div -->
     <div class="alert alert-danger" v-if="mismatchError">
      <span class="help-block" style="text-align:center; color:red">
        <strong>@{{ mismatchError }}</strong>
    </span>
</div>
<!-- end of error div -->
<div class="row">
  <div class="col-md-12">
    <div class="row col-md-offset-2">
      <div class="col-md-8">
        <h1 style="text-align: center;">Admin Login | Eat&amp;Goo</h1>
    </div>
</div>
<hr>
<div class="row col-md-offset-3">
  <div class="col-md-6">
    {!! Form::open(['method' => 'POST', 'url' => '/admin/login', 'class' => 'form-horizontal', 'date-remote' => 'data-remote', 'data-remote-success' => 'Login Successful.' , '@submit' => 'tryLogin']) !!}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" :class="{ 'has-error': errors.email}">
        {!! Form::email('email', null, ['class' => 'form-control input-lg', 'required' => 'required', 'autofocus', 'placeholder' => 'Enter Email', 'v-model' => 'loginCredentials.email']) !!}
        <small class="text-danger" v-if="errors.email">@{{ errors.email[0] }}</small>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" :class="{ 'has-error': errors.password}">
        {!! Form::password('password', ['class' => 'form-control input-lg', 'required1' => 'required1', 'placeholder' => 'Enter Password', 'v-model' => 'loginCredentials.password']) !!}
        <small class="text-danger" v-if="errors.password">@{{ errors.password[0] }}</small>
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" v-model= "loginCredentials.remember_me"> Remember Me
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12 col-md-offset-0">
            {!! Form::submit('Login', ['class' => 'btn btn-danger btn-lg']) !!}
            <a class="btn btn-link" href="{{ url('/admin/password/email') }}">
                Forgot Your Password?
            </a>
        </div>
    </div>
    {!! Form::close() !!}
</div>
</div>
</div>
</div>
</section>
@endsection
