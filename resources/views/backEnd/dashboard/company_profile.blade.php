@extends('backEnd.dashboard.layout')

@section('title', 'Company Profile')
@section ('link')
<!--Plugin style-->

    <link type="text/css" rel="stylesheet" href="vendors/modal/css/component.css"/>
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" type="text/css" href="vendors/animate/css/animate.min.css" />
    <!-- end of plugin styles -->
    <link type="text/css" rel="stylesheet" href="css/pages/portlet.css"/>
    <link type="text/css" rel="stylesheet" href="css/pages/advanced_components.css"/>
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>

    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap-switch/css/bootstrap-switch.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/switchery/css/switchery.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/radio_css/css/radiobox.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/checkbox_css/css/checkbox.min.css" />
    <!--End of Plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="css/pages/radio_checkbox.css" />
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>

    <link type="text/css" rel="stylesheet" href="css/pages/buttons.css"/>
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>
    <link rel="stylesheet" type="text/css" href="assets/backEnd/css/notification.css">


@endsection

@section('content')
<div id="notification">
    <div class="noti-cross" style="display: none;"><i class="fa fa-times" id="cross" onclick="closeNoti()" aria-hidden="true"></i></div>
    
    <div id="noti-body" style="display: none;">
        @if(session()->has('msg'))
        {{session()->get('msg')}}
        {{session()->forget('msg')}}
        @endif
    </div>
    
</div>

<div id="notification-ajax">
    <div class="noti-cross"><i class="fa fa-times" id="cross" onclick="closeNotiAjax()" aria-hidden="true"></i></div>
    <div id="noti-body-ajax">
        Company Profile updated successfully
    </div>
</div>

<div id="content" class="bg-container">
	<header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-user" style="margin-left: 2%"></i>
                        Company Profile
                    </h4>
                </div>
            </div>
        </div>
    </header>
    
    <div class="outer">
    	<div class="inner bg-container">
                <form action="/save-personal-info" method="post" class="form-horizontal">
                    {{csrf_field()}}
    		<div class="row">
                <div class="col-md-12" style="margin: 0;padding: 0">
                    <div class="form-group col-md-6">
                        <label for="" class="inputlg" style="font-size: 15px">Company Email</label>
                        <input id="profile_email" class="form-control input-lg" disabled=""
                         value="{{$profile->email}}" type="text" style="height: 40px;width:70%">
                    </div>

                                <div class="form-group col-md-6">
                                    <label for="" style="font-size: 15px">Company Name:</label>
                                    <input type="text" class="form-control input-lg" disabled="" value="{{$profile->fname}}"  style="height: 40px;width:70%">
                                </div>

                                <div class="clearfix"></div>
                                
                                
                                <div class="form-group col-md-6">
                                    <label for="" style="font-size: 15px">Company Phone:</label>
                                    <input type="text" class="form-control input-lg" disabled="" value="{{$profile->mobile}}"  style="height: 40px;width:70%">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" style="font-size: 15px">Secondary Phone:</label>
                                    <input name="second_mobile" class="form-control input-lg" value="{{$profile->second_mobile}}" type="text" style="height: 40px;width:70%">
                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group col-md-6">
                                    <label for="" style="font-size: 15px">Country:</label>
                                    <input type="text" class="form-control input-lg" disabled="" value="{{$profile->country}}"  style="height: 40px;width:70%">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="" style="font-size: 15px">Registered Number:</label>
                                    <input type="text" name="reg_no" id="reg_no" class="form-control input-lg" value="{{$profile->reg_no}}" style="height: 40px;width:70%">
                                </div>
                                
                                <div class="clearfix"></div>
                              
                               
                                <div class="form-group col-md-6">
                                    <label for="" style="font-size: 15px">Company Address:</label>
                                      <textarea class="form-control" rows="5" id="comment" disabled="" style="width: 70%">{{$profile->address}}</textarea>
                                </div>
                                
                                
                                        
                                
                                <div class="form-group col-md-6">
                                    <label for="" style="font-size: 15px">Years of Experience:</label>
                                    <input type="text" name="trading_experience" class="form-control input-lg" value="{{$profile->trading_experience}}"  style="height: 40px;width:70%">
                                </div>
                                <div class="clearfix"> </div>

                                <div class="col-md-6">
                                <button class="btn btn-success center-block" id="save-button" type="button">Save</button>
                                
                                    
                                </div>

                </div>
            </div>
                            </form>      
    	</div>
    </div>
    <div class="outer">
        <div class="inner bg-container">
 

            <!--top section widgets-->
            <div class="card">      
                            
                <div class="row">

                    <div class="col-md-12">
                        <div class="varification">
                            <h4>Profile Verification : 
                            @if($condition1)
                            @if(!$sub_condition1)
                            <span style="color: green">Verified<i class="fa fa-check profile-verification-icon" aria-hidden="true"></i></span>
                            @else
                            <span style="color: tomato">Pending<i class="fa fa-info profile-verification-icon" aria-hidden="true"></i></span>
                            @endif
                            @elseif($condition2)
                            <span style="color: tomato">Not Verified<i class="fa fa-times profile-verification-icon" aria-hidden="true"></i></span>
                            @elseif($condition3)
                            <span style="color: #fc2">Partially Verified<i class="fa fa-info profile-verification-icon" aria-hidden="true"></i></span>
                             @else
                             <span style="color: tomato">Pending<i class="fa fa-info profile-verification-icon" aria-hidden="true"></i></span>
                             @endif
                        </h4>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="identity-verification m-b-20">
                                                <div class="col-md-1">
                                                    <div class="left-img">
                                                        <img src="img/user-avatar-with-check-mark.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="des-identity">
                                                        <p>Company Identity Verification</p>
                                                        <p>Color high-resolution scan copies or photos of a document, which verifies the company with full name, registered number are clearly seen.</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="position: relative;">
                                                    <div class="details-button">
                                                        <a href="/identity-documents-details">Details</a>
                                                    </div>
                                                    <div class="verify-button">
                                                        <a href="/not-verified">Verify Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="identity-verification">
                                                <div class="col-md-1">
                                                    <div class="left-img">
                                                        <img src="img/house.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="des-identity">
                                                        <p>Company Address Verification</p>
                                                        <p>Color high-resolution scan copies or photos of a document where company address is clearly seen and match the data indicated in company profile. The document should be issued not later than 3 months ago. </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="position: relative;">
                                                    <div class="details-button">
                                                        <a href="/resident-documents-details">Details</a>
                                                    </div>
                                                    <div class="verify-button">
                                                        <a href="/not-verified">Verify Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                            
                        </div>

                        <div class="card" style="margin-top: 5%">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="varification">
                                        <h4>Uploaded documents</h4>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Status</th>
                                                        <th>Comment</th>
                                                        <th>View Document</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($doc as $key => $documents)
                                                    <tr>
                                                        <td>{{ Carbon\Carbon::parse($documents->date_time)->format('d-m-Y') }}</td>
                                                        <td>{{$documents->document_type}}</td>
                                                        <td>@if($documents->status == 0)Pending @elseif($documents->status == 1) Approved @else Cancelled @endif</td>
                                                        <td>{{$documents->comment}}</td>
                                                        <td>
                                                            <a href="{{$documents->document}}"><img src="img/picture.png" width="10%"></a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






    </div>
