@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="modal fade" id="share{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="mb-0 font-weight-bolder">{{__('Share')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form>
                        <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="input-group">
                            <input type="text" class="form-control" value="{{route('check.plan', ['id' => $plan->slug])}}">   
                            <div class="input-group-prepend">
                                <span class="input-group-text btn-icon-clipboard text-xs" data-clipboard-text="{{route('check.plan', ['id' => $plan->slug])}}" title="Copy to clipboard">Copy link</span>
                            </div> 
                            </div>
                        </div>
                        </div>
                        <div class="text-center">
                        {!! QrCode::eye('circle')->style('round')->size(250)->generate(route('check.plan', ['id' => $plan->slug])); !!} 
                        </div>      
                        <div class="text-center mb-3 mt-3">
                        <p>Scan QR code or Share using:</p>
                        </div>                    
                        <div class="text-center">      
                        <a href="https://wa.me/?text={{route('check.plan', ['id' => $plan->slug])}}" target="_blank" class="btn btn-slack btn-icon-only">
                            <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                        </a>                           
                        <a href="mailto:?body={{route('check.plan', ['id' => $plan->slug])}}" class="btn btn-twitter btn-icon-only">
                            <span class="btn-inner--icon"><i class="fal fa-envelope"></i></span>
                        </a>                                                  
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{url('/')}}/asset/images/{{$plan->image}}" alt="Image placeholder">
                    <div class="card-body">
                        <span class="text-sm text-muted mb-0">{{$plan->original-$plan->units}} / {{$plan->original}} Units Sold</span>
                        <div class="progress progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{(($plan->original-$plan->units)*100)/$plan->original}}%;"></div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h5 class="h2 card-title mb-0 font-weight-bolder">{{$plan->name}}</h5>
                            </div>
                            <div class="col-4 text-right">
                                <a data-toggle="modal" data-target="#share{{$plan->id}}" title="share" href=""><i class="fal fa-external-link"></i></a>
                            </div>
                        </div>
                        <small class="text-muted">{{$plan->location}}</small>
                        <p class="text-sm text-dark mb-0"><span class="text-primary h3 font-weight-bolder">{{$plan->interest}}%</span> Returns in {{$plan->duration.' '.$plan->period}}</p>
                        <p class="text-sm text-dark mb-0"><span class="text-success h4 font-weight-bolder">{{$currency->symbol.$plan->price}}</span> per Unit</p>
                        <p class="text-sm text-dark mb-0">@if($plan->ref_percent!=null){{$plan->ref_percent}}% @else {{__('No')}} @endif{{__('Referral Bonus')}}</p>
                        <div class="row justify-content-between align-items-center mb-3">
                            <div class="col-6">
                                <span class="form-text text-sm text-dark">{{__('Opening Date')}}</span>
                                <span class="form-text text-xs text-muted">{{date("Y/m/d h:i:A", strtotime($plan->start_date))}}</span>
                            </div>
                            <div class="col-6"> 
                                <span class="form-text text-sm text-dark">{{__('Maturity Date')}}</span>
                                <span class="form-text text-sm text-muted">{{date("Y/m/d h:i:A", strtotime($plan->expiring_date))}}</span> 
                            </div>
                        </div>             
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                        <h5 class="h3 mb-0 font-weight-bolder">{{__('Description')}}</h5>
                        </div>
                        <div class="col-4 text-right">
                        @if($plan->units>0)
                            @if($plan->start_date <= Carbon\Carbon::now()->toDateTimeLocalString() && $plan->expiring_date > Carbon\Carbon::now()->toDateTimeLocalString())
                                <a href="#" data-toggle="modal" data-target="#buy{{$plan->id}}"   class="btn btn-sm btn-primary">Purchase Units</a>
                            @endif
                        @endif
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                    <p class="card-text text-sm mb-4">{!!$plan->description!!}</p>
                        <div class="row">
                            <div class="col-4">
                            @php
                            $category=App\Models\Sandplancategory::whereid($plan->cat_id)->first();
                            @endphp
                                <span class="form-text text-sm text-muted">{{__('Category')}}: {{$category->name}}</span>
                            </div>
                            <div class="col-4"> 
                                <span class="form-text text-sm text-muted">{{__('Insurance')}}: @if($plan->insurance==1) {{__('Yes')}} @else {{__('No')}} @endif</span> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="mb-0">{{__('Plan Updates')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                        <thead>
                            <tr>
                            <th>{{__('S / N')}}</th>
                            <th>{{__('Information')}}</th>
                            <th>{{__('Report')}}</th>
                            <th>{{__('Activity')}}</th>
                            <th>{{__('Stage')}}</th>
                            <th>{{__('Weeks')}}</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>  
                            @foreach($updates as $k=>$val)
                            <tr>
                                <td>{{++$k}}.</td>
                                <td>{{str_limit($val->information, 10)}}</td>
                                <td>{{str_limit($val->report, 10)}}</td>
                                <td>{{str_limit($val->activity, 10)}}</td>
                                <td>{{$val->stage}}</td>
                                <td>{{$val->weeks}}</td>
                                <td><a href="{{route('view.sandplan.update', ['id' => $val->id])}}"><i class="fa fa-eye"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="mb-0">{{__('Your Investments')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                        <thead>
                            <tr>
                            <th>{{__('S / N')}}</th>
                            <th>{{__('Reference ID')}}</th>
                            <th>{{__('Units')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Profit')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Created')}}</th>
                            <th>{{__('Updated')}}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @foreach($profit as $k=>$val)
                            <tr>
                                <td>{{++$k}}.</td>
                                <td>#{{$val->trx}}</td>
                                <td>{{$val->units}}</td>
                                <td>{{$currency->symbol.number_format($val->amount)}}</td>
                                <td>{{$currency->symbol.number_format($val->profit)}}</td>
                                <td>@if($val->status==1) Running @else Ended @endif</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="buy{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-body p-0">
            <div class="card border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
                <div class="text-dark text-center mt-2 mb-3"><small>{{__('Purchase plan')}}</small></div>
                <div class="btn-wrapper text-center">
                <h4 class="text-uppercase ls-1 text-dark py-3 mb-0">{{$plan->name}}</h4>
                </div>
            </div>
            <div class="card-body">
                <form role="form" action="{{route('user.sandcheck_plan')}}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">#</span>
                    </div>
                    <input type="number" class="form-control" placeholder="{{__('Units')}}" id="units" name="units" onkeyup="buycharge()"max="{{$plan->units}}" required>
                    <input type="hidden" name="plan" value="{{$plan->id}}">
                    <input type="hidden" name="price" id="price" value="{{$plan->price}}">
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-lg-12">
                    <select class="form-control select" name="type" required>
                        <option value="">{{__('Debit From')}}</option>
                        <option value="1">{{__('Profit')}} - {{$currency->symbol.number_format($user->profit)}}</option>
                        <option value="2">{{__('Account balance')}} - {{$currency->symbol.number_format($user->balance)}}</option>
                        <option value="3">{{__('Referral earnings')}} - {{$currency->symbol.number_format($user->ref_bonus)}}</option>
                    </select>
                    </div>
                </div>     
                <div class="custom-control custom-control-alternative custom-checkbox mb-5">
                    <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="terms" checked required>
                    <label class="custom-control-label" for=" customCheckLogin">
                            <p class="text-muted">This transaction requires your consent before continuing. Read <a href="{{route('terms')}}">Terms & Conditions</a></p>
                    </label>
                </div>                                               
                <div class="text-center">
                    <button type="submit" class="btn btn-neutral btn-block">{{__('Purchase')}} <span id="cardresult"></span></button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@stop