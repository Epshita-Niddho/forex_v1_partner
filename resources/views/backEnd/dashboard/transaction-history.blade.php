@extends('backEnd.dashboard.layout')
@section('title', ' Transaction History')
@section('link')
<!--plugin styles-->
    <link type="text/css" rel="stylesheet" href="vendors/select2/css/select2.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/datatables/css/scroller.bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/datatables/css/colReorder.bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/datatables/css/dataTables.bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/pages/dataTables.bootstrap.css" />
    
    <link type="text/css" rel="stylesheet" href="css/pages/tables.css" />
    <link type="text/css" rel="stylesheet" href="#" id="skin_change" />
    <link rel="stylesheet" href="/assets/backEnd/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/assets/backEnd/css/custom-datatable.css">
    <!--End of page level styles-->
    <style type="text/css">
        #sample_1_length{
            margin-top: 0px !important;
        }
    </style>
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
                            <i class="fa fa-bar-chart"></i>
                            Transaction History
                        </h4>
                    </div>
                    
                </div>
            </header>
            <div class="outer">
                <div class="inner bg-container">
                    <div class="col-lg-12 card" style="border: none">
                        <div class="row">
                        <div class="col-md-3" style="padding: 0">
                            <label for="animate_in" class="control-label" style="font-weight: bold">Filter:</label>
                            <select id="animate_in" class="form-control effect_in_margin_top">
                                <option value="1">Today</option>
                                <option value="3">3 Day</option>
                                <option value="7" selected>Week</option>
                                <option value="30">Month</option>
                                <option value="all">All</option>
                                <option value="custom">Custom</option>
                                
                            </select>
                        </div>
                        <div class="col-md-3 custom-date" style="display: none;">
                            <div>
                            <label for="datepicker" class="control-label" style="font-weight: bold">From:</label>
                            <input type="text" id="from" class="form-control effect_in_margin_top" readonly="readonly" style="background: white;">
                            </div>
                        </div>
                        <div class="col-md-3 custom-date" style="display: none;">
                            <div>
                            <label for="datepicker" class="control-label" style="font-weight: bold">To:</label>
                            <input type="text" id="to" class="form-control effect_in_margin_top" readonly="readonly" style="background: white;">
                            </div>
                        </div>
                        <div class="col-md-2 custom-date" style="display: none;">
                             <div>
                            <label for="datepicker" class="control-label" style="font-weight: bold"></label>
                            <button type="button" class="btn btn-success m-t-33 check-button">Check</button>
                            </div>
                        </div>

                        <div class="col-md-3 filter_date">
                            <div>
                            <label for="datepicker" class="control-label" style="font-weight: bold">From:</label>
                            <input type="text" id="from_filter_date" class="form-control effect_in_margin_top" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 filter_date">
                            <div>
                            <label for="datepicker" class="control-label" style="font-weight: bold">To:</label>
                            <input type="text" id="to_filter_date" class="form-control effect_in_margin_top" readonly>
                            </div>
                        </div>
                        <div class="col-md-2 filter_date">
                            <div>
                            <label for="datepicker" class="control-label" style="font-weight: bold"></label>
                            <button type="button" class="btn btn-success m-t-33 refresh-button">Refresh</button>
                            </div>
                        </div>
                    </div>
                        
                    </div>

                </div>

            </div>


            <div class="outer">
                    <div class="inner bg-container">
                        <div class="row-fluid">
                            <div class="col-xs-12 data_tables">
                               
                                <div class="card">
                                   
                                    <div class="card-block p-t-25">
                                        <div class="">
                                            <div class="pull-sm-right">
                                                <div class="tools pull-sm-right"></div>
                                            </div>
                                        </div>
                                        <table class="display table table-bordered nowrap " width="100%" id="sample_1">
                                            <thead>
                                    <tr>
                                        
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Transaction Method</th>
                                        <th>Reference No.</th>
                                        <th>Status</th>
                                        
                                        
                                    </tr>
                               </thead>
                               
                                </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.inner -->
                </div>




                   
                    
                    

                    @endsection

@section('script') 
 <!--plugin scripts-->
 <script src="js/jquery-ui.js"></script>
    <!-- <script type="text/javascript" src="vendors/select2/js/select2.js"></script> -->
    <script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.min.js"></script>
    <!-- <script type="text/javascript" src="js/pluginjs/dataTables.tableTools.js"></script>
    <script type="text/javascript" src="vendors/datatables/js/dataTables.colReorder.min.js"></script> -->
    <script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="vendors/datatables/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="vendors/datatables/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="vendors/datatables/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" src="vendors/datatables/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="vendors/datatables/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="vendors/datatables/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="vendors/datatables/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="vendors/datatables/js/dataTables.scroller.min.js"></script> -->


    
    <script type="text/javascript" src="js/pages/moment.js"></script>
    <!-- end of plugin scripts -->
    <!--Page level scripts-->
    <!-- <script type="text/javascript" src="js/pages/datatable.js"></script> -->
    <!-- end of global scripts-->


    <script type="text/javascript">
    $('#sample_1').DataTable({

        processing: true,
        serverSide: true,
        ajax: '/transaction-history-datatable/'+7,
        columns: [
            
            {
                data: 'created_at',
                name: 'created_at'
            },

            { data: 'amount', name: 'amount'},
            { data: 'payment_type', name: 'payment_type' },
            
            { data: 'reference_no', name: 'reference_no' },
            { data: 'status', name: 'status' },

        ],

        // order: [
        //     [0, 'desc']
        // ]
    });
    $('#sample_1_wrapper').removeClass('form-inline');

    // code for showing date range
