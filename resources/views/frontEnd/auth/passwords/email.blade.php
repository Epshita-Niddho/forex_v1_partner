@extends('frontEnd.layouts.layout')
@section('title')
<title>Password Reset | GICM</title>
@stop
@section('content')
<style type="text/css">
  .cusbut:hover{background: #2095F2 !important;}
</style>
<section class="blog-single" style="margin:150px 0 50px;">
  <div class="container">
    <!-- message div -->
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
     @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif
    <!-- end of message div -->
    <div class="row">
      <div class="col-md-12">
        <div class="row col-md-offset-2">
          <div class="col-md-8">
            <h1 style="text-align: center;">Password Reset | GICM</h1>
          </div>
        </div>
        <hr>
        <div class="row col-md-offset-3">
          <div class="col-md-6">
            {!! Form::open(['method' => 'POST', 'url' => '/customer/password/email', 'class' => 'form-horizontal']) !!}
            <div class="form-group" :class="{'has-error' : errors.email}">
              {!! Form::email('email', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Valid Email','style'=>'margin:5% 33%;width:400px;height:40px;border:1px solid #ddd;']) !!}
              <small class="text-danger"></small>
            </div> 
            <div class="" style="text-align: center;">
              {!! Form::submit("Send Reset Link", ['class' => 'btn btn-info input-lg cusbut']) !!}
            </div>

            {!! Form::close() !!}
          </div>   
        </div>
      </div>
    </div>
  </div>
</section>
@endsection