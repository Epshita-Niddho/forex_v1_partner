
@extends('backEnd.dashboard.layout')

@section('title', 'Partner Dashboard')
@section ('link')

@endsection
@section('content')

<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-home" style="margin-left: 2%"></i>
                        Dashboard
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
           
        <div class="row">
        <div class="col-xl-6 col-lg-7 col-xs-12">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="bg-primary top_cards">
                        <div class="row icon_margin_left">

                            <div class="col-lg-6 icon_padd_left">
                                <div class="float-xs-left">
                                    <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-credit-card fa-stack-1x fa-inverse text-primary sales_hover"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 icon_padd_right">
                                <div class="float-xs-left cards_content">
                                    <span class="number_val" id="sales_count">{{$referral_accounts}}</span>
                                    <!-- <i class="fa fa-long-arrow-up fa-2x">100</i> -->
                                    <br/>
                                    <span class="card_description">Referral Accounts</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="bg-success top_cards">
                        <div class="row icon_margin_left">
                            <div class="col-lg-6 icon_padd_left">
                                <div class="float-xs-left">
                                    <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-bar-chart fa-stack-1x fa-inverse text-success visit_icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 icon_padd_right">
                                <div class="float-xs-left cards_content">
                                    <span class="number_val" id="visitors_count">$ {{$net_commission}}</span>
                                    <!-- <iclass="fa fa-long-arrow-up fa-2x"></i> -->
                                    <br/>
                                    <span class="card_description">Total Earning</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="bg-success top_cards">
                        <div class="row icon_margin_left">
                            <div class="col-lg-6 icon_padd_left">
                                <div class="float-xs-left">
                                    <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-bar-chart fa-stack-1x fa-inverse text-success visit_icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 icon_padd_right">
                                <div class="float-xs-left cards_content">
                                    <span class="number_val" id="visitors_count">$ {{$ib_commission}}</span>
                                    <!-- <iclass="fa fa-long-arrow-up fa-2x"></i> -->
                                    <br/>
                                    <span class="card_description">IB Commission</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="bg-success top_cards">
                        <div class="row icon_margin_left">
                            <div class="col-lg-6 icon_padd_left">
                                <div class="float-xs-left">
                                    <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-bar-chart fa-stack-1x fa-inverse text-success visit_icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 icon_padd_right">
                                <div class="float-xs-left cards_content">
                                    <span class="number_val" id="visitors_count">$ {{$mam_commission}}</span>
                                    <!-- <iclass="fa fa-long-arrow-up fa-2x"></i> -->
                                    <br/>
                                    <span class="card_description">MAM Commission</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="bg-warning top_cards">
                        <div class="row icon_margin_left">
                            <div class="col-lg-6 icon_padd_left">
                                <div class="float-xs-left">
                                    <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-usd fa-stack-1x fa-inverse text-warning revenue_icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 icon_padd_right">
                                <div class="float-xs-left cards_content">
                                    <span class="number_val" id="revenue_count">
                                        $ {{$total_withdraw}}
                                   </span>
                                    <br/>
                                    <span class="card_description">Total Withdrawn</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="bg-mint top_cards">
                        <div class="row icon_margin_left">
                            <div class="col-lg-6 icon_padd_left">
                                <div class="float-xs-left">
                                    <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-money  fa-stack-1x fa-inverse text-mint sub" style="color: #0FB0C0"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 icon_padd_right">
                                <div class="float-xs-right cards_content">
                                    <span class="number_val" id="subscribers_count">$ {{$available_balance}}</span>
                                    <br/>
                                    <span class="card_description">Available Balance</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-5 col-xs-12 stat_align">
            <div class="card weather_section md_align_section">
                <canvas id="speedChart"></canvas>
            </div>
        </div>
    </div>
    

    <br><br>

    <div class="row">
        <div class="col-lg-12">
            <div class="bg-success p-d-15 b_r_5" style="font-size:15px">
                
                <div class="user_font"><p style="padding: 0;margin: 0;font-size: 14px;text-align: center;">Your IB link : <span><input style="width: 500px;max-width: 100%;color: #777;height: 25px;border:none;padding: 5px;border-radius: 5px" type="text" name="" id="" value="{{$client_url}}/register?ref_id={{$affiliate_prom_code}}"></span></p></div>
                
            </div>
        </div>
    </div>



    <div class="row">
     
        <!-- </div> -->
        <div class="col-lg-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="card m-t-35">
                <div class="card-header bg-white">
                    <i class="fa fa-table"></i>Transaction History ( <a style="color:#4FB7FE;text-decoration: underline;" href="/transaction-history">View All</a> )
                </div>
                <div class="card-block">
                    <div class="table-responsive m-t-35">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fa fa-clock-o"></i> Date
                                    </th>
                                    <th class="hidden-xs">
                                        <i class="fa fa-money"></i> Method
                                    </th>
                                    <th>
                                        <i class="fa fa-shopping-cart"></i> Amount
                                    </th>
                                    <th><i class="fa fa-check"></i> 
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($history as $his)
                                <tr>
                                    <td class="highlight">
                                        
                                        {{date('d-M-Y',strtotime($his->created_at))}}
                                    </td>
                                    <td class="">{{$his->payment_type}}</td>
                                    <td>{{(-1)*$his->amount}}</td>
                                    <td>
                                        @if($his->status==0)
                                            <button class="btn btn-warning">Pending</button>
                                        @elseif($his->status==1)
                                            <button class="btn btn-success">Approved</button>
                                        @else
                                            <button class="btn btn-danger">Cancelled</button>
                                       @endif
                                    </td>
                                </tr>
                               
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
            
        </div>
        <div class="col-lg-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="card m-t-35">
                <div class="card-header bg-white">
                    <i class="fa fa-play"></i>Starting Tips
                </div>
                <div class="card-block">
                    <div class="table-responsive m-t-35">
                        
                        <ol>
                            
                            <li>Grab your marketing tools. Grab all the marketing tools you need to make your promotions as effective as possible. </li>
                            <li>Check your reports. Monitor your performance by checking your reports in full detail.  </li>
                            <li>See your commissions. Keep track of your commissions just by logging in to your Introducer's Dashboard.  </li>
                            <li>Optimize your campaigns. See how you can improve your performance by following our tips and tricks. .  </li>
                            <li>Share your experience. Send us your feedback or share your {{config('app.name')}} Partner experience.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
