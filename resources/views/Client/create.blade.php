@extends('layouts.master')
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Add Client Info</h1>
          <p>Add Client Info</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Add Client</li>
          <li class="breadcrumb-item"><a href="{{  route('client-list') }}">Add Client List</a></li>
        </ul>
      </div>
        <div class="col-md-12">
          <div class="tile">
            <form action="{{ route('client-store') }}" method="post">
              @csrf
            <div class="row">
              <div class="col-lg-4">
                 <div class="form-group">
                    <label for="user_id">Client</label>
                   <input class="form-control" type="text" name="name" value="{{ old('name')}}" placeholder="Enter Client name">
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
                   <input class="form-control" type="text" name="gstin" value="{{ old('gstin') }}" placeholder="Enter  Gstin">
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
                    <input class="form-control" type="text" name="pan_no" value="{{ old('pan_no') }}" placeholder="Enter Pan No." autocomplete="off">
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
                    <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Enter Email " autocomplete="off">
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
                    <option value="{{ $sname->state_code }}" {{ old('state_code') == $sname->state_code ? 'selected' : '' }}>{{ $sname->state_name }}</option>
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
                    <label for="bg_type_id">City</label>
                  <select name="city_code" id="city" class="form-control">
                   <option value="{{ old('city_code') }}">choose</option>
                  </select>
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
                     <textarea class="form-control" name="correspondence_address"  rows="4" placeholder="Enter Correspondance  Address" autocomplete="off">{{ old('correspondence_address') }}</textarea>
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
                   <textarea class="form-control" name="Registered_address"  rows="4" placeholder="Enter Registere Address" autocomplete="off">{{ old('Registered_address') }}</textarea>
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
                    <input class="form-control" type="text" name="contact" value="{{ old('contact') }}" placeholder="Enter contact no. " autocomplete="off">
                     @error('correspondence_address')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="contract">Note</label>
                   <textarea class="form-control" name="note"  rows="4" placeholder="Enter description" autocomplete="off">{{ old('note') }}</textarea>
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
   
    var cityid = $("#city").val();
    //alert(cityid);
    if(cityid != ''){
       
       $.ajax({
                 type: "GET",
                 url: "{{ route('get-city-name') }}?id="+cityid,
                 success: function(res){
                 if(res){
              //console.log(res);
                        $("#city").empty();
                        //$("#city").append('<option value="0">Select City</option>');
                        $("#city").append('<option value="'+res.city_code+'">'+res.city_name+'</option>');
            

                      }
                      else{
                      $("#district").empty();
                      }
                    }
                      });

    }

 $("#state_code").on("change",function(){
           var id = $(this).val();
          $.ajax({
                 type: "GET",
                 url: "{{ route('get-city') }}?id="+id,
                 success: function(res){
                 if(res){
              //console.log(res);
                        $("#city").empty();
                        $("#city").append('<option value="0">Select City</option>');
                        $.each(res,function(index, city){
                        $("#city").append('<option value="'+city.city_code+'">'+city.city_name+'</option>');
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

