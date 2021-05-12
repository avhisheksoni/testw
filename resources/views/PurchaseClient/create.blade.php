@extends('layouts.master')
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Add Purchase Company</h1>
          <p>Add Purchase Company</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Purchase Company</li>
          <li class="breadcrumb-item"><a href="">Purchase Company List</a></li>
        </ul>
      </div>
       <p><a class="btn btn-primary icon-btn" href="{{  route('client-list') }}">Back</a></p>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <form action="{{route('PurchaseClient.store')}}" method="post">
              @csrf
            <div class="row">
              <div class="col-md-6">
          <div class="tilk">
            <h3 class="tile-title">Purchase Company</h3>
            <div class="tile-body">
              <form class="form-horizontal">
                <div class="form-group row">
                  <label class="control-label col-md-3">Purchase Company</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="name" value="{{ old('name')}}" placeholder="Enter Client name">
                     @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                  <div class="form-group row">
                  <label class="control-label col-md-3">GSTIN/UIN of Recipient</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="gstin" value="{{ old('stin') }}" placeholder="Enter Client Gstin">
                     @error('gstin')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-lg fa-plus"></i>Add</button>
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