@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-12">
        <h6 class="h2 d-inline-block mb-0 font-weight-bolder">{{__('Project Investment')}}</h6>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.sandplans')==url()->current()) active @endif" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fal fa-sledding fa-lg"></i> {{__('ACTIVE')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.sandplanssoon')==url()->current()) active @endif" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-retweet"></i> {{__('COMING SOON')}}</a>
                    </li>                 
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.sandplansclosed')==url()->current()) active @endif" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fal fa-hourglass-end"></i> {{__('MATURED')}}</a>
                    </li>                     
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.sandfollowed')==url()->current()) active @endif" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="fal fa-user"></i> {{__('FOLLOWED')}}</a>
                    </li>   
                </ul>
            </div>
        </div>
      </div>          
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade @if(route('user.sandplans')==url()->current())show active @endif" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
            <div class="row">
                @if(count($open)>0)
                    @foreach($open as $val)
                        <div class="col-lg-4">
                            <div class="card">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <a href="{{route('view.sandplan', ['id' => $val->slug])}}">
                                                <h5 class="h2 card-title mb-0 font-weight-bolder">{{$val->name}}</h5>
                                            </a>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a data-toggle="modal" data-target="#share{{$val->id}}" title="share" href=""><i class="fal fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <span class="text-sm text-muted mb-0">{{$val->original-$val->units}} / {{$val->original}} Units Sold</span>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{(($val->original-$val->units)*100)/$val->original}}%;"></div>
                                    </div>
                                    <small class="text-muted">{{$val->location}}</small>
                                    <p class="text-sm text-dark mb-0"><span class="text-primary h3 font-weight-bolder">{{$val->interest}}%</span> Returns in {{$val->duration.' '.$val->period}}</p>
                                    <p class="text-sm text-dark mb-0"><span class="text-success h4 font-weight-bolder">{{$currency->symbol.$val->price}}</span> per Unit</p>
                                    <p class="text-sm text-dark mb-0">@if($val->ref_percent!=null){{$val->ref_percent}}% @else {{__('No')}} @endif{{__('Referral Bonus')}}</p> 
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-6">
                                            <span class="form-text text-sm text-dark">{{__('Opening Date')}}</span>
                                            <span class="form-text text-xs text-muted">{{date("Y/m/d h:i:A", strtotime($val->start_date))}}</span>
                                        </div>
                                        <div class="col-6"> 
                                            <span class="form-text text-sm text-dark">{{__('Maturity Date')}}</span>
                                            <span class="form-text text-sm text-muted">{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</span> 
                                        </div>
                                    </div>    
                                    @php
                                        $check=App\Models\Sandfollowed::whereplan_id($val->id)->whereuser_id($user->id)->count();     
                                        $ss=App\Models\Sandfollowed::whereplan_id($val->id)->whereuser_id($user->id)->first();     
                                    @endphp         
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-6 text-left"> 
                                            @if($check>0)
                                            <a href="{{route('unfollow', ['id' => $val->slug])}}" class="text-uppercase text-xs">unfollow<i class="fal fa-angle-right fa-sm ml-1"></i></a>
                                            @else
                                            <a href="{{route('follow', ['id' => $val->slug])}}" class="text-uppercase text-xs" title="follow plan">Follow<i class="fal fa-angle-right fa-sm ml-1"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="share{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                                            <input type="text" class="form-control" value="{{route('check.plan', ['id' => $val->slug])}}">   
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn-icon-clipboard text-xs" data-clipboard-text="{{route('check.plan', ['id' => $val->slug])}}" title="Copy to clipboard">Copy link</span>
                                            </div> 
                                            </div>
                                        </div>
                                        </div>
                                        <div class="text-center">
                                        {!! QrCode::eye('circle')->style('round')->size(250)->generate(route('check.plan', ['id' => $val->slug])); !!} 
                                        </div>      
                                        <div class="text-center mb-3 mt-3">
                                        <p>Scan QR code or Share using:</p>
                                        </div>                    
                                        <div class="text-center">      
                                        <a href="https://wa.me/?text={{route('check.plan', ['id' => $val->slug])}}" target="_blank" class="btn btn-slack btn-icon-only">
                                            <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                                        </a>                           
                                        <a href="mailto:?body={{route('check.plan', ['id' => $val->slug])}}" class="btn btn-twitter btn-icon-only">
                                            <span class="btn-inner--icon"><i class="fal fa-envelope"></i></span>
                                        </a>                                                  
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
                                    <span class="btn-inner--icon"><i class="fal fa-sad-tear fa-4x"></i></span>
                                </a>
                            </div>
                            <h3 class="text-dark">No Project found</h3>
                            <p class="text-dark text-sm card-text">We couldn't find any investment plans</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>      
        <div class="tab-pane fade @if(route('user.sandplanssoon')==url()->current())show active @endif" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
            <div class="row">
                @if(count($coming)>0)
                    @foreach($coming as $val)
                        <div class="col-lg-4">
                            <div class="card">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <a href="{{route('view.sandplan', ['id' => $val->slug])}}">
                                                <h5 class="h2 card-title mb-0 font-weight-bolder">{{$val->name}}</h5>
                                            </a>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a data-toggle="modal" data-target="#share{{$val->id}}" title="share" href=""><i class="fal fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <span class="text-sm text-muted mb-0">{{$val->original-$val->units}} / {{$val->original}} Units Sold</span>
                                    <div class="progress progress mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{(($val->original-$val->units)*100)/$val->original}}%;"></div>
                                    </div>
                                    <small class="text-muted">{{$val->location}}</small>
                                    <p class="text-sm text-dark mb-0"><span class="text-primary h3 font-weight-bolder">{{$val->interest}}%</span> Returns in {{$val->duration.' '.$val->period}}</p>
                                    <p class="text-sm text-dark mb-0"><span class="text-success h4 font-weight-bolder">{{$currency->symbol.$val->price}}</span> per Unit</p>
                                    <p class="text-sm text-dark mb-0">@if($val->ref_percent!=null){{$val->ref_percent}}% @else {{__('No')}} @endif{{__('Referral Bonus')}}</p>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-6">
                                            <span class="form-text text-sm text-dark">{{__('Opening Date')}}</span>
                                            <span class="form-text text-xs text-muted">{{date("Y/m/d h:i:A", strtotime($val->start_date))}}</span>
                                        </div>
                                        <div class="col-6"> 
                                            <span class="form-text text-sm text-dark">{{__('Maturity Date')}}</span>
                                            <span class="form-text text-sm text-muted">{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</span> 
                                        </div>
                                    </div>  
                                    @php
                                        $check=App\Models\Sandfollowed::whereplan_id($val->id)->whereuser_id($user->id)->count();     
                                        $ss=App\Models\Sandfollowed::whereplan_id($val->id)->whereuser_id($user->id)->first();     
                                    @endphp         
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-6 text-left"> 
                                            @if($check>0)
                                            <a href="{{route('unfollow', ['id' => $val->slug])}}" class="text-uppercase text-xs">unfollow<i class="fal fa-angle-right fa-sm ml-1"></i></a>
                                            @else
                                            <a href="{{route('follow', ['id' => $val->slug])}}" class="text-uppercase text-xs" title="follow plan">follow<i class="fal fa-angle-right fa-sm ml-1"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="share{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                                            <input type="text" class="form-control" value="{{route('check.plan', ['id' => $val->slug])}}">   
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn-icon-clipboard text-xs" data-clipboard-text="{{route('check.plan', ['id' => $val->slug])}}" title="Copy to clipboard">Copy link</span>
                                            </div> 
                                            </div>
                                        </div>
                                        </div>
                                        <div class="text-center">
                                        {!! QrCode::eye('circle')->style('round')->size(250)->generate(route('check.plan', ['id' => $val->slug])); !!} 
                                        </div>      
                                        <div class="text-center mb-3 mt-3">
                                        <p>Scan QR code or Share using:</p>
                                        </div>                    
                                        <div class="text-center">      
                                        <a href="https://wa.me/?text={{route('check.plan', ['id' => $val->slug])}}" target="_blank" class="btn btn-slack btn-icon-only">
                                            <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                                        </a>                           
                                        <a href="mailto:?body={{route('check.plan', ['id' => $val->slug])}}" class="btn btn-twitter btn-icon-only">
                                            <span class="btn-inner--icon"><i class="fal fa-envelope"></i></span>
                                        </a>                                                  
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
                                    <span class="btn-inner--icon"><i class="fal fa-sad-tear fa-4x"></i></span>
                                </a>
                            </div>
                            <h3 class="text-dark">No Project found</h3>
                            <p class="text-dark text-sm card-text">We couldn't find any investment plans</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="tab-pane fade @if(route('user.sandplansclosed')==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
            <div class="row">
                @if(count($closed)>0)
                    @foreach($closed as $val)
                        <div class="col-lg-4">
                            <div class="card">
                                <!-- Card image -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <a href="{{route('view.sandplan', ['id' => $val->slug])}}">
                                                <h5 class="h2 card-title mb-0 font-weight-bolder">{{$val->name}}</h5>
                                            </a>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a data-toggle="modal" data-target="#share{{$val->id}}" title="share" href=""><i class="fal fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <span class="text-sm text-muted mb-0">{{$val->original-$val->units}} / {{$val->original}} Units Sold</span>
                                    <div class="progress progress mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{(($val->original-$val->units)*100)/$val->original}}%;"></div>
                                    </div>
                                    <small class="text-muted">{{$val->location}}</small>
                                    <p class="text-sm text-dark mb-0"><span class="text-primary h3 font-weight-bolder">{{$val->interest}}%</span> Returns in {{$val->duration.' '.$val->period}}</p>
                                    <p class="text-sm text-dark mb-0"><span class="text-success h4 font-weight-bolder">{{$currency->symbol.$val->price}}</span> per Unit</p>
                                    <p class="text-sm text-dark mb-0">@if($val->ref_percent!=null){{$val->ref_percent}}% @else {{__('No')}} @endif{{__('Referral Bonus')}}</p>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-6">
                                            <span class="form-text text-sm text-dark">{{__('Opening Date')}}</span>
                                            <span class="form-text text-xs text-muted">{{date("Y/m/d h:i:A", strtotime($val->start_date))}}</span>
                                        </div>
                                        <div class="col-6"> 
                                            <span class="form-text text-sm text-dark">{{__('Maturity Date')}}</span>
                                            <span class="form-text text-sm text-muted">{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</span> 
                                        </div>
                                    </div>     
                                    @php
                                        $check=App\Models\Sandfollowed::whereplan_id($val->id)->whereuser_id($user->id)->count();     
                                        $ss=App\Models\Sandfollowed::whereplan_id($val->id)->whereuser_id($user->id)->first();     
                                    @endphp         
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-6 text-left"> 
                                            @if($check>0)
                                            <a href="{{route('unfollow', ['id' => $val->slug])}}" class="text-uppercase text-xs">unfollow<i class="fal fa-angle-right fa-sm ml-1"></i></a>
                                            @else
                                            <a href="{{route('follow', ['id' => $val->slug])}}" class="text-uppercase text-xs" title="follow plan">Follow<i class="fal fa-angle-right fa-sm ml-1"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="share{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                                            <input type="text" class="form-control" value="{{route('check.plan', ['id' => $val->slug])}}">   
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn-icon-clipboard text-xs" data-clipboard-text="{{route('check.plan', ['id' => $val->slug])}}" title="Copy to clipboard">Copy link</span>
                                            </div> 
                                            </div>
                                        </div>
                                        </div>
                                        <div class="text-center">
                                        {!! QrCode::eye('circle')->style('round')->size(250)->generate(route('check.plan', ['id' => $val->slug])); !!} 
                                        </div>      
                                        <div class="text-center mb-3 mt-3">
                                        <p>Scan QR code or Share using:</p>
                                        </div>                    
                                        <div class="text-center">      
                                        <a href="https://wa.me/?text={{route('check.plan', ['id' => $val->slug])}}" target="_blank" class="btn btn-slack btn-icon-only">
                                            <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                                        </a>                           
                                        <a href="mailto:?body={{route('check.plan', ['id' => $val->slug])}}" class="btn btn-twitter btn-icon-only">
                                            <span class="btn-inner--icon"><i class="fal fa-envelope"></i></span>
                                        </a>                                                  
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
                                    <span class="btn-inner--icon"><i class="fal fa-sad-tear fa-4x"></i></span>
                                </a>
                            </div>
                            <h3 class="text-dark">No Project found</h3>
                            <p class="text-dark text-sm card-text">We couldn't find any investment plans</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>        
        <div class="tab-pane fade @if(route('user.sandfollowed')==url()->current())show active @endif" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
            <div class="row">
                @if(count($followed)>0) 
                    @foreach($followed as $val)
                        <div class="col-lg-4">
                            <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <a href="{{route('view.sandplan', ['id' => $val->plan['slug']])}}">
                                            <h5 class="h2 card-title mb-0 font-weight-bolder">{{$val->plan['name']}}</h5>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a data-toggle="modal" data-target="#fshare{{$val->plan['id']}}" title="share" href=""><i class="fal fa-external-link"></i></a>
                                    </div>
                                </div>
                                <span class="text-sm text-muted mb-0">{{$val->plan['original']-$val->plan['units']}} / {{$val->plan['original']}} Units Sold</span>
                                <div class="progress progress mb-3">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{(($val->plan['original']-$val->plan['units'])*100)/$val->plan['original']}}%;"></div>
                                </div>
                                <small class="text-muted">{{$val->plan['location']}} - {{$val->plan['duration'].' '.$val->plan['period']}}</small>
                                <p class="text-sm text-dark mb-0"><span class="text-primary h3 font-weight-bolder">{{$val->plan['interest']}}%</span> Returns in {{$val->plan['duration'].' '.$val->plan['period']}}</p>
                                <p class="text-sm text-dark mb-0"><span class="text-success h4 font-weight-bolder">{{$currency->symbol.$val->plan['price']}}</span> per Unit</p>
                                <p class="text-sm text-dark mb-0">@if($val->plan['ref_percent']!=null){{$val->plan['ref_percent']}}% @else {{__('No')}} @endif{{__('Referral Bonus')}}</p>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-6">
                                        <span class="form-text text-sm text-dark">{{__('Opening Date')}}</span>
                                        <span class="form-text text-xs text-muted">{{date("Y/m/d h:i:A", strtotime($val->plan['start_date']))}}</span>
                                    </div>
                                    <div class="col-6"> 
                                        <span class="form-text text-sm text-dark">{{__('Maturity Date')}}</span>
                                        <span class="form-text text-sm text-muted">{{date("Y/m/d h:i:A", strtotime($val->plan['expiring_date']))}}</span> 
                                    </div>
                                </div>    
                                @php
                                    $check=App\Models\Sandfollowed::whereplan_id($val->plan['id'])->whereuser_id($user->id)->get();     
                                    $ss=App\Models\Sandfollowed::whereplan_id($val->plan['id'])->whereuser_id($user->id)->first();     
                                @endphp 
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-6 text-left"> 
                                    @if(count($check)>0)
                                        <a href="{{route('unfollow', ['id' => $val->plan['slug']])}}" class="text-uppercase text-xs">unfollow<i class="fad fa-angle-right fa-sm ml-1"></i></a>
                                    @endif
                                    </div>
                                </div>        
                            </div>
                            </div>
                        </div>
                        <div class="modal fade" id="fshare{{$val->plan['id']}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                                            <input type="text" class="form-control" value="{{route('check.plan', ['id' => $val->plan['slug']])}}">   
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn-icon-clipboard text-xs" data-clipboard-text="{{route('check.plan', ['id' => $val->plan['slug']])}}" title="Copy to clipboard">Copy link</span>
                                            </div> 
                                            </div>
                                        </div>
                                        </div>
                                        <div class="text-center">
                                        {!! QrCode::eye('circle')->style('round')->size(250)->generate(route('check.plan', ['id' => $val->plan['slug']])); !!} 
                                        </div>      
                                        <div class="text-center mb-3 mt-3">
                                        <p>Scan QR code or Share using:</p>
                                        </div>                    
                                        <div class="text-center">      
                                        <a href="https://wa.me/?text={{route('check.plan', ['id' => $val->plan['slug']])}}" target="_blank" class="btn btn-slack btn-icon-only">
                                            <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                                        </a>                           
                                        <a href="mailto:?body={{route('check.plan', ['id' => $val->plan['slug']])}}" class="btn btn-twitter btn-icon-only">
                                            <span class="btn-inner--icon"><i class="fal fa-envelope"></i></span>
                                        </a>                                                  
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
                                <span class="btn-inner--icon"><i class="fal fa-sad-tear fa-4x"></i></span>
                            </a>
                        </div>
                        <h3 class="text-dark">No Plans</h3>
                        <p class="text-dark text-sm card-text">{{__('You have not followed any plan')}}</p>
                    </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
  </div>
</div>
@stop