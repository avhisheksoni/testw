@extends('layouts.master')
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Edit Client Info</h1>
          <p>Edit Client Info</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Edit Client</li>
          <li class="breadcrumb-item"><a href="{{  route('client-list') }}">Client List</a></li>
        </ul>
      </div>
        <div class="col-md-12">
          <div class="tile">
            <form action="{{  route('client-update',[$details->id]) }}" method="post">
              @csrf
            <div class="row">
              <div class="col-lg-4">
                 <div class="form-group">
                    <label for="user_id">Client</label>
                   <input class="form-control" type="text" name="name" value="{{ $details->name }}" placeholder="Enter Client name">
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
                   <input class="form-control" type="text" name="gstin" value="{{ $details->gstin }}" placeholder="Enter  Gstin">
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
                    <input class="form-control" type="text" name="pan_no" value="{{ $details->pan_no }}" placeholder="Enter Pan No." autocomplete="off">
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
                    <input class="form-control" type="text" name="email" value="{{ $details->email }}" placeholder="Enter Email " autocomplete="off">
                     @error('on_behalf_of')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  @php 
                  $state = App\state::all();
                  @endphp
                  <div class="form-group">
                    <label for="request_type_id">State</label>
                   <select name="state_code" id="state_code" class="form-control">
                    <option value="">Choose</option>
                    @foreach($state as $sname)
                    <option value="{{ $sname->state_code }}" {{ $details->state_code == $sname->state_code ? 'selected' : '' }}>{{ $sname->state_name }}</option>
                    @endforeach

                   </select>
                     @error('on_behalf_of')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                <div class="form-group">
                    <label for="city">City</label>
                  <select name="city_code" id="city_new" class="form-control" style="display: none">
                   <option value="">--select--</option>
                  </select>
                  <input type="text" name="city_name" value="{{ $details->citycode->city_name }}" class="form-control" id="city_old">
                  <input type="hidden" name="city_code" value="{{ $details->city_code }}" class="form-control" id="city_now">
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
                     <textarea class="form-control" name="correspondence_address"  rows="4" placeholder="Enter Correspondance  Address" autocomplete="off">{{ $details->correspondence_address }}</textarea>
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
                   <textarea class="form-control" name="Registered_address"  rows="4" placeholder="Enter Registere Address" autocomplete="off">{{ $details->Registered_address }}</textarea>
                     @error('Registered_address')
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
                    <label for="invoive_number">Contact</label>
                    <input class="form-control" type="text" name="contact" value="{{ $details->contact }}" placeholder="Enter contact no. " autocomplete="off">
                     @error('contact')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="contract">Note</label>
                   <textarea class="form-control" name="note"  rows="4" placeholder="Enter description" autocomplete="off">{{ $details->note }}</textarea>
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
              <button class="btn btn-primary" type="submit">Submit</button>
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