</div>
@endsection


@section('script')


<script type="text/javascript" src="js/pages/modals.js"></script>

<!--Plugin scripts-->
<script type="text/javascript" src="vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="vendors/switchery/js/switchery.min.js"></script>
<!--End of plugin scripts-->
<!--Page level scripts-->
<script type="text/javascript" src="js/pages/radio_checkbox.js"></script>
<!--End of Page level scripts-->
<!-- end page level scripts -->

<script type="text/javascript" src="vendors/raphael/js/raphael-min.js"></script>
<script type="text/javascript" src="vendors/Buttons/js/scrollto.js"></script>
<script type="text/javascript" src="vendors/Buttons/js/buttons.js"></script>
<script type="text/javascript" src="assets/backEnd/js/notification.js"></script>

<script>
    $(function(){
        $('.radio-class').on('change',function(){
        var v = $(this).val();
        if (v == 'yes') {
            $('#collapseOne').addClass('in');
            $('.partner-pass').prop('required', true);
        }
        else{
            $('#collapseOne').removeClass('in');
            $('.partner-pass').prop('required', false);

        }
        });
    });
</script>
<script type="text/javascript">
    $(function(){
        $('.image-show').hide();
        $('.image-icon').click(function(){
        $('.image-show').show();
        $('.image-show').hide();
    });
        // $('.lazy').Lazy();
});
</script>
<script>
$(function(){
    $('#save-button').on('click',function(){
    
    
    var second_mobile = $('input[name=second_mobile]').val();
    
    var trading_experience = $('input[name=trading_experience]').val();
    var reg_no = $('input[name=reg_no]').val();
    
    
    //alert(password_preference)
    $.ajax({
        url: "/save-personal-info",
        type: "POST",
        data:{
            _token:$('input[name=_token]').val(),
            
            
            second_mobile:second_mobile,
            trading_experience:trading_experience,
            reg_no:reg_no,
            
        },
        success: function(data){
            $('#notification-ajax').show();
            setTimeout(function(){$('#notification-ajax').hide();},5000);

        }
    });

    });
    
});
</script>
@endsection