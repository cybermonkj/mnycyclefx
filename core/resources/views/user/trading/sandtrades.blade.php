@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.sandtrades')==url()->current()) active @endif" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fal fa-sledding fa-lg"></i> {{__('Investment')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.sandsharing')==url()->current()) active @endif" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-retweet"></i> {{__('Sharing History')}}</a>
                    </li>                   
                </ul>
            </div>
        </div>
      </div>          
    </div>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade @if(route('user.sandtrades')==url()->current())show active @endif" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
        <div class="row">
          @if(count($profit)>0)
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="mb-0">{{__('Transactions')}}</h3>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons">
                    <thead>
                        <tr>
                        <th>{{__('S / N')}}</th>
                        <th></th>
                        <th></th>
                        <th>{{__('Ref ID')}}</th>
                        <th>{{__('Units')}}</th>
                        <th>{{__('Amount')}}</th>
                        <th>{{__('ROI')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Started')}}</th>
                        <th>{{__('End date')}}</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($profit as $k=>$val)
                        <tr>
                            <td>{{++$k}}.</td>
                            <td><a href="{{route('view.sandplan', ['id' => $val->plan['slug']])}}">Plan Updates</a></td>
                            <td><a data-toggle="modal" @if($val->status==2) disabled @endif data-target="#share{{$val->id}}" title="share" href="">Share Units</a></td>
                            <td>#{{$val->trx}}</td>
                            <td>{{$val->units}}</td>
                            <td>{{$currency->symbol.number_format($val->amount, '2', '.', '')}}</td>
                            <td>{{$currency->symbol.number_format($val->profit-$val->amount, '2', '.', '')}}</td>
                            <td>@if($val->status==1) Running @else Ended @endif</td>
                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                            <td>{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  @foreach($profit as $k=>$val)
                  <div class="modal fade" id="share{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card border-0 mb-0">
                            <div class="card-header bg-transparent pb-5">
                                <div class="text-dark text-center mt-2 mb-3"><small>{{__('Share Units')}}</small></div>
                                <div class="btn-wrapper text-center">
                                <h4 class="text-uppercase ls-1 text-dark py-3 mb-0">{{$val->plan['name']}}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" action="{{route('user.sandshare_plan')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="{{__('Units')}}" name="units" min="1" max="{{$val->units}}" required>
                                    <input type="hidden" name="trx" value="{{$val->trx}}">
                                    </div>
                                </div>                            
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{__('Merchant ID')}}" name="merchant_id" maxlength="6" required>
                                    </div>
                                </div>      
                                <div class="custom-control custom-control-alternative custom-checkbox mb-5">
                                    <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="terms" checked required>
                                    <label class="custom-control-label" for=" customCheckLogin">
                                            <p class="text-muted">This transaction requires your consent before continuing. Read <a href="{{route('terms')}}">Terms & Conditions</a></p>
                                    </label>
                                </div>                                               
                                <div class="text-center">
                                    <button type="submit" class="btn btn-neutral btn-block">{{__('Send Unit')}}</button>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                  @endforeach
                </div>
              </div>
            </div>
          @else
            <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">You have not invested on any plan</p>
            </div>
          @endif
        </div>
      </div>
      <div class="tab-pane fade @if(route('user.sandsharing')==url()->current())show active @endif" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
        <div class="row">
          @if(count($sharing)>0)
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="mb-0">{{__('Transactions')}}</h3>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons2">
                    <thead>
                        <tr>
                        <th>{{__('S / N')}}</th>
                        <th></th>
                        <th>{{__('Ref ID')}}</th>
                        <th>{{__('Units')}}</th>
                        <th>{{__('Amount')}}</th>
                        <th>{{__('ROI')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Started')}}</th>
                        <th>{{__('End date')}}</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($sharing as $k=>$val)
                        <tr>
                            <td>{{++$k}}.</td>
                            <td><a href="{{route('view.sandplan', ['id' => $val->plan['slug']])}}">Plan</a></td>
                            <td>#{{$val->trx}}</td>
                            <td>{{$val->units}}</td>
                            <td>{{$currency->symbol.number_format($val->amount, '2', '.', '')}}</td>
                            <td>{{$currency->symbol.number_format($val->profit-$val->amount, '2', '.', '')}}</td>
                            <td>@if($val->status==1) Running @else Ended @endif</td>
                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                            <td>{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @else
            <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">You have no sharing history</p>
            </div>
          @endif
        </div>
      </div>
    </div>
@stop