@extends('layouts.master')
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Client Info Details</h1>
          <p>Client Details</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"> Client Details</li>
          <li class="breadcrumb-item"><a href="{{  route('client-list') }}">Client List</a></li>
        </ul>
      </div>
        <div class="col-md-12">
          <div class="tile">
            <form action="" method="post">
              @csrf
            <div class="row">
              <div class="col-lg-4">
                 <div class="form-group">
                    <label for="user_id">Client</label>
                   <input class="form-control" type="text" name="name" value="{{ $details->name }}" placeholder="Enter Client name" readonly="">
                     @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group">
                    <label for="beneficiary_id">GSTIN/UIN of Recipient</label>
                   <input class="form-control" type="text" name="gstin" value="{{ $details->gstin }}" placeholder="Enter  Gstin" readonly="">
                     @error('gstin')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                 <div class="form-group">
                    <label for="on_behalf_of">Pan No.</label>
                    <input class="form-control" type="text" name="pan_no" value="{{ $details->pan_no }}" placeholder="Enter Pan No." autocomplete="off" readonly=""> 
                     @error('pan_no')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-lg-4">
                   <div class="form-group">
                    <label for="job_id">Email</label>
                    <input class="form-control" type="text" name="email" value="{{ $details->email }}" placeholder="Enter Email " autocomplete="off" readonly="">
                     @error('on_behalf_of')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="request_type_id">State</label>
                  <input type="text" class="form-control" name="state_code" value="{{ $details->statecode->state_name }}" readonly="">
                     @error('state_code')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                <div class="form-group">
                    <label for="city">City</label>
                   <input type="text" class="form-control" name="state_code" value="{{ $details->citycode->city_name }}" readonly="">
                     @error('city_code')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
              </div> 
              <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="invoive_number">Correspondance  Address</label>
                     <textarea class="form-control" name="correspondence_address"  rows="4" placeholder="Enter Correspondance  Address" autocomplete="off" readonly="">{{ $details->correspondence_address }}</textarea>
                     @error('correspondence_address')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="contract">Registere Address</label>
                   <textarea class="form-control" name="Registered_address"  rows="4" placeholder="Enter Registere Address" autocomplete="off" readonly="">{{ $details->Registered_address }}</textarea>
                     @error('Registered_address')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
              </div>
              </div>  
                <div class="tile-footer">
            </div>
              </div>
            </form>
        </div>
      </div>
    </main>

    <script>
$(document).ready(function(){

 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
   
    // var cityid = $("#city").val();
    // //alert(cityid);
    // if(cityid != ''){
       
    //    $.ajax({
    //              type: "GET",
    //              url: "{{ route('get-city-name') }}?id="+cityid,
    //              success: function(res){
    //              if(res){
    //           //console.log(res);
    //                     $("#city").empty();
    //                     //$("#city").append('<option value="0">Select City</option>');
    //                     $("#city").append('<option value="'+res.city_code+'">'+res.city_name+'</option>');
            

    //                   }
    //                   else{
    //                   $("#district").empty();
    //                   }
    //                 }
    //                   });

    // }

 $("#state_code").on("change",function(){
           var id = $(this).val();
                        $("#city_old").hide();
                        $("#city_now").attr("disabled","disabled");
                        $("#city_new").show();
          $.ajax({
                 type: "GET",
                 url: "{{ route('get-city') }}?id="+id,
                 success: function(res){
                 if(res){
              //console.log(res);
                        $("#city_new").append('<option value="0">Select City</option>');
                        $.each(res,function(index, city){
                        $("#city_new").append('<option value="'+city.city_code+'">'+city.city_name+'</option>');
              });

                      }
                      else{
                      $("#district").empty();
                      }
                    }
                      });

            
      });


});
</script>

@endsection

