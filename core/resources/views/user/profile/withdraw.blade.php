@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-4">
        <h6 class="h2 d-inline-block mb-0 font-weight-bolder">{{__('Payouts')}}</h6>
      </div>
      <div class="col-8 text-right">
        <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fal fa-plus"></i> {{__('Request payout')}}</a>
      </div>
    </div>
    <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="mb-0 h3">{{__('Create Payout Request')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('withdraw.submit')}}" method="post">
              @csrf
              <div class="form-group row">
                <div class="col-lg-12">
                  <select class="form-control select" name="coin" id="method" onkeyup="setwithdrawcharge()" required>
                  <option value=''>{{__('Select Payout Method')}}</option>
                  @foreach($method as $val)
                    <option value='{{$val->id}}*@if($val->fiat_charge!=null){{$val->fiat_charge}}@else 0 @endif*@if($val->percent_charge!=null){{$val->percent_charge}}@else 0 @endif*{{$val->min}}*{{$val->max}}*{{$val->requirements}}'>{{$val->method}}</option>
                  @endforeach
                  </select>
                  <span class="text-xs text-gray" id="xx"></span>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">{{$currency->symbol}}</span>
                    </div>
                    <input type="number" step="any" name="amount" maxlength="10" id="withdraw_amount" onkeyup="withdrawcharge()" class="form-control" placeholder="0.00" required>
                    <input type="hidden" id="percent_charge" name="percent_charge">
                    <input type="hidden" id="fiat_charge" name="fiat_charge">
                  </div>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-lg-12">
                  <select class="form-control select" name="type" required>
                    <option value="">{{__('Debit From')}}</option>
                    <option value="1">{{__('Profit')}} - {{$currency->symbol.number_format($user->profit,2)}}</option>
                    <option value="2">{{__('Account balance')}} - {{$currency->symbol.number_format($user->balance,2)}}</option>
                    <option value="3">{{__('Referral earnings')}} - {{$currency->symbol.number_format($user->ref_bonus,2)}}</option>
                  </select>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-lg-12">
                <textarea type="text" name="details" rows="4" id="details" class="form-control" placeholder="Details" required=""></textarea>
                </div>
              </div>                
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-block">{{__('Request Payout')}} <span id="result"></span></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>   
    <div class="row">
      <div class="col-md-8">
        <div class="row"> 
          @if(count($withdraw)>0)
            @foreach($withdraw as $k=>$val)
              <div class="col-md-6">
                <div class="card">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <!-- Title -->
                        <h4 class="mb-0 text-dark">{{$val->reference}}</h4>
                      </div>
                      <div class="col-4 text-right">
                        @if($val->status==0)
                          <a data-toggle="modal" data-target="#modal-forma{{$val->id}}" href="" class="btn btn-sm btn-success">{{__('Update')}}</a>
                        @endif
                      </div>
                      <div class="col">
                        <p class="text-sm text-dark mb-0">{{__('Amount')}}: {{number_format($val->amount, 2, '.', '').$currency->name}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Method')}}: {{$val->wallet['method']}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Details')}}: {{$val->details}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Type')}}: @if($val->type==1) {{__('Trading profit')}} @elseif($val->type==2) {{__('Account balance')}} @elseif($val->type==3) {{__('Referral bonus')}} @endif</p>
                        <hr>
                        @if($set->ns==1)
                        <p class="text-sm text-dark mb-0">{{__('Next Settlement')}}: {{date("Y/m/d", strtotime($val->next_settlement))}}</p>
                        @else
                        <p class="text-sm text-dark mb-0">{{__('Due By')}}: @if($val->status==0){{date("Y/m/d", strtotime($val->next_settlement))}} @else - @endif</p>
                        @endif
                        <p class="text-sm text-dark mb-0">{{__('Created')}}: {{date("Y/m/d h:i:A", strtotime($val->created_at))}}</p>
                        <p class="text-sm text-dark mb-2">{{__('Updated')}}: {{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</p>
                        <span class="badge badge-pill badge-primary">{{__('Charge')}}: {{$currency->symbol.number_format($val->charge, 2, '.', '')}}</span>
                        @if($val->status==1)
                          <span class="badge badge-pill badge-success"><i class="fal fa-check"></i> {{__('Paid out')}}</span>
                        @elseif($val->status==0)
                          <span class="badge badge-pill badge-danger"><i class="fal fa-spinner"></i>  {{__('Pending')}}</span>                         
                        @elseif($val->status==2)
                          <span class="badge badge-pill badge-danger"><i class="fal fa-ban"></i>  {{__('Declined')}}</span>                        
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="modal fade" id="modal-forma{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="mb-0">{{__('Edit Payout Details')}}</h3>
                    </div>
                    <div class="modal-body">
                      <form action="{{url('user/withdraw-update')}}" method="post">
                        @csrf 
                        <div class="form-group row">
                          <div class="col-lg-12">
                            <textarea name="details" class="form-control" rows="4" placeholder="{{$val->wallet->requirements}}">{{$val->details}}</textarea>
                            <input name="withdraw_id" type="hidden" value="{{$val->id}}">
                          </div>
                        </div>                
                        <div class="text-right">
                          <button type="submit" class="btn btn-success btn-block">{{__('Save')}}</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div> 
            @endforeach
          @else
          <div class="col-md-12 mb-5">
            <div class="text-center mt-8">
              <div class="btn-wrapper text-center">
                <a href="javascript:void;" class="btn btn-neutral btn-icon mb-3">
                    <span class="btn-inner--icon"><i class="fal fa-calendar fa-4x"></i></span>
                </a>
              </div>
              <h3 class="text-dark">{{__('No Payout')}}</h3>
              <p class="text-dark text-sm card-text">{{__('We couldn\'t find any payouts money request to this account')}}</p>
              <div class="row align-items-center py-4">
                <div class="col-12">
                  <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fal fa-plus"></i> {{__('First Payout Request')}}</a>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
        <div class="row">
          <div class="col-md-12">
          {{ $withdraw->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
      <div class="col-md-4">
        @if($set->ns==1)
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h3 class="mb-0 h4 font-weight-bolder">{{__('Next Settlement')}}</h3>
                  <ul class="list list-unstyled mb-0">
                    <li><span class="text-default text-sm">{{date("Y/m/d", strtotime($set->next_settlement))}}</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">{{__('Profit')}} - {{$currency->symbol.number_format($user->profit, 2)}}</li>
            <li class="list-group-item">{{__('Account balance')}} - {{$currency->symbol.number_format($user->balance, 2)}}</li>
            <li class="list-group-item">{{__('Referral earnings')}} - {{$currency->symbol.number_format($user->ref_bonus, 2)}}</li>
          </ul>
        </div>
        <div class="card widget-calendar">
            <!-- Card header -->
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <!-- Title -->
                  <h5 class="h4 mb-0">Payout Method</h5>
                </div>
              </div>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <ul class="list-group list-group-flush list my--3">
                @foreach($method as $val)
                  <li class="list-group-item px-0">
                    <div class="row align-items-center">
                      <div class="col-12">
                      <h5 class="mb-0">{{$val->method}}</h5>
                      </div>
                      <div class="col">
                        <small>Limit</small>
                        <h5 class="mb-0">{{$val->min}}-{{$val->max}}{{$currency->name}}</h5>
                      </div>
                      @if($set->ns==0)
                      <div class="col">
                        <small>Duration</small>
                        <h5 class="mb-0">{{$val->period}} {{$val->duration}}(s)</h5>
                      </div>
                      @endif
                      <div class="col">
                        <small>Charge</small>
                        <h5 class="mb-0">@if($val->percent_charge!=null){{$val->percent_charge}}% @else 0% @endif+ @if($val->fiat_charge!=null){{$val->fiat_charge}} @else 0 @endif{{$currency->name}}</h5>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
      </div>
    </div>
@stop