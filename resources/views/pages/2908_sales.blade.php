@extends('layouts.master')
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Reconcillation</h1>
          <p>Sales Form</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Sales Form</li>
          <li class="breadcrumb-item"><a href="{{route('salelist')}}">Sales List</a></li>
        </ul>
      </div>
      
        <div class="col-md-12">
          <div class="tile">
            <form action="{{ route('sales_store') }}" method="post">
              @csrf
              <div class="row">
                 <div class="col-lg-4">
                  @php 
                  $cmp = App\Company_mast::all();
                  @endphp
                  <div class="form-group">
                    <label for="place_of_supply">Company</label>
                    <select name="comp_id" class="form-control" id="comp_id">
                      <option value="">choose</option>
                      @foreach($cmp as $com)
                      <option value="{{ $com->id }}">{{ $com->name }}</option>
                      @endforeach
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
                    <label for="e_commerce_gstin">E-commerce_gstin</label>
                    <input class="form-control" id="e_commerce_gstin" value="{{ old('e_commerce_gstin')}}" name="e_commerce_gstin" type="text" placeholder="E-commerce_gstin" readonly>
                     @error('e_commerce_gstin')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
               <div class="col-lg-4">
                  <div class="form-group">
                    <label for="place_of_supply">Place of Supply</label>
                    <input class="form-control" id="place_of_supply" value="{{ old('place_of_supply')}}" name="place_of_supply" type="text" placeholder="place of supply" readonly>
                     @error('place_of_supply')
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
                    <label for="client_id">Receiver Name</label>
                  <select name="client_id" class="form-control" id="client_id">
                  <option value="">--select--</option>
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
                    <label for="job_id">Work Name</label>
                   <select name="job_id"  name="" id="job_id" class="form-control">
                    <option value="">--select--</option>
                   </select>
                    @error('job_id')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="gsstin_uin_of_recipient">GSTIN/UIN of Recipient</label>
                    <input class="form-control" id="gsstin_uin_of_recipient" name="gsstin_uin_of_recipient" value="{{ old('gsstin_uin_of_recipient')}}" type="text" aria-describedby="emailHelp" placeholder="Enter GSTIN" readonly >
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
                    <label for="invoive_number">Invoice No.</label>
                    <input class="form-control" id="invoive_number" name="invoive_number" type="text" aria-describedby="emailHelp" value="{{ old('invoive_number')}}" placeholder="Invoice No.">
                     @error('invoive_number')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="sales_date">Invoice Date</label>
                   <input type="text" id="sales_date" class="form-control" name="sales_date" value="{{ old('sales_date')}}" placeholder="sales date" autocomplete="off">
                     @error('sales_date')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group">
                    <label for="invoice_type">Invoice Type</label>
                    <input class="form-control" id="invoice_type" type="text" aria-describedby="emailHelp" name="invoice_type" value="Regular" placeholder="Enter invoice type" readonly="">
                     @error('invoice_type')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
              </div> <div class="row">
              <div class="col-lg-4">
                    <div class="form-group">
                    <label for="base_amount_taxable_value">Base Amount(taxable)</label>
                    <input class="form-control amount pro" id="base_amount_taxable_value" type="text" aria-describedby="emailHelp" value="{{ old('base_amount_taxable_value')}}" name="base_amount_taxable_value" placeholder="Base amount taxable value">
                     @error('base_amount_taxable_value')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group">
                    <div class="row">
                    <div class="col-lg-6">
                    <label for="gst_rate">Gst Rate</label>
                    <input class="form-control" id="gst_rate" value="{{ old('gst_rate')}}" name="gst_rate" type="text" placeholder="gst_rate" readonly>
                     @error('gst_rate')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                    <div class="col-lg-6">
                    <label for="gst_amount">Gst Amount</label>
                    <input class="form-control pro" id="gst_amount" type="text" aria-describedby="emailHelp" value="{{ old('gst_amount')}}" name="gst_amount" placeholder="gst_amount" readonly="">
                     @error('gst_amount')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="gross_total_invoice_value">gross_total(Invoice value)</label>
                    <input class="form-control pro" id="gross_total_invoice_value" name="gross_total_invoice_value"  type="text" value="{{ old('gross_total_invoice_value')}}" aria-describedby="emailHelp" placeholder="Enter gross total" readonly="">
                     @error('gross_total_invoice_value')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
              </div> <div class="row">
              <div class="col-lg-4">
                   <div class="form-group">
                    <label for="cheque_date">Cheque  Date</label>
                      <input type="text" id="cheque_date" class="form-control" name="cheque_date" value="{{ old('cheque_date')}}" placeholder="cheque  date" autocomplete="off">
                     @error('cheque_date')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group">
                    <div class="row">
                      <div class="col-lg-6">
                    <label for="cheque_received_amount">Cheque Amount</label>
                    <input class="form-control pro" id="cheque_received_amount" name="cheque_received_amount" type="text" value="{{ old('cheque_received_amount')}}" aria-describedby="emailHelp" placeholder="cheque received amount">
                  
                     @error('cheque_received_amount')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  <div class="col-lg-6">
                    <label for="tds">TDS Rate</label>
                    <input class="form-control" id="tds" value="{{ old('tds')}}" name="tds" type="text" placeholder="tds" readonly>
                     @error('tds')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <div class="row">
                  <div class="col-lg-6">
                    <label for="tds_amount">Tds Amount</label>
                    <input class="form-control pro" id="tds_amount" type="text" aria-describedby="emailHelp" value="{{ old('tds_amount')}}" name="tds_amount" placeholder="tds_amount" readonly="">
                     @error('tds_amount')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  <div class="col-lg-6">
                    <label for="total_amount">Total Amount</label>
                    <input class="form-control total pro" id="total_amount" value="{{ old('total_amount')}}" name="total_amount" type="number" placeholder="Amount " readonly="">
                     @error('total_amount')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  </div>
                  </div>
                </div>
              </div> <div class="row">
              <div class="col-lg-4">
                 <div class="form-group">
                    <label for="other">other charges(if any)</label>
                    <input class="form-control gross pro" id="other" name="other"  type="number" aria-describedby="emailHelp" value="{{ old('other')}}" placeholder="Enter other">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="five_percrnt_sd">Fixed Deposite Rate(sd)</label>
                    <input class="form-control" id="five_percrnt_sd" name="five_percrnt_sd" type="text" aria-describedby="emailHelp" value="{{ old('five_percrnt_sd')}}" placeholder="Fixed Deposite Rate" readonly>
                     @error('five_percrnt_sd')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group">
                    <label for="tds_amount">sd_amount</label>
                    <input class="form-control pro" id="five_percrnt_sd_amount" type="text" aria-describedby="emailHelp" value="{{ old('five_percrnt_sd_amount')}}" name="five_percrnt_sd_amount" placeholder="sd amount cal" readonly="">
                  </div>
                </div>
              </div> <div class="row">
              <div class="col-lg-4">
                  <div class="form-group">
                    <label for="outstanding">Outstanding</label>
                    <input class="form-control pro" id="outstanding" name="outstanding" type="text" aria-describedby="emailHelp" value="{{ old('outstanding')}}" placeholder="Enter Outstanding" readonly="">
                     @error('outstanding')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="description">Description</label>
                     <textarea class="form-control" id="description"   name="description" rows="3">{{ old('description')}}</textarea>
                      @error('description')
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
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
 $("#comp_id").on('change',function(){
      var rec_id = $(this).val();

      $.ajax({
                 type: "GET",
                 url: "{{ route('assign-client') }}?id="+rec_id,
                 success: function(res){
                  if(res){
                    $("#client_id").empty();
                    $("#client_id").append('<option value="0">Select Receiver</option>');
                    $.each(res,function(index, recev){
                    $("#client_id").append('<option value='+recev.client['id']+'>'+recev.client['name']+'</option>');
              });
                  }
}

 });
 });
 $("#client_id").on('change',function(){
       
       var cl_id = $(this).val();
       var cmp_id = document.getElementById('comp_id').value;
      
      $.ajax({
                url: "{{  route('get-work')}}",
                type: 'GET',
                // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'id':cl_id,'cid':cmp_id},
                success: function (data) {
                  console.log(data);
                  $("#job_id").empty();
                  $("#job_id").append('<option value="0">Work Name</option>');
                    $.each(data,function(index, recev){
                    $("#job_id").append('<option value='+recev.id+'>'+recev.job_describe+'</option>');
              });
                 
                }
            })
       

 });

 // $('#client_id').on('change',function(){
 //      rec_id = $(this).val();
 //      $.ajax({
 //                 type: "GET",
 //                 url: "{{ route('get-client') }}?id="+rec_id,
 //                 success: function(res){
 //                  if(res){
 //                    $("#gsstin_uin_of_recipient").empty();
 //                    $("#gsstin_uin_of_recipient").val(res.rec['gstin']);
 //                    $("#job_id").empty();
 //                    $("#job_id").append('<option value="0">Select Receiver</option>');
 //                    $.each(res.job,function(index, recev){
 //                    $("#job_id").append('<option value='+recev['id']+'>'+recev['job_describe']+'</option>');
 //              });
 //                  }else{
 //                      $("#district").empty();

 //                  }
 //                }
 //                      });

 // });
 $("#job_id").on("change",function(){
        $(".pro").val("");
           var id = $(this).val();
          $.ajax({
                 type: "GET",
                 url: "{{ route('get-receiver') }}?id="+id,
                 success: function(res){
                  console.log(res);
                 if(res){
                        $("#gst_rate").empty();
                        $("#gst_rate").val(res.gst['tax_gst']);
                        $("#place_of_supply").empty();
                        $("#place_of_supply").val(res.place_of_supply);
                        $("#tds").empty();
                        $("#tds").val(res.tds['tds_tax']);
                        $("#gsstin_uin_of_recipient").empty();
                        $("#gsstin_uin_of_recipient").val(res.client['gstin']);
                        $("#workname").empty();
                        $("#workname").val(res.job_describe);
                        $("#five_percrnt_sd").empty();
                        $("#five_percrnt_sd").val(res.sd_percentage);
                        $("#e_commerce_gstin").empty(res.gstn);
                        $("#e_commerce_gstin").val(res.gstn['gstin']);
                      }
                      else{
                      $("#district").empty();
                      }
                    }
                      });

            
      });

     $("#base_amount_taxable_value").on('blur',function (){
        var gross  = gross_total();
       $("#gross_total_invoice_value").val("");
       $("#gross_total_invoice_value").val(gross[0]);
       $("#gst_amount").val("");
       $("#gst_amount").val(gross[1]);
       $("#tds_amount").val("");
       $("#total_amount").val("");
       $("#cheque_received_amount").val("");
       $("#outstanding").val("");
       $("#five_percrnt_sd_amount").val("");

     });

     $("#cheque_received_amount").on('blur',function(){
        var grosst = document.getElementById('gross_total_invoice_value').value;
        if(grosst != ""){
          var tds = document.getElementById('tds').value;
          var batv = document.getElementById('base_amount_taxable_value').value;
          var cra = document.getElementById('cheque_received_amount').value;
          var fpsd = document.getElementById('five_percrnt_sd').value;
          var tdsam = (batv * tds)/100;
           $("#tds_amount").val("");
           $("#tds_amount").val(tdsam);
           var fivesd = (batv * fpsd)/100;
           $("#five_percrnt_sd_amount").val(fivesd);
           var tcar = (parseFloat(cra)+parseFloat(tdsam)).toFixed(2);
           $("#total_amount").val("");
           $("#total_amount").val(tcar);
           // outst = parseFloat(cra)+parseFloat(tdsam)+parseFloat(fivesd);
           // total = document.getElementById('gross_total_invoice_value').value;
           // outs = (parseFloat(total)-parseFloat(outst)).toFixed(2);
            var newgross = outstanding();
            $("#outstanding").val("");
            $("#outstanding").val(newgross[2]);

        }else{

          alert("filled base amount taxable");
        }


     });

     $(".gross").on("blur", function() {
        var gross  = gross_total();
        var other_charges = $(this).val();
         var outstand = outstanding();

        $("#outstanding").val(parseFloat(outstand[2])-parseFloat(other_charges));

    });

        function gross_total(){
           var gst = document.getElementById('gst_rate').value;
           var batv = document.getElementById('base_amount_taxable_value').value;
           var gstrate = (batv * gst)/100;
           var total = (parseFloat(batv) + parseFloat(gstrate)).toFixed(2);
           return [total,gstrate];
        }
        function outstanding(){
             var grosst = document.getElementById('gross_total_invoice_value').value;
        if(grosst != ""){
          var tds = document.getElementById('tds').value;
          var batv = document.getElementById('base_amount_taxable_value').value;
          var cra = document.getElementById('cheque_received_amount').value;
          var fpsd = document.getElementById('five_percrnt_sd').value;
          var tdsam = (batv * tds)/100;
           var fivesd = (batv * fpsd)/100;
           var tcar = (parseFloat(cra)+parseFloat(tdsam)).toFixed(2);
          // outst = parseFloat(cra)+parseFloat(tdsam)+parseFloat(fivesd);
           outst = parseFloat(tcar)+parseFloat(fivesd);
           total = document.getElementById('gross_total_invoice_value').value;
           outs = (parseFloat(total)-parseFloat(outst)).toFixed(2);
           return [tdsam,fivesd,outs];

        }
      }
     });
</script>
     
@endsection

