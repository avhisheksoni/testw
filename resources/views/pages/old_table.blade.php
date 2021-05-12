<div class="col-md-12">
             @if($message = Session::get('message'))
      <div class="alert alert-success">  {{$message}}
      </div>
      @endif 
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable2">
                  <thead>
                    <tr>
                      <th>Comkutpany</th>
                      <th>Work_Name</th>
                      <th>Receiver</th>
                      <th>GSTIN-Recipient</th>
                      <th>Base Taxable value</th>
                      <th>Gst Amount</th>
                      <th>Gross Amount</th>
                     {{--  <th>Tds Amount</th> --}}
                      <th>Check Received Amount</th>
                    {{--   <th>Total Amount</th> --}}
                      <th>Outstanding</th>
                      <th>Action_performance</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                 <?php $s_no=1 ?>
                   @foreach($saleslist as $sale)
                    <tr>
                      <td>{{ $sale->job->company->name }}</td>
                      <td>{{ $sale->job->job_describe }}</td>
                      <td>{{ $sale->job->client->name }}</td>
                      <td>{{ $sale->job->client->gstin }}</td>
                      <td>{{ $sale->base_amount_taxable_value }}</td>
                      <td>{{ $sale->gst_amount }}</td>
                      <td>{{ $sale->gross_total_invoice_value }}</td>
                     {{--  <td>{{ $sale->tds_amount }}</td> --}}
                      <td>{{ $sale->cheque_received_amount }}</td>
                     {{--  <td>{{ $sale->total_amount }}</td> --}}
                      <td>{{ $sale->outstanding }}</td>
                      <td><a href="{{ route('saledetails',[$sale->id])}}"><button class="btn btn-warning"><i class="fa fa-lg fa-eye"></i></button></a>
                      <a href="{{ route('saleedit',[$sale->id])}}"><button class="btn btn-primary"><i class="fa fa-lg fa-edit"></i></button></a>
                      <a href="{{ route('saledelete',[$sale->id])}}"><button class="btn btn-danger"><i class="fa fa-lg fa-trash"></i></button></a></td>
                    </tr>
                    <?php $s_no++ ?>
                    @endforeach
                  </tbody>
                 {{--  <tfoot>
                    <tr><td>Total</td>
                        <td>{{$sum}}</td>
                    </tr>
                  </tfoot> --}}
                </table>
              </div>
            </div>
          </div>
        </div>