<!-- /.inner -->
</div>
</div>
</div>
</div>
{{csrf_field()}}

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


<script>
// alert(label_x[3]);
    // console.log(level1);
    var speedCanvas = document.getElementById("speedChart");

    var dataFirst = {
        label: "Level 1",
        data: [2,3,4,5,6,7,1],
        lineTension: 0.3,
        fill: false,
        borderColor: '#4FB7FE',
        backgroundColor: 'transparent',
        pointBorderColor: '#4FB7FE',
        pointBackgroundColor: 'lightgreen',
        pointRadius: 3,
        pointHoverRadius: 5,
        pointHitRadius: 30,
        pointBorderWidth: 2,
        pointStyle: 'circle'
    };

    var dataSecond = {
        label: "Level 2",
        data: [2,3,4,5,6,7,1],
        lineTension: 0.3,
        fill: false,
        borderColor: '#00CC99',
        backgroundColor: 'transparent',
        pointBorderColor: '#00CC99',
        pointBackgroundColor: 'lightgreen',
        pointRadius: 3,
        pointHoverRadius: 5,
        pointHitRadius: 30,
        pointBorderWidth: 2
    };
    var dataThird = {
        label: "Level 3",
        data: [2,3,4,5,6,7,1],
        lineTension: 0.3,
        fill: false,
        borderColor: '#FF9933',
        backgroundColor: 'transparent',
        pointBorderColor: '#FF9933',
        pointBackgroundColor: 'lightgreen',
        pointRadius: 3,
        pointHoverRadius: 5,
        pointHitRadius: 30,
        pointBorderWidth: 2
    };
    var dataFourth = {
        label: "Level 4",
        data: [2,3,4,5,6,7,1],
        lineTension: 0.3,
        fill: false,
        borderColor: '#555',
        backgroundColor: 'transparent',
        pointBorderColor: '#555',
        pointBackgroundColor: 'lightgreen',
        pointRadius: 3,
        pointHoverRadius: 5,
        pointHitRadius: 30,
        pointBorderWidth: 2
    };
    var dataFifth = {
        label: "Level 5",
        data: [2,3,4,5,6,7,1],
        lineTension: 0.3,
        fill: false,
        borderColor: '#F47',
        backgroundColor: 'transparent',
        pointBorderColor: '#F47',
        pointBackgroundColor: 'lightgreen',
        pointRadius: 3,
        pointHoverRadius: 5,
        pointHitRadius: 30,
        pointBorderWidth: 2
    };
    // var dataSixth = {
    //     label: "Level 6",
    //     data: [2,3,4,5,6,7,1],
    //     lineTension: 0.3,
    //     fill: false,
    //     borderColor: '#800080',
    //     backgroundColor: 'transparent',
    //     pointBorderColor: '#800080',
    //     pointBackgroundColor: 'lightgreen',
    //     pointRadius: 3,
    //     pointHoverRadius: 5,
    //     pointHitRadius: 30,
    //     pointBorderWidth: 2
    // };
    // var dataSeventh = {
    //     label: "Level 7",
    //     data: [2,3,4,5,6,7,1],
    //     lineTension: 0.3,
    //     fill: false,
    //     borderColor: '#C54B8C',
    //     backgroundColor: 'transparent',
    //     pointBorderColor: '#C54B8C',
    //     pointBackgroundColor: 'lightgreen',
    //     pointRadius: 3,
    //     pointHoverRadius: 5,
    //     pointHitRadius: 30,
    //     pointBorderWidth: 2
    // };
    // var dataEighth = {
    //     label: "Level 8",
    //     data: [2,3,4,5,6,7,1],
    //     lineTension: 0.3,
    //     fill: false,
    //     borderColor: '#7F00FF',
    //     backgroundColor: 'transparent',
    //     pointBorderColor: '#7F00FF',
    //     pointBackgroundColor: 'lightgreen',
    //     pointRadius: 3,
    //     pointHoverRadius: 5,
    //     pointHitRadius: 30,
    //     pointBorderWidth: 2
    // };
    // var dataNinth = {
    //     label: "Level 9",
    //     data: [2,3,4,5,6,7,1],
    //     lineTension: 0.3,
    //     fill: false,
    //     borderColor: '#006266',
    //     backgroundColor: 'transparent',
    //     pointBorderColor: '#006266',
    //     pointBackgroundColor: 'lightgreen',
    //     pointRadius: 3,
    //     pointHoverRadius: 5,
    //     pointHitRadius: 30,
    //     pointBorderWidth: 2
    // };
    // var dataTenth = {
    //     label: "Level 10",
    //     data: [2,3,4,5,6,7,1],
    //     lineTension: 0.3,
    //     fill: false,
    //     borderColor: '#009432',
    //     backgroundColor: 'transparent',
    //     pointBorderColor: '#009432',
    //     pointBackgroundColor: 'lightgreen',
    //     pointRadius: 3,
    //     pointHoverRadius: 5,
    //     pointHitRadius: 30,
    //     pointBorderWidth: 2
    // };

    var speedData = {
      labels: [2,3,4,5,6,7,1],
      datasets: [dataFirst, dataSecond,dataThird,dataFourth,dataFifth]
      //datasets: [dataFirst, dataSecond,dataThird,dataFourth,dataFifth,dataSixth,dataSeventh,dataEighth,dataNinth,dataTenth]
  };

  var chartOptions = {
      legend: {
        display: true,
        position: 'top',
        labels: {
          boxWidth: 28,
          fontColor: '#999'
      },
  }
};

// var lineChart = new Chart(speedCanvas, {
//   type: 'line',
//   data: speedData,
//   options: chartOptions
// });

$(document).ready(function(){

    $.ajax({
        url: "/get-ib-level-values",
        type: "POST",
        data:{
            _token:$('input[name=_token]').val()
        },
        success: function(data){
         speedData.labels = data.label_x;
         dataFirst.data = data.level1;
         dataSecond.data = data.level2;
         dataThird.data = data.level3;
         dataFourth.data = data.level4;
         dataFifth.data = data.level5;
         new Chart(speedCanvas, {
          type: 'line',
          data: speedData,
          options: chartOptions
      });
     }        
 });

});
</script>
@endsection
