@extends('backEnd.dashboard.layout')
@section('title', 'Fund Withdrawal')
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
                    <!-- <div class="col-lg-6">
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
                    </div> -->
                </div>
            </header>
            <div class="outer">
                <div class="inner bg-container">
                    <div class="">

                        <div class="card-block " style="margin-top: 20px;">
                            <h2>Transfer Balance to Trading Account</h2>
                   @if($errors->any())
                            <h4 class="" style="color:red;">{{$errors->first()}}</h4>
                            @endif         
                <div class="row m-t-35" >
               

                {!! Form::open(['method' => 'POST','files' => true, 'url' => '/withdraw', 'name' => 'withdrawForm','class'=>'col-md-3']) !!}

                    <div class="form-group">
                        
                             {!! Form::label('trading_account', ' Trading Account *') !!}
                            <select name="trading_account" required="required" class="form-control">
                            <option value="">Select trading Account</option>
                          @foreach($trading_accounts as $tr)
                                <option value="{{$tr->account_no}} ({{$tr->act_type}})">{{$tr->account_no}} ({{$tr->act_type}})</option>
                                                     @endforeach                     
                            </select>   
                        <small class="text-danger">{{ $errors->first('trading_account') }}</small>
                        </div>
                        <div class="form-group">
                            {!! Form::label('amount', ' Amount *') !!}
                        {!! Form::text('amount', null, ['class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Enter Amount']) !!}
                        <small class="text-danger">{{ $errors->first('amount') }}</small>
                        </div>
                        <div class="form-group">
                        {!!Form::submit('Confirm',['class'=>'btn btn-primary ','style'=>'margin-top:15px;'])!!}
                        </div>
                        {!!Form::close()!!}  
                        </div>
                    </div>
                        </div>
                         <div class="card m-t-35">

                        <div class="card-block " style="margin-top: 20px;">
                            <h2>Other Withdraw Options</h2>
                            <div class="row m-t-35" style="margin-bottom: 30px;">
                            @if($methods != 'all')
                            @foreach($methods as $method)
                            <!-- @if($method == 'neteller')
                            <div class="col-md-3">
                            <div class="payhod card"><a href="/neteller_withdraw"><img width="200px" height="80px" src="/img/payment/neteller.png" alt=""></a></div>
                            </div>
                            @endif
                            @if($method == 'skrill')
                            <div class="col-md-3">
                            <div class=" payhod card"><a href="/skrill_withdraw"><img width="200px" height="80px" src="/img/payment/skrill.png" alt=""></a></div>
                            </div>
                            @endif -->
                            @if($method == 'bank')
                            <div class="col-md-3">
                            <div class=" payhod card"><a href="/bank_transfer"><img width="200px" height="80px" src="/img/payment/bank.svg" alt=""></a></div>
                            </div>
                            @endif
                            @endforeach
                            @else
                            <!-- <div class="col-md-3">
                            <div class="payhod card"><a href="/neteller_withdraw"><img width="200px" height="80px" src="/img/payment/neteller.png" alt=""></a></div>
                            </div>
                            <div class="col-md-3">
                            <div class=" payhod card"><a href="/skrill_withdraw"><img width="200px" height="80px" src="/img/payment/skrill.png" alt=""></a></div>
                            </div> -->
                            <div class="col-md-3">
                            <div class=" payhod card"><a href="/bank_transfer"><img width="200px" height="80px" src="/img/payment/bank.svg" alt=""></a></div>
                            </div>
                            @endif
                            </div>

                        
                    </div>
                        </div>
                    </div>
                    </div>
                    
                    @endsection
                