@extends('layouts.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Purchase List</h1>
          <p>All Record till Now</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Purchase List</li>
          <li class="breadcrumb-item active"><a href="{{ route('purchaseform') }}">Purchase-From</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
        	 @if($message = Session::get('message'))
      <div class="alert alert-success">  {{$message}}
      </div>
      @endif 
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>S.no.</th>
                      <th>GSTIN-Recipient</th>
                      <th>Receiver</th>
                      <th>Place of Supply</th>
                      <th>Invoice No.</th>
                      <th>Sale Date</th>
                      <th>Cheque  Date</th>
                      <th>Gross_total</th>
                      <th>View Dtaile</th>
                      <th>Update</th>
                      <th>Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
                 <?php $s_no=1 ?>
                   @foreach( $purchaselist as $list)
                    <tr>
                      <td>{{ $s_no }}</td>
                      <td>{{ $list->gsstin_uin_of_recipient }}</td>
                      <td>{{ $list->receiver_name }}</td>
                      <td>{{ $list->place_of_supply }}</td>
                      <td>{{ $list->invoive_number }}</td>
                      <td>{{ $list->purchase_date }}</td>
                      <td>{{ $list->cheque_date }}</td>
                      <td>{{ $list->gross_total_invoice_value }}</td>
                      <td><a href="{{ route('purchasedetails',[$list->id])}}"><button class="btn btn-info">Detail</button></a>
                      </td>
                      <td><a href="{{ route('purchaseedit',[$list->id])}}"><button class="btn btn-primary">Edit</button></a></td>
                      	<td><a href="{{ route('purchasedelete',[$list->id])}}"><button class="btn btn-danger">Delete</button>
                      </td>
                    </tr>
                    <?php $s_no++ ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

@endsection