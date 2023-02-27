
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">  
      @if($adminbank->status==1)
       <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="mb-1 text-dark">
                    <a href="{{route('user.bank_transfer')}}">{{__('Bank Transfer')}}</a>
                  </h4>
                </div>
              </div>
            </div>
          </div>
      </div> 
      @endif
      @foreach($gateways as $val)   
       <div class="col-md-3">
          <div class="card">
            <!-- Card body -->
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="mb-1 text-dark">
                    <a href="#" data-toggle="modal" data-target="#modal-form{{$val->id}}">{{$val->name}}</a>
                  </h4>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal fade" id="modal-form{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="mb-0 h3">{{$val->name}}</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="{{route('fund.submit')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">{{$currency->symbol}}</span>
                    </div>
                    <input type="number" step="any" class="form-control" placeholder="" min="{{$val->minamo}}" max="{{$val->maxamo}}" name="amount" required>
                    <input type="hidden" name="gateway" value="{{$val->id}}">  
                  </div>
                </div>        
                @if($val->type==1)        
                <div class="form-group mb-3">
                  <input type="text" step="any" class="form-control" placeholder="{{$val->val1}}" name="details" required>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFileLang" name="image" lang="en" required>
                        <label class="custom-file-label" for="customFileLang">{{__('Proof')}}</label>
                    </div>
                </div>
                @endif
                <div class="text-center">
                  <button type="submit" class="btn btn-neutral btn-block my-4">{{__('Fund Account')}}</button>
                  <span class="text-xs form-text text-dark">Charge: @if($val->percent_charge!=null){{$val->percent_charge}}% @else 0% @endif+ @if($val->fiat_charge!=null){{$val->fiat_charge}} @else 0 @endif{{$currency->name}}</span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> 
      @endforeach
    </div>
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Deposit logs')}}</h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-basic">
          <thead class="">
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Method')}}</th>
              <th>{{__('Status')}}</th>
              <th>{{__('Charge')}}</th>
              <th>{{__('Created')}}</th>
              <th>{{__('Updated')}}</th>
            </tr>
          </thead>
          <tbody>  
            @foreach($deposits as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>#{{$val->trx}}</td>
                <td>{{$currency->symbol.number_format($val->amount, 2, '.', '')}}</td>
                <td>{{$val->gateway['name']}}</td>
                <td>
                @if($val->status==1)
                {{__('Approved')}}
                @elseif($val->status==0)
                {{__('Pending')}}               
                @elseif($val->status==2)
                {{__('Declined')}}
                @endif
                </td>
                <td>{{$currency->symbol.number_format($val->charge, 2, '.', '' )}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @if($adminbank->status==1)
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Bank transfer logs')}}</h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-basic2">
          <thead class="">
              <tr>
                <th>{{__('S / N')}}</th>
                <th>{{__('Reference ID')}}</th>
                <th>{{__('Amount')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Created')}}</th>
                <th>{{__('Updated')}}</th>
              </tr>
            </thead>
            <tbody>  
            @foreach($bank_transfer as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>#{{$val->trx}}</td>
                <td>{{$currency->symbol.number_format($val->amount)}}</td>
                <td>
                  @if($val->status==1)
                  {{__('Approved')}}
                  @elseif($val->status==0)
                  {{__('Pending')}}            
                  @elseif($val->status==2)
                  {{__('Declined')}}
                  @endif
                </td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif

@stop