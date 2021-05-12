@extends('layouts.master')
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Company Name Detail</h1>
          <p>Company Name</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Company Detail</li>
          <li class="breadcrumb-item"><a href="{{  route('company-list') }}">Company List</a></li>
        </ul>
      </div>
       <p><a class="btn btn-primary icon-btn" href="{{  route('company-list') }}">Back</a></p>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <form action="{{ route('company-update',[$edit->id]) }}" method="post">
              @csrf
            <div class="row">
              <div class="col-md-6">
          <div class="tilk">
            <h3 class="tile-title">Company</h3>
            <div class="tile-body">
              <form class="form-horizontal">
                <div class="form-group row">
                  <label class="control-label col-md-3">Company code</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="code" value="{{ $edit->code }}" placeholder="" readonly>
                     @error('code')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Name</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="name" value="{{ $edit->name }}" placeholder="Enter Company name" readonly>
                     @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
              </form>
          </div>
        </div>
        </div>
      </form>
        </div>
          </div>
        </div>
    </main>
@endsection