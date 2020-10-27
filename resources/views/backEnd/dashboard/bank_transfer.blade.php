@extends('backEnd.dashboard.layout')
@section('title', 'Bank Transfer')
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
                                <a href="/neteller_withdraw">Bank Transfer</a>
                            </li>
                            
                        </ol>
                    </div>
                </div>
            </header>
            <div class="outer">
                <div class="inner bg-container">
                    <div class="card">

                        <div class="card-block m-t-35">
							<h2>Bank Wire Transfer</h2>
							{!! Form::open(['method' => 'POST', 'url' => '/bank_transfer', 'name' => 'withdrawForm','class'=>'col-md-4']) !!}
                            @if($errors->any())
                            <h4 style="color:red;">{{$errors->first()}}</h4>
                            @endif
					<div class="form-group">
						
							{!! Form::label('amount', 'Amount to be withdrawn *') !!}
                        {!! Form::text('amount', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Amount']) !!}
						<small class="text-danger">{{ $errors->first('amount') }}</small>
                        </div>
                        

                        <div class="form-group">
                        
                            {!! Form::label('bank_name', 'Bank Name *') !!}
                        {!! Form::text('bank_name', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Bank Name']) !!}
                        <small class="text-danger">{{ $errors->first('bank_name') }}</small>
                        </div>

                        <div class="form-group">
                        
                            {!! Form::label('bank_country', 'Bank Country *') !!}
                        {!! Form::text('bank_country', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Bank Country']) !!}
                        <small class="text-danger">{{ $errors->first('bank_country') }}</small>
                        </div>

                        <div class="form-group">
                        
                            {!! Form::label('bank_acc_name', 'Bank Account Name *') !!}
                        {!! Form::text('bank_acc_name', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Bank Account Name']) !!}
                        <small class="text-danger">{{ $errors->first('bank_acc_name') }}</small>
                        </div>

                        <div class="form-group">
                        
                            {!! Form::label('iban_num', 'IBAN Number *') !!}
                        {!! Form::text('iban_num', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter IBAN Number']) !!}
                        <small class="text-danger">{{ $errors->first('iban_num') }}</small>
                        </div>

                        <div class="form-group">
                        
                            {!! Form::label('swift_num', 'Bank Swift Code *') !!}
                        {!! Form::text('swift_num', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Bank Swift Code']) !!}
                        <small class="text-danger">{{ $errors->first('swift_num') }}</small>
                        </div>

                        <div class="form-group">
                        
                            {!! Form::label('bank_address', 'Bank Address *') !!}
                        {!! Form::textarea('bank_address', null, ['rows'=>'5','class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Bank Address']) !!}
                        <small class="text-danger">{{ $errors->first('bank_address') }}</small>
                        </div>
                        <div class="form-group">
                        
                            {!! Form::label('correspondent_bank', 'Correspondent Bank Name') !!}
                        {!! Form::text('correspondent_bank', null, ['class' => 'form-control input-lg', 'placeholder' => 'Enter Correspondent Bank Name']) !!}
                        <small class="text-danger">{{ $errors->first('correspondent_bank') }}</small>
                        </div>

                        <div class="form-group">
                        {!!Form::submit('Withdraw',['class'=>'btn btn-primary'])!!}
                        </div>
                        {!!Form::close()!!}
					</div>
                        </div>
                    </div>
					</div>
                    @endsection
                