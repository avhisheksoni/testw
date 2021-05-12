@extends('layouts.master')
@section('content')



<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Due Amount</h1>
          <p>All Record till Now</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Due Amount</li>
          <li class="breadcrumb-item active"><a href="">Due Amount-From</a></li>
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
                      {{-- <th>S.no.</th> --}}
                      <th>Company</th>
                      <th>Tender No.</th>
                      <th>Tender Date</th>
                      <th>Work Name</th>
                      <th>Tender Emd Fdr</th>
                      <th>Maturity Amount</th>
                      <th>view</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
                 <?php $s_no=1 ?>
                    @foreach( $amut as $perm)
                    <tr>
                      {{-- <td>{{ $s_no }}</td> --}}
                      <td>{{ $perm->company_id }}</td>
                      <td>{{ $perm->tender_no }}</td>
                      <td>{{ $perm->tender_date }}</td>
                      <td>{{ $perm->name_of_work }}</td>
                      <td>{{ $perm->tender_emd_fdr }}</td>
                      <td>{{ $perm->maturity_amount }}</td>
                      <td><a href=""><button class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></button></a></td>
                      <td><a href=""><button class="btn btn-primary"><i class="fa fa-lg fa-edit"></i></button></a>
                        <a href=""><button class="btn btn-danger"><i class="fa fa-lg fa-trash"></i></button></a>
                      </td>
                    </tr>
                    <?php $s_no++ ?>
                    @endforeach
                  </tbody>
                </table>
                {{-- {{ $benef->links() }} --}}
              </div>
            </div>
          </div>
            <div class="tile-footer">
                <a href="{{ route('due_create') }}"><button class="btn btn-primary">Add Due Amount</button></a>
              </div>
        </div>
      </div>
      <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    </div>
  </div>
    </main>
@endsection