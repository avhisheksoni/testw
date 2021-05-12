@extends('layouts.master')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Job List</h1>
          <p>All Record till Now</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Job List</li>
          <li class="breadcrumb-item active"><a href="{{ route('job-create') }}">Job Add</a></li>
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
                      <th>P-Job_Name/Work_name</th>
                      <th>Receiver</th>
                      <th>Location</th>
                      <th>Action</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                 <?php $s_no=1 ?>
                    @foreach( $Pcl as $perm)
                    <tr>
                      <td>{{ $perm->Pclient->name }}</td>
                      <td>{{ $perm->name }}</td>
                      <td>{{ $perm->Pcompany->name }}</td>
                      <td>{{ $perm->location }}</td>
                      {{-- <td><a href=""><button class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></button></a></td> --}}
                      <td><a href="{{ route('PJobMast.show',$perm->id )}}"><button class="btn btn-warning"><i class="fa fa-lg fa-eye"></i></button></a>
                      <a href="{{ route('PJobMast.edit',$perm->id )}}"><button class="btn btn-primary"><i class="fa fa-lg fa-edit"></i></button></a></td>
                      <td><form action="{{ route('PJobMast.destroy',$perm->id)}}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-danger"><i class="fa fa-lg fa-trash"></i></button>
                    </form>
                      </td>
                    </tr>
                    <?php $s_no++ ?>
                    @endforeach
                  </tbody>
                </table>
                {{ $Pcl->links() }}
              </div>
            </div>
          </div>
          <div class="tile-footer">
                <a href="{{ route('PJobMast.create')}}"><button class="btn btn-primary">Add Job</button></a>
              </div>
        </div>
      </div>
    </main>

@endsection