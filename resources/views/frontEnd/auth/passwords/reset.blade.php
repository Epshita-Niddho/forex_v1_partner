@extends('BackEnd.english.layouts.master2')
@section('title')
<title>Password Reset | Eat&amp;Goo - Every where, Everytime you can use</title>
@stop
@section('content')
<section class="blog-single">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
            <div class="row col-md-offset-2">
              <div class="col-md-8">
                <h1 style="text-align: center;">Password Reset | Eat&amp;Goo</h1>
            </div>
        </div>
        <hr>
        <div class="row col-md-offset-3">
          <div class="col-md-6">
              {!! Form::open(['method' => 'POST', 'url' => '/admin/password/reset', 'class' => 'form-horizontal', '@submit' => 'EGpasswordReset']) !!}
              <div class="form-group" :class="{'has-error' : errors.email}">
                  {!! Form::email('email', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Valid Email', 'v-model' => 'passwordResetInfo.email']) !!}
                  <small class="text-danger" v-if="errors.email">@{{ errors.email[0] }}</small>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  {!! Form::password('password', ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Password', 'v-model' => 'passwordResetInfo.password']) !!}
                  <small class="text-danger" v-if="errors.password">@{{ errors.password[0] }}</small>
              </div>
              <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                  {!! Form::password('confirm_password', ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Password', 'v-model' => 'passwordResetInfo.confirm_password']) !!}
                  <small class="text-danger" v-if="errors.confirm_password">@{{ errors.confirm_password[0] }}</small>
              </div> 
              <div class="pull-right">
              {!! Form::submit("Reset Now", ['class' => 'btn btn-danger input-lg', ':disabled' => 'mandatoryPasswordReset']) !!}
              </div>

              {!! Form::close() !!}
          </div>   
      </div>
  </div>
</div>
</div>
</section>
@endsection