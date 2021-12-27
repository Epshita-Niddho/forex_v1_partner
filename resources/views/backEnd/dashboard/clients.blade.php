@extends('backEnd.dashboard.layout')
@section('title', 'My Clients')
@section('link')
<!--plugin styles-->
<link type="text/css" rel="stylesheet" href="vendors/select2/css/select2.min.css" />
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/scroller.bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/colReorder.bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/dataTables.bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="css/pages/dataTables.bootstrap.css" />

<link type="text/css" rel="stylesheet" href="css/pages/tables.css" />
<!-- <link type="text/css" rel="stylesheet" href="#" id="skin_change" /> -->
<link rel="stylesheet" href="/assets/backEnd/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/assets/backEnd/css/custom-datatable.css">
<!--End of page level styles-->
<style type="text/css">
.dataTables_wrapper {
    overflow: hidden;
}

.table{
    overflow: hidden;
}


@media (max-width: 768px){
    .dataTables_wrapper {
        overflow: hidden
    }

    .table{
        overflow: auto
    }
}
</style>
@endsection
@section('content')
<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar row">
            <div class="col-lg-6">
                <h4 class="nav_top_align skin_txt">
                    <i class="fa fa-pie-chart"></i>
                    Clients
                </h4>
            </div>
            
        </div>
    </header>
    {{csrf_field()}}
    <div class="outer">
        <div class="inner bg-container">
          
          
            <div class="">

                <div class="card-block">
                  <!-- <div class="row-fluid">
                    <div class="col-lg-12">
                      <div class="row">
                          
                        <div class="col-md-3" style="padding: 0">
                            <label for="date_range" class="control-label" style="font-weight: bold">Filter:</label>
                            <select id="date_range" class="form-control effect_in_margin_top">
                                <option value="1">24 Hours</option>
                                <option value="3">3 Days</option>
                                <option value="7">1 Week</option>
                                <option value="30">1 Month</option>
                                <option value="all" selected>All</option>
                                <option value="custom">Custom</option>
                                
                            </select>
                        </div>
                        <div class="col-md-3 custom-date">
                            <div>
                                <label for="datepicker" class="control-label" style="font-weight: bold">From:</label>
                                <input type="text" id="from" class="form-control effect_in_margin_top" readonly="readonly" style="background: white;">
                            </div>
                        </div>
                        <div class="col-md-3 custom-date">
                            <div>
                                <label for="datepicker" class="control-label" style="font-weight: bold">To:</label>
                                <input type="text" id="to" class="form-control effect_in_margin_top" readonly="readonly" style="background: white;">
                            </div>
                        </div>
                        <div class="col-md-2 filter_date">
                            <div>
                                
                                <button type="button" class="btn btn-success m-t-33 refresh-button">Refresh</button>
                            </div>
                        </div>
                        
                    </div>
                    
                    
              
          </div>     
      </div> -->

      <div class="row-fluid">
        <div class="span12">
            <div class="col-lg-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class=" " style="margin-top: 1%">
                    <div class="bg-white"  >
                     <div class="tabletop-row">

                     </div>
                 </div>
                 <div class="card-block">
                    <div class="">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#tab_1" id="tabb1" class="nav-link active" data-toggle="tab">Level 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab_2" id="tabb2" class="nav-link" data-toggle="tab">Level 2</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab_3" id="tabb3" class="nav-link" data-toggle="tab">Level 3</a>
                                </li>
                               <li class="nav-item">
                                    <a href="#tab_4" id="tabb4" class="nav-link" data-toggle="tab">Level 4</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab_5" id="tabb5" class="nav-link" data-toggle="tab">Level 5</a>
                                </li> 
                               <li class="nav-item">
                                    <a href="#tab_6" id="tabb6" class="nav-link" data-toggle="tab">Level 6</a>
                                </li>
                                <!--<li class="nav-item">
                                    <a href="#tab_7" id="tabb7" class="nav-link" data-toggle="tab">Level 7</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab_8" id="tabb8" class="nav-link" data-toggle="tab">Level 8</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab_9" id="tabb9" class="nav-link" data-toggle="tab">Level 9</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab_10" id="tabb10" class="nav-link" data-toggle="tab">Level 10</a>
                                </li> -->
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active gallery-padding" id="tab_1" style="position: relative;min-height: 320px;">
                                  
                                </div>
                                <div class="tab-pane gallery-padding" id="tab_2" style="position: relative;min-height: 320px;">
                                  
                                </div>
                                <div class="tab-pane gallery-padding" id="tab_3" style="position: relative;min-height: 320px;">
                                  
                                </div>
                                <div class="tab-pane gallery-padding" id="tab_4" style="position: relative;min-height: 320px;">
                                  
                                </div>
                                <div class="tab-pane gallery-padding" id="tab_5" style="position: relative;min-height: 320px;">
                                  
                                </div>
                                <div class="tab-pane gallery-padding" id="tab_6" style="position: relative;min-height: 320px;">

                                </div>
                                <div class="tab-pane gallery-padding" id="tab_7" style="position: relative;min-height: 320px;">

                                </div>
                                <div class="tab-pane gallery-padding" id="tab_8" style="position: relative;min-height: 320px;">

                                </div>
                                <div class="tab-pane gallery-padding" id="tab_9" style="position: relative;min-height: 320px;">

                                </div>
                                <div class="tab-pane gallery-padding" id="tab_10" style="position: relative;min-height: 320px;">

                                </div>
                            </div>
    <!-- /.tab-content -->
                        </div>

