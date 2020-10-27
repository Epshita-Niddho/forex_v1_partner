@extends('backEnd.dashboard.layout')
@section('title', 'Verification Code')
@section('content')
<div id="content" class="bg-container">
            <header class="head">
                <div class="main-bar row">
                    <div class="col-lg-6">
                        <a href="/withdraw"><h4 class="nav_top_align skin_txt">
                            <i class="fa fa-user"></i>
                           Fund Withdrawal
                        </h4>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb float-xs-right nav_breadcrumb_top_align">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">
                                    <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                   
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="/withdraw">Withdraw</a>
                            </li>
                            
                        </ol>
                    </div>
                </div>
            </header>
            <div class="outer">
                <div class="inner bg-container">
                    <div class="card">

                        <div class="card-block m-t-35">
							<h2>Enter Verification code</h2>
							<h5>A verification code is sent to {!!session('login_email')!!}</h5>
							{!! Form::open(['method' => 'POST', 'url' => '/verification_code', 'name' => 'verificationForm','class'=>'col-md-4']) !!}
					<div class="form-group">
                        
                            
                        {!! Form::text('verification_code', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter verification code']) !!}
                        
                            

                        <small class="text-danger">{{ $errors->first('verification_code') }}</small>
                        </div>
                        @if($errors->any())
                        <h5 style="color:red;">{{$errors->first()}}</h5>
                            @endif
                            {!!Form::hidden('payment_type',$request->payment_type)!!}
                        {!!Form::hidden('amount',$request->amount)!!}
                        {!!Form::hidden('account',$request->account)!!}
                        {!!Form::hidden('email',$request->email)!!}
                        {!!Form::hidden('bank_name',$request->bank_name)!!}
                        {!!Form::hidden('bank_country',$request->bank_country)!!}
                        {!!Form::hidden('bank_acc_name',$request->bank_acc_name)!!}
                        {!!Form::hidden('iban_num',$request->iban_num)!!}
                        {!!Form::hidden('swift_num',$request->swift_num)!!}
                        {!!Form::hidden('bank_address',$request->bank_address)!!}
                        {!!Form::hidden('correspondent_bank',$request->correspondent_bank)!!}
                        {!!Form::hidden('trading_account',$request->trading_account)!!}
                        <div class="form-group">
                        {!!Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                        </div>
                        {!!Form::close()!!}
					</div>
                        </div>
                    </div>
					</div>
                    
                    @endsection
                