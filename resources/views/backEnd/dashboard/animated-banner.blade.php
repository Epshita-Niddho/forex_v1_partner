
@extends('backEnd.dashboard.layout')

@section('title', 'Animated Banner')
@section('content')

<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-archive"></i>
                        Animated Banner
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-light lter bg-container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" style="border: none;margin-top: 2%">
                                <div class="bg-white">
                                    <h4>Banner List</h4>
                                </div>
                                <div class="card-block m-t-35">
                                    <div>
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                
                                                <?php $i = 1; ?>
                                                @foreach($resolutions as $key => $res)
                                                <li class="nav-item">
                                                    <a href="#tab_{{$i}}" class="nav-link @if($i==1) active @endif" data-toggle="tab">{{$res->resolution}}</a>
                                                </li>
                                                <?php $i++; ?>
                                                @endforeach
                                                
                                            </ul>
                                            <div class="tab-content">
                                                <?php $i=1; ?>
                                                @foreach($resolutions as $key => $res)
                                                <div class="tab-pane gallery2-padding @if($i==1) active @endif" id="tab_{{$i}}">
                                                    <div class="row no-gutters">
                                                    <?php $j=1; ?>
                                                    @foreach($banners as $key => $banner)   
                                                    @if($res->resolution == $banner->resolution) 
                                                        <div class="col-md-12">
                                                            <div class="">
                                                                <div class="">
                                                                    
                                                            <div class="pull-left" style="position: relative;margin-bottom: 10px;">
                                                               <a href="{{$banner->name}}"><img style="margin:30px 10px 10px;" src="{{$banner->name}}" class="img-fluid gallery-style" alt="Image"></a> 
                                                                <a style="display: block;text-align: center;" href="javascript:;" class="show-code" value="{{$j}}" id="name">Show code</a>
                                                                
                                                                </div>
                                                                </div>
                                                            </div>

<div class="code_class col-md-12" id="code{{$j}}">

<xmp style="white-space: pre-wrap;word-wrap:break-word;background: #343D46;padding: 10px;color: #f9f9f9;">
<a href="{{$client_url->client_portal_url}}/register?ref_id={{$affiliate_prom_code}}">
    <img src="{{$banner->name}}" alt="Banner">
</a>
</xmp>

</div>
                                                                
                                                                


                                                            </div>
                                                        @endif
                                                        <?php $j++; ?>
                                                        @endforeach

                                                    </div>
                                                    <!-- /thumnail helper gallery -->
                                                </div>
                                                <?php $i++; ?>
                                                @endforeach
                                                

                                                <!-- /button helper gallery -->
                                                
                                                <!-- /thumnail helper gallery -->
                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- nav-tabs-custom -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- /.inner -->
</div>
</div>
</div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script>
$(document).ready(function(){
    $(".code_class").hide();
    $(".show-code").on('click',function(){
        var id = $(this).attr('value');
        $("#code"+id).slideToggle('slow');
    });

    
});
    
</script>
@endsection
