
@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8">
        <div class="card" >
          <div class="card-header">
            <h3 class="mb-0 text-dark">{{__('Bank Transfer')}}</h3>
          </div>
          <div class="card-body">
          <form method="post" action="{{route('bank_transfersubmit')}}" enctype="multipart/form-data">
          @csrf
           <div class="form-group row">
              <label class="col-form-label col-lg-3">{{__('Transfer Amount')}}</label>
              <div class="col-lg-9">
                <div class="input-group">
                  <span class="input-group-prepend">
                    <span class="input-group-text">{{$currency->symbol}}</span>
                  </span>
                <input type="number" step="any" name="amount" max-length="10" class="form-control">
                  </div>
                </div>
            </div>
            <div class="form-group row">
              <label class="col-form-label col-lg-3">{{__('Transfer Notes')}}</label>
              <div class="col-lg-9">
                  <textarea type="text" class="form-control" rows="5" placeholder="{{__('Transaction Details')}}" name="details" required></textarea>
              </div>
            </div> 
            <div class="form-group row">
              <label class="col-form-label col-lg-3">{{__('Proof of Payment')}}</label>
              <div class="col-lg-9">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFileLang" name="image" lang="en">
                  <label class="custom-file-label" for="customFileLang">{{__('Choose Screenshot')}}</label>
                </div>
              </div>
            </div> 
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
            <div class="text-right">
                <button type="submit" class="btn btn-primary btn-block">{{__('Proceed')}}</button>
            </div>
                </div>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card" >
          <div class="card-body text-left">
            <div class="">
              <div>
                <h3 class="card-title mb-3 text-dark">{{__('Bank details')}}</h3>
                <ul class="list list-unstyled mb-0 card-text text-sm text-dark">
                  @if($bank->name!=null)<li>{{__('Name')}}: {{$bank->name}}</li>@endif
                  @if($bank->bank_name!=null)<li>{{__('Bank')}}: {{$bank->bank_name}}</li>@endif
                  @if($bank->address!=null)<li>{{__('Address')}}: {{$bank->address}}</li>@endif
                  @if($bank->swift!=null)<li>{{__('Swift Code')}}: {{$bank->swift}}</li>@endif
                  @if($bank->iban!=null)<li>{{__('Iban Code')}}: {{$bank->iban}}</li>@endif
                  @if($bank->acct_no!=null)<li>{{__('Account Number')}}: {{$bank->acct_no}}</li>@endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    </div>
@stop