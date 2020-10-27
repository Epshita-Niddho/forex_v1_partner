@extends('backEnd.dashboard.layout')
@section('title', 'Skrill Withdraw')
@section('content')
<div id="content" class="bg-container">
            <header class="head">
                <div class="main-bar row">
                    <div class="col-lg-6">
                        <a href="/withdraw"><h4 class="nav_top_align skin_txt">
                            <i class="fa fa-money"></i>
                           Fund Withdrawal
                        </h4>
                        </a>
                    </div>

                </div>
            </header>
            <div class="outer">
                <div class="inner bg-container">
                    <div class="card">

                        <div class="card-block m-t-35">
							<h2>Skrill Transfer</h2>
							{!! Form::open(['method' => 'POST','files' => true, 'url' => '/skrill_withdraw', 'name' => 'withdrawForm','class'=>'col-md-4']) !!}
                            @if($errors->any())
                            <h4 style="color:red;">{{$errors->first()}}</h4>
                            @endif
					<div class="form-group">
						
							{!! Form::label('amount', 'Amount to be withdrawn *') !!}
                        {!! Form::text('amount', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Amount']) !!}
						<small class="text-danger">{{ $errors->first('amount') }}</small>
                        </div>
                        

                        <div class="form-group">
                        
                            {!! Form::label('email', 'Skrill Email *') !!}
                        {!! Form::email('email', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Skrill Email Address']) !!}
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>

                        <div class="form-group">
                        {!!Form::submit('Withdraw',['class'=>'btn btn-primary'])!!}
                        </div>
                        {!!Form::close()!!}
					</div>
                        </div>
                        
					</div>
                    @endsection
                