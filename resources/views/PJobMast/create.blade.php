@extends('layouts.master')
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>P-Job/Work Name</h1>
          <p>P-Job/Work Form</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">P-Job/Work Form</li>
          <li class="breadcrumb-item"><a href="{{-- {{route('salelist')}} --}}">P-Job/Work List</a></li>
        </ul>
      </div>
      
        <div class="col-md-12">
          <div class="tile">
            <form action="{{ route('PJobMast.store')}}" method="post">
              @csrf
            <div class="row">
              <div class="col-lg-4">
                 <div class="form-group">
                    <label for="job_describe">Job/Work Name</label>
                    <input class="form-control" id="job_describe" name="name" type="text" value="{{ old('name') }}" placeholder="Enter Job/Work Name" >
                     @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="client_id">Company Name</label>
                    <select name="client_id" class="form-control" id="client_id">
                      <option value="">Choose Name</option>
                      @foreach($Pclient as $cli)
                      <option @if($cli->id == old('client_id')) selected  @endif value="{{ $cli->id }}"
                >{{ $cli->name }}</option>
                      @endforeach
                    </select>
                     @error('client_id')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="gsstin_uin_of_recipient">Company Gstin</label>
                    <input class="form-control" id="gsstin_uin_of_recipient" name="gsstin_uin_of_recipient" value="{{ old('gsstin_uin_of_recipient') }}" type="text" aria-describedby="emailHelp" placeholder="choose receiver"  readonly="" >
                     @error('gsstin_uin_of_recipient')
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
                    <label for="comp_id">Receiver Name</label>
                    <select name="comp_id" class="form-control" id="comp_id">
                      <option value="">Choose Name</option>
                     {{--  @foreach($comp as $com)
                       <option @if($com->id == old('comp_id')) selected  @endif value="{{ $com->id }}"
                >{{ $com->name }}</option>
                      @endforeach --}}
                    </select>
                     @error('comp_id')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="e_commerece_gstin">E-commerce_gstin</label>
                    @php 
                    $gstin = App\Gstin::all();
                    @endphp
                     <select name="e_commerece_gstin" class="form-control">
                      <option value="">Choose Name</option>
                      @foreach($gstin as $com)
                      <option @if($com->id == old('e_commerece_gstin')) selected  @endif value="{{ $com->id }}"
                >{{ $com->gstin }}</option>
                      @endforeach
                    </select>
                     @error('e_commerece_gstin')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group">
                    <label for="tender_no">Tender No.</label>
                    <input class="form-control" id="tender_no" value="{{ old('tender_no')}}" name="tender_no" type="text" placeholder="Enter tender no" >
                     @error('tender_no')
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
                    <label for="invoive_number">Set Tax-Gst</label>
                    @php 
                    $gst = App\tax_gst::all();
                    @endphp
                    <select name="tax_gst" class="form-control">
                      <option value="">choose gst rate</option>
                    @foreach( $gst as $perm )
                   <option @if($perm->id == old('tax_gst')) selected  @endif value="{{ $perm->id }}"
                >{{ $perm->tax_gst }}</option>
                    @endforeach
                     </select> 
                     @error('tax_gst')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="sales_date">Set Tax-Tds</label>
                    @php 
                    $tds = App\TaxTdsmodel::all();
                    @endphp
                   <select name="tax_tds" class="form-control">
                    <option value="">choose tds rate</option>
                    @foreach( $tds as $perm )
                    <option @if($perm->id == old('tax_tds')) selected  @endif value="{{ $perm->id }}"
                >{{ $perm->tds_tax }}</option>
                    @endforeach
                     </select> 
                     @error('tax_tds')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group">
                    <label for="sd_percentage">set Sd %</label>
                    <input class="form-control" id="sd_percentage" type="text" aria-describedby="emailHelp" name="sd_percentage" value="{{ old('sd_percentage') }}" placeholder="Enter invoice type" >
                     @error('sd_percentage')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
              </div><div class="row">
              <div class="col-lg-6">
                   <div class="form-group">
                    <label for="place_of_supply">PLace of Supply</label>
                     <textarea class="form-control" id="place_of_supply"   name="place_of_supply" rows="3">{{ old('place_of_supply')}}</textarea>
                      @error('place_of_supply')
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="location">Note</label>
                     <textarea class="form-control" id="location"   name="location" rows="3">{{ old('location')}}</textarea>
                      @error('location')
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
    <script type="text/javascript">
      $(document).ready(function (){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
       $("#client_id").on("change",function(){
       var rec_id = $(this).val();
       $.ajax({
                 type: "GET",
                 url: "{{ route('get-Pclient') }}?id="+rec_id,
                 success: function(res){
                 	console.log(res);
                 $("#gsstin_uin_of_recipient").empty();
                 $("#gsstin_uin_of_recipient").val(res.Pgsin['gstin']);
                 $("#comp_id").empty();
                    $("#comp_id").append('<option value="">Select Receiver</option>');
                    $.each(res.Pac,function(index, recev){
                      //console.log(recev.company['name']);
                    $("#comp_id").append('<option value='+recev.company['id']+'>'+recev.company['name']+'</option>');
              });
              
                        
                   }
                      });

            
      
       });
    });

    </script>
@endsection

