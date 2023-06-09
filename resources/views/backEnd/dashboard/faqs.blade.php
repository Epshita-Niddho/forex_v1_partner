@extends('backEnd.dashboard.layout')
@section('title', 'Frequently Asked Questions')
@section('content')
<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar row">
            <div class="col-lg-6">
                <a href="/faqs"><h4 class="nav_top_align skin_txt">
                    <i class="fa fa-question-circle"></i>
                    Frequently Asked Questions
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
                    <a href="/faqs">Frequently Asked Questions</a>
                </li>

            </ol>
        </div> -->
    </div>
</header>
<div class="outer">
<div class="row">
            <div class="col-lg-12 m-t-35">
                <div class="card" style="border: none;">
                   
                    <div class="card-block">
                        <div class="col-md-8 m-t-10 accordian_alignment">
                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="card" style="border: none;">
                                    <div class="card-header bg-white" role="tab" id="title-one" style="border: none;background: #f9f9f9;">
                                        <a class="collapsed accordion-section-title first-icon" data-toggle="collapse" data-parent="#accordion" href="#card-data-one" aria-expanded="false">
                                            
                                             <i class="fa fa-chevron-up  m-t-5"></i>
                                            
                                             How Do I open a Partners Account?
                                        </a>
                                        
                                    </div>
                                    <div id="card-data-one" class="card-collapse collapse">
                                        <div class="card-block m-t-20">
                                            <p class="text-justify">
                                                Visit <a target="_blank" href="{{$general_info->client_portal_url}}"> {{$general_info->client_portal_url}} </a>and click on open live account, once you open a live account your.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card m-t-20"  style="border: none;">
                                    <div class="card-header bg-white" role="tab" id="title-two" style="border: none;background: #f9f9f9;">
                                        <a class="collapsed accordion-section-title" data-toggle="collapse" data-parent="#accordion" href="#card-data-two" aria-expanded="false">
                                             <i class="fa fa-chevron-up m-t-5"></i>
                                            Where Do I Get My IB Link?
                                        </a>
                                    </div>
                                    <div id="card-data-two" class="card-collapse collapse">
                                        <div class="card-block m-t-20">
                                            <p class="text-justify">
                                               Once you Login into your client area you will see Your IB Referral Link
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card m-t-20" style="border: none;">
                                    <div class="card-header bg-white" role="tab" id="title-three" style="border: none;background: #f9f9f9;">
                                        <a class="collapsed accordion-section-title" data-toggle="collapse" data-parent="#accordion" href="#card-data-three" aria-expanded="false">
                                             <i class="fa fa-chevron-up m-t-5"></i>
                                            How can I view Clients Registered Under Me?
                                        </a>
                                    </div>
                                    <div id="card-data-three" class="card-collapse collapse">
                                        <div class="card-block m-t-20">
                                            <p class="text-justify">
                                                  Login into Your Partners Dashboard from You will see an Icon named accounts, this shows you the number of account registered under your IB link.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card m-t-20" style="border: none;">
                                    <div class="card-header bg-white" role="tab" id="title-four" style="border: none;background: #f9f9f9;">
                                        <a class="collapsed accordion-section-title" data-toggle="collapse" data-parent="#accordion" href="#card-data-four" aria-expanded="false">
                                             <i class="fa fa-chevron-up m-t-5"></i>
                                            How Can I View My IB Commissions?
                                        </a>
                                    </div>
                                    <div id="card-data-four" class="card-collapse collapse">
                                        <div class="card-block m-t-20">
                                            <p class="text-justify">
                                                a.  Login into your Partners Dashboard and you will see Earnings.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endsection

            @section('script')
                <script type="text/javascript">
                    $(function(){
                          $('.accordion-section-title').click(function(){
                            $(this).find('i').toggleClass('fa-chevron-up');
                            $(this).find('i').toggleClass('fa-chevron-down');
                          })
                    })
                </script>
            @endsection
