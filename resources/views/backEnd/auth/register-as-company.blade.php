
@extends('backEnd.auth.signin-layout')
@section ('title')
Register as Company
@endsection

@section('css-link')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
<!-- main css file -->
<link type="text/css" rel="stylesheet" href="{{asset('css/pages/live-account-reg.css')}}"/>
<style type="text/css">
.rules{
  position: absolute;
  top: 100%;
  font-size: 12px;
  width: 95%
}
#message{
  position: absolute;
  font-size: 10px;
  top: 100%;
}
.message{
  position: absolute;
  font-size: 10px;
  
  left: 60%;
  top: 30%

}
</style>
@endsection



@section('main-body')

<section class="main-body">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12 col-xs-12  form-div-height">
        
        <div class="col-md-8 col-md-push-2 col-xs-12  col-sm-8 text-center">
          <!-- multistep form -->
          <form id="myform" method="post" action="/register-as-company">
            {{csrf_field()}}
            
            <fieldset id="x">
              <h2 class="fs-title">Register as Company</h2>
              <hr>
              
              <!-- <h3 class="fs-subtitle">This is step 1</h3> -->
              <div class="row">
                @if (Session::has('register'))
                <span class="help-block">
                  <strong style="color: #00bf86 ;float: left;text-align:left;">{{ Session::get('register') }}</strong>
                </span>
                @endif  
                <div class="row">
                  <div class="col-md-10 col-md-push-1">
                    
                        <div class="form-group">
                          <input type="text" id="fname" name="fname" style="color: #777" value="{{ old('fname') }}"  required="required" />
                          <label class="control-label" for="input">Company Name *</label><i class="bar"></i>
                        </div>

                      </div>
                                            
                    </div>

                   
                    
                    <div class="row">
                      
                      <div class="col-md-10 col-md-push-1">
                      
                    <div class="form-group">
                      <input type="email" id="email" name="email" style="color: #777" value="{{ old('email') }}" required="required" />
                      <label class="control-label" for="input">Company Email *</label><i class="bar"></i>
                    </div>
                    @if (Session::has('email'))
                    <span class="help-block">
                      <strong style="color: #ff8080;text-align: left;">{{ Session::get('email') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5 col-md-push-1">
                    <div class="form-group">
                      
                      
                      <input type='password' name='password' id='passwordField' class='' autocomplete='new-password' required="required" />
                      <!-- <span class ='message'></span> -->
                      <label class="control-label" for="input">Password *</label><i class="bar"></i>
                    </div>
                  </div>
                  <!-- <div class="clearfix"></div> -->
                  <div class="col-md-5 col-md-push-1">
                    <div class="form-group">
                      
                      
                      <input type="password" name="c_password" id="c_password" required="required"
                      class="" style="">
                      <!-- <span id='message'></span> -->
                      <label class="control-label" for="input" style="">Confirm Password *</label><i class="bar"></i>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5 col-md-push-1">
                   
                   
                    <div class="wrap">
                      
                      <!--Select with pure css-->
                      <div class="select">
                        <select class="select-text" id="country" name="country" style="color: #777" required>
                          <option code="" selected="selected" disabled="disabled" style="color: #777">Select Country</option>
                          @foreach($countries as $country)
                          <option value="{{$country->countries_name}}" id="{{$country->countries_id}}" code="+{{$country->countries_isd_code}}" @if($selected_country == $country->countries_name) selected="selected" @endif>{{$country->countries_name}}</option>
                          @endforeach
                        </select>
                        <span class="select-highlight"></span>
                        <span class="select-bar"></span>
                        <small class="label-style">Country *</small>
                        <!-- <label class="select-label">Select Country</label> -->

                      </div>
                      <!--Select with pure css-->
                      
                    </div>
                  </div>
                  <div class="col-md-5 col-md-push-1">
                      
                    <div class="form-group" style="margin-top: 20px">
                      <input type="text" id="phone" style="color: #777" value="{{ old('phone') }}" name="phone" />
                      <label class="control-label" for="input" style="margin-top: 11px">Phone *</label><i class="bar"></i>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <div class="form-group">
                          <input type="text" id="address" style="color: #777;" name="address" value="{{ old('address') }}" required="required" />
                          <label class="control-label" for="input" style="">Address *</label><i class="bar"></i>
                        </div>
                      </div>
                </div>
                
                <div class="row">
                  
                  <div class="col-md-5 col-md-push-1">
                    <div class="form-group">

                      <input type="text" id="reg_no" style="color: #777;" name="reg_no" value="{{ old('reg_no') }}" required/>
                      <label class="control-label" for="input" style="">Registration Number</label><i class="bar"></i>

                      
                    </div>
                  </div>

                  <div class="col-md-5 col-md-push-1">
                    <div class="form-group">
                      <input type="text" id="trading_experience" style="color: #777;" name="trading_experience" value="{{ old('trading_experience') }}" required />
                      <label class="control-label" for="input" style="">Years of Experience</label><i class="bar"></i>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- <div class="row text-center"> -->
                
                <input type="button" name="next" class="next action-button" value="Submit" id="next"/>
                <!-- </div>   -->
                
                
                  </fieldset>
                  
                </form>
              </div>
              <!-- <div class="col-md-4 col-md-pull-8 col-sm-4 col-xs-12 ">
                <div class="side-des">
                  <img src="/img/register_page_img.png" alt="" class="img-responsive center-block" style="max-width: 135px">
                  <h2>{{$general_info->open_demo_account_page_header}}</h2>
                  <hr>
                  <h3>{{$general_info->open_demo_account_page_subheader}}</h3>
                  <hr>
                  <ul>
                    <li><span class="form-icon"><i class="fas {{$general_info->open_demo_account_page_icon1}}"></i></span>{{$general_info->open_demo_account_page_text1}}</li>
                    <li><span class="form-icon"><i class="fas {{$general_info->open_demo_account_page_icon2}}"></i></span>{{$general_info->open_demo_account_page_text2}}</li>
                    <li><span class="form-icon"><i class="fas {{$general_info->open_demo_account_page_icon3}}"></i></span>{{$general_info->open_demo_account_page_text3}}</li>
                    <li><span class="form-icon"><i class="fas {{$general_info->open_demo_account_page_icon4}}"></i></span>{{$general_info->open_demo_account_page_text4}}</li>
                  </ul>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </section>

      @endsection


      @section('js-link')
      <script src="/js/jquery.easing.min.js"></script>
      <script src="/js/jquery-ui.js"></script>
      <script src="/js/jquery.validate.js"></script>
      <script type="text/javascript" src="{{asset('js/pages/live-account-reg.js')}}"></script>
      <!-- <script type="text/javascript" src="/js/bootstrap-select.min.js"></script> -->
      
      <script type="text/javascript">
        $(document).ready(function($) {
          var Body = $('body');
          Body.addClass('preloader-site');
        });
        $(window).load(function() {
          $('.preloader-wrapper').fadeOut();
          $('body').removeClass('preloader-site');
        });
      </script>
      <script type="text/javascript">
      $(document).on('change','#country',function(e){
        var value=$('option:selected', this).attr('code');
        $('#phone').val(value);
        $('option:selected', '#country').css('color','#fff');
      });
    </script>
 
    <script>
      $(document).ready(function(){


$("#next").click(function(){

  $('#reg_no').removeAttr('required');
  $('#trading_experience').removeAttr('required');
  var form = $("#myform");
form.validate({
  rules: {   

    fname: {
      required: true,
      
    },
    password : {
      required: true,
      minlength: 8,
    },
    c_password : {
      required: true,
      equalTo: '#passwordField',
    },    
    
    phone : {
      required: true,
      min: 0,
      minlength:8,
      maxlength: 20,
    }, 
    
    deposit : {
      required: true,
      min : 1,
    },
    
    email: {
      required: true,
    }, 
    agree: {
      required: true,
    }
    
  },
  messages: {
    
    fname: {
      required: "Company name is required",
    },
    password : {
      required: "Please enter the password"
    },
    c_password: {
      required: "Please enter the password",
      equalTo: "Password does not match"
    },
    email: {
      required: "Please enter Company email address"
    },
    country: {
      required: "Please select a country"
    },

    phone: {
      min: "Enter valid phone number",
      required: "Please enter Company phone number"
    },

    address: {
      required: "Please enter Company address"
    }    
  }
})


if (form.valid()==true) {


  form.submit();
}

});

$("[id='country']").on("change", function () {
$("[name='phone']").val($(this).find("option:selected").data("code"));
});
});

</script>

@endsection