$(function(){
        var date = new Date();
        var dd = date.getDate();
        var mm = date.getMonth()+1;
        var yy = date.getFullYear();
        if (dd<10) {dd = '0'+dd;}
        if (mm<10) {mm = '0'+mm;}
        
        var from_date = new Date(date.getTime() - (7 * 24 * 60 * 60 * 1000));

        var from_dd = from_date.getDate();
        var from_mm = from_date.getMonth();
        var from_yy = from_date.getFullYear();
        from_mm += 1;
        if (from_dd<10) {from_dd = '0'+from_dd;}
        if (from_mm<10) {from_mm = '0'+from_mm;}

        $('#from_filter_date').val(from_dd+'-'+from_mm+'-'+from_yy);

        $('#to_filter_date').val(dd+'-'+mm+'-'+yy);

        // end showing filter date
    });
</script>
<script>
    $(function(){
        $('#animate_in').on('change',function(){
            var limit = $(this).val();

            // custom date
        if (limit == 'custom') {
            $('.filter_date').hide();
            $('.custom-date').show();
            var date = new Date();
            var dd = date.getDate();
            var mm = date.getMonth()+1;
            var yy = date.getFullYear();
            
            if (dd<10) {dd = '0'+dd;}
            if (mm<10) {mm = '0'+mm;}

        var y_date = new Date(date.getTime() - (24 * 60 * 60 * 1000));

        var y_dd = y_date.getDate();
        var y_mm = y_date.getMonth()+1;
        var y_yy = y_date.getFullYear();
        if (y_dd<10) {y_dd = '0'+y_dd;}
        if (y_mm<10) {y_mm = '0'+y_mm;}
            
            $('#from').val(y_dd+'-'+y_mm+'-'+y_yy);
            $('#to').val(dd+'-'+mm+'-'+yy);

        }
        else{
        $('.filter_date').show();
        $('.custom-date').hide();
        
        

        var f_limit = limit;

        if (limit == 'all') {limit = 18250; f_limit = "all";}

        // code for showing date range

        var date = new Date();
        var dd = date.getDate();
        var mm = date.getMonth();
        var yy = date.getFullYear();
        mm += 1;
        if (dd<10) {dd = '0'+dd;}
        if (mm<10) {mm = '0'+mm;}
       
        if (f_limit != "all") {
        
        var from_date = new Date(date.getTime() - (f_limit * 24 * 60 * 60 * 1000));

        var from_dd = from_date.getDate();
        var from_mm = from_date.getMonth();
        var from_yy = from_date.getFullYear();
        from_mm += 1;
        if (from_dd<10) {from_dd = '0'+from_dd;}
        if (from_mm<10) {from_mm = '0'+from_mm;}

        $('#from_filter_date').val(from_dd+'-'+from_mm+'-'+from_yy);}
        else{ $('#from_filter_date').val(' '); }

        $('#to_filter_date').val(dd+'-'+mm+'-'+yy);

        // end showing filter date
        $("#sample_1").dataTable().fnDestroy();

        $('#sample_1').DataTable({

        processing: true,
        serverSide: true,
        ajax: '/transaction-history-datatable/'+limit,
        columns: [
            
            {
                data: 'created_at',
                name: 'created_at'
            },

            { data: 'amount', name: 'amount'},
            { data: 'payment_type', name: 'payment_type' },
            
            { data: 'reference_no', name: 'reference_no' },
            { data: 'status', name: 'status' },

        ],
    });
    $('#sample_1_wrapper').removeClass('form-inline');
}
            
    });

        $('.check-button').on('click',function(){
            var from = $('#from').val();
            var to = $('#to').val();
            // alert(from);alert(to);
        var m_from =  moment(from, "DD-MM-YYYY").format(); 
        var m_to =  moment(to, "DD-MM-YYYY").format();
        if(Date.parse(m_from)>=Date.parse(m_to)){
            alert("From date must be a previous date");
        }
        else{

        $("#sample_1").dataTable().fnDestroy();
        $('#sample_1').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/transaction-history-datatable-custom/'+from+'/'+to,
        columns: [
            
            {
                data: 'created_at',
                name: 'created_at'
            },

            { data: 'amount', name: 'amount'},
            { data: 'payment_type', name: 'payment_type' },
            
            { data: 'reference_no', name: 'reference_no' },
            { data: 'status', name: 'status' },

        ],
    });
        $('#sample_1_wrapper').removeClass('form-inline');
}
        });

        $('.refresh-button').on('click',function(){
            var limit = $('#animate_in').val();

            if (limit == 'all') {limit = 18250;}
         $("#sample_1").dataTable().fnDestroy();
        $('#sample_1').DataTable({

        processing: true,
        serverSide: true,
        ajax: '/transaction-history-datatable/'+limit,
        columns: [
            
            {
                data: 'created_at',
                name: 'created_at'
            },

            { data: 'amount', name: 'amount'},
            { data: 'payment_type', name: 'payment_type' },
            
            { data: 'reference_no', name: 'reference_no' },
            { data: 'status', name: 'status' },

        ],
    });
        $('#sample_1_wrapper').removeClass('form-inline');
        });
});
</script>
<script>
  $( function() {
    $( "#from" ).datepicker({
        maxDate: "+0d",
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
    });
    $( "#to" ).datepicker({
        maxDate: "+0d",
       dateFormat: "dd-mm-yy",
       changeMonth: true,
        changeYear: true,
    });
  } );
  </script>
    @endsection
                