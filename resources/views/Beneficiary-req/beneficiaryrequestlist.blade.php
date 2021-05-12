@extends('layouts.master')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Banks</h1>
          <p>All Record till Now</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Banks</li>
          <li class="breadcrumb-item active"><a href="{{ route('purchaseform') }}">Bank-From</a></li>
        </ul>
      </div>
      {{-- <p><a class="btn btn-primary icon-btn" href="{{ route('fund-request') }}"><i class="fa fa-plus"></i>Add Fund Request</a></p> --}}
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
                      <th>User</th>
                      <th>Beneficiary</th>
                      <th>Job/Work-name</th>
                      <th>Request Type</th>
                      <th>Code</th>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Action_Performance</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                 <?php $s_no=1 ?>
                    @foreach($beneficiary as $perm)
                    <tr>
                      <td>{{ $s_no }}</td>
                      <td>{{ $perm->username->name }}</td>
                      <td>{{ $perm->benef->name }}</td>
                      <td>{{ $perm->workname->job_describe }}</td>
                      <td>{{ $perm->bgtype->name }}</td>
                      <td>{{ $perm->request_code }}</td>
                      <td>{{ $perm->bg_request_date }}</td>
                      <td>{{ $perm->amount }}</td>
                      <td>{{-- <a href="{{ route('beneficiary-request-details',[$perm->id]) }}"><button class="btn btn-warning"><i class="fa fa-lg fa-eye"></i></button></a> --}}<a href="{{ route('beneficiary-request-edit',[$perm->id]) }}"><button class="btn btn-primary"><i class="fa fa-lg fa-edit"></i></button></a>
                        <a href="{{ route('beneficiary-request-delete',[$perm->id]) }}"><button class="btn btn-danger"><i class="fa fa-lg fa-trash"></i></button></a>
                      </td>
                      @role('superadmin','admin')
                      <?php if( $perm->status == 'Approved'){ ?>
                      <td><a href="{{ route('beneficiary-status',[$perm->id]) }}"><button class="btn btn-success">{{ $perm->status }}</button></a></td>
                      <?php } else { ?>
                       <td><a href="{{ route('beneficiary-status',[$perm->id]) }}"><button class="btn btn-warning">{{ $perm->status }}</button></a></td>
                       <?php } ?>
                       
                      @endrole
                    
                    </tr>
                    <?php $s_no++ ?>
                    @endforeach
                  </tbody>
                </table>
                {{ $beneficiary->links() }}
              </div>
            </div>
          </div>
             <div class="tile-footer">
                <a href="{{ route('beneficiary-request-add') }}"><button class="btn btn-primary">Add Request</button></a>
              </div>
        </div>
      </div>
    </main>
@endsection