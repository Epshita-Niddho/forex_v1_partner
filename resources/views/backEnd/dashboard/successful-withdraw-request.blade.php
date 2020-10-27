@extends('backEnd.dashboard.layout')
@section('title', 'Withdrawal Request')
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

                        <div class="card-block ">
							
                            <h3 style="color:green;">You have successfully requested for Fund Transfer.</h3>
							
					</div>
                        </div>
                    </div>
					</div>
                    
                    @endsection
                