</div>
</div>
</div>
</div>
</div>

@endsection
@section('script') 
<!--plugin scripts-->

<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.min.js"></script>


<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/pages/moment.js"></script>
<!-- end of plugin scripts -->
<!--Page level scripts-->


<script type="text/javascript">

 $(document).ready(function(){
  var preload2 = "<div class='preload2' style='position: absolute;display: block;width: 100%;height: 100%;top: 0;left: 0;z-index: 100000;backface-visibility: hidden;background: #ffffff;'><div class='preloader_img' style='width: 200px;height: 200px;position: absolute;left: 42%;top: 35%;background-position: center;z-index: 999999'><img src='/img/loader3.gif' style=' width: 40px;' alt='loading...'></div></div>";

  $( "#from" ).datepicker({
    maxDate: "+0d",
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
  });
  $( "#to" ).datepicker({
    maxDate: "+0d",
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
  });




    // code for showing date range

    dateRanger(7);

    

        // end showing filter date
        $('#from,#to').on('focus',function(){
          $('#date_range').val('custom');
        });



        $(document).on('change','#date_range',function(){
          var days = $('#date_range').val();
          dateRanger(days);

      });


        showData(1);


         $(document).on('click','#tabb1',function(){
            showData(1);
         });
         $(document).on('click','#tabb2',function(){
            showData(2);
         });
         $(document).on('click','#tabb3',function(){
            showData(3);
         });
         $(document).on('click','#tabb4',function(){
            showData(4);
         });
         $(document).on('click','#tabb5',function(){
             showData(5);
         });
         $(document).on('click','#tabb6',function(){
             showData(6);
         });
         $(document).on('click','#tabb7',function(){
             showData(7);
         });
         $(document).on('click','#tabb8',function(){
             showData(8);
         });
         $(document).on('click','#tabb9',function(){
             showData(9);
         });
         $(document).on('click','#tabb10',function(){
             showData(10);
         });



        $(document).on('click','.refresh-button',function(){

          var level = $('.nav-link.active').attr('id');
          var level = level.replace("tabb", "");
          showData(level);
          
        });


        function showData(level){

           
          $('#tab_'+level).html( preload2 );
          var start = $('#from').val();
          var end = $('#to').val();
          $.ajax({
            url: '/partner-clients-level',
            type:'post',
            data:{
              _token:$('input[name=_token]').val(),
              level:level,
              start:start,
              end:end,
              id:<?php echo json_encode($affiliate_prom_code, JSON_HEX_TAG); ?>
            },
            success: function(data){ 

              $('#tab_'+level).html( data );

              $('#comm_stat_level_'+level).DataTable({
                "dom": "<'row'<'col-md-5 col-12'l><'col-md-7 col-12'f>r><'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>"
              });
              $(".dataTables_wrapper").removeClass("form-inline");
              $(".dataTables_paginate .pagination").addClass("float-right"); 

            }
          });
        }


        function dateRanger(days){
          var date = new Date();
          var dd = date.getDate();
          var mm = date.getMonth();
          var yy = date.getFullYear();
          mm += 1;
          if (dd<10) {dd = '0'+dd;}
          if (mm<10) {mm = '0'+mm;}

          var from_date = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));

          var from_dd = from_date.getDate();
          var from_mm = from_date.getMonth();
          var from_yy = from_date.getFullYear();
          from_mm += 1;
          if (from_dd<10) {from_dd = '0'+from_dd;}
          if (from_mm<10) {from_mm = '0'+from_mm;}
          var dateRange = $('#date_range').val();

          if(dateRange == 'custom'){

          }
          else if(dateRange == 'all'){
           $('#from').val('');

           $('#to').val(yy+'-'+mm+'-'+dd);
         }

         else{

          $('#from').val(from_yy+'-'+from_mm+'-'+from_dd);

          $('#to').val(yy+'-'+mm+'-'+dd);
        }
        }

// showSomething(7);

// function showSomething(a){
//   alert(a);
// }

});
    
</script>
@endsection
