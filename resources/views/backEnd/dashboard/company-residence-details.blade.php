
@extends('backEnd.dashboard.layout')

@section('title', 'Company Address Verification')
@section ('link')
<link type="text/css" rel="stylesheet" href="css/components2.css" />
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
@endsection
@section('content')

<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-user"></i>
                        Verify Profile
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
 

            <!--top section widgets-->
            <div class="card">
                         
                                <div class="row">
 
                                    <div class="col-md-12">
                                        <div class="varification">
                                            <h4>Company Address Verification</h4>
                                        </div>
                                        <div class="dropFile-notice-head">
                                            
                                        <div class="dropFile-notice">
                                            <button type="button" class="close"><i class="fa fa-close"></i></button>
                                            <p>Since {{$general_info->company_name}} adheres to AML policy, each client has to pass verification procedure. Verified clients withdraw funds freely and deposit trading accounts via all available methods.
                                            <br>
                                            To verify your personality, please, upload photos or scan copies of one of the following documents:
                                            <br>
                                            <ul style="list-style: inside;padding: 0">
                                                    <li>receipt of utility services payment;</li>
                                                    <li>bank statement;</li>
                                                    <li>page of the local passport with residential address (if address stated there matches with the current address and you have uploaded the first page of the local passport as a proof of your identity).</li>
                                            </ul>
                                            
                                            We accept only color high-resolution photos or scan copies of documents which should surely contain full name, photo, signature, date of birth, expiration date and be valid for at least 6 months from the moment of applying. The 4 edges of the document should be visible on the photo.
                                            <br>
                                            We will check uploaded documents within 24 hours (except from weekends). 
                                            </p>

                                        </div>
                                        </div>
                                        <div class="dropFile">

                                        <form action="" class="dropzone" id="DropZoneFiddle">
                                                {{csrf_field()}}
                                          <span class="fa fa-download" style="font-size: 50px"></span>
                                          <br>
                                          <span style="font-size: 25px">Drop your scan copy here or click to upload</span>
                                          <br>
                                          <small>You can upload pictures in jpg, jpeg, png, gif, tif, tiff formats and which is not larger than 1МB</small>
                                          <br>
                                        </form>

                                        <div class="upload_button">
                                            <a href="" style="padding: 12px;background: #26C281;color: #fff;border-radius: 5px;font-size: 16px">Upload</a>
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
                                                            <td>
                                                                {{ Carbon\Carbon::parse($documents->date_time)->format('d-m-Y') }}</td>
                                                            <td>{{$documents->document_type}}</td>
                                                            <td>@if($documents->status == 0)Pending @elseif($documents->status == 1) Approved @else Cancelled @endif</td>
                                                            <td>{{$documents->comment}}</td>
                                                            <td>
                                                                <a href="{{$documents->document}}"><img src="{{$documents->document}}" alt="" width="30px"></a></td>
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
    <!-- /.inner -->
</div>
</div>
</div>
</div>


@endsection

@section('script')
<script src="js/dropzone.js"></script>
<script type="text/javascript">
    $(function(){
        $('.image-show').hide();
        $('.image-icon').click(function(){
        $('.image-show').show();
        $('.image-show').hide();
    })
})
</script>
<script>
    $(function(){
        Dropzone.options.DropZoneFiddle = {
  url: this.location,
  paramName: "file", //the parameter name containing the uploaded file
  clickable: true,
  maxFilesize: 1, //in mb
  uploadMultiple: false, 
  maxFiles: 1, // allowing any more than this will stress a basic php/mysql stack
  addRemoveLinks: true,
  acceptedFiles: '.png,.jpg,.jpeg,.gif,.tif,.tiff', //allowed filetypes
  dictDefaultMessage: "Upload your file here", //override the default text
  init: function() {
    this.on("sending", function(file, xhr, formData) {
      //formData.append("step", "upload"); // Append all the additional input data of your form here!
      //formData.append("id", "1"); // Append all the additional input data of your form here!
      //alert('hd');
    });
    this.on("success", function(file, responseText) {
      //auto remove buttons after upload
      
      //$("#div-files").html(responseText);
      //var _this = this;
      //_this.removeFile(file);
      alert('done');
    });
    // this.on("addedfile", function(file){
    //     alert('Upload File?');
    // });
  }
};

$('.close').click(function(event) {
    $('.dropFile-notice-head').hide('slow');
});
    });
</script>
@endsection