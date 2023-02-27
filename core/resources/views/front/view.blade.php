@extends('frontlayout')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header py-5 py-lg-6 pt-lg-1">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{url('/')}}/asset/images/{{$plan->image}}" alt="Image placeholder">
                    <div class="card-body">
                        <span class="text-sm text-muted mb-0">{{$plan->original-$plan->units}} / {{$plan->original}}</span>
                        <div class="progress progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{(($plan->original-$plan->units)*100)/$plan->original}}%;"></div>
                        </div>
                        <h5 class="h2 card-title mb-0">{{$plan->name}}</h5>
                        <small class="text-muted text-uppercase">{{$plan->location}} - {{$plan->duration.' '.$plan->period}}(s)</small>
                        <div class="row justify-content-between align-items-center mb-3">
                            <div class="col-6">
                                <span class="form-text text-sm text-dark">{{__('Price')}}</span>
                                <span class="form-text text-xs text-muted">{{$currency->symbol.$plan->price}} @ 1 Unit</span>
                            </div>
                            <div class="col-6"> 
                                <span class="form-text text-sm text-dark">{{__('Profit Margin')}}</span>
                                <h4 class="mb-1 h1 text-primary">{{$plan->interest}}%</h4> 
                            </div>
                            <div class="col-6">
                                <span class="form-text text-sm text-dark">{{__('Opening Date')}}</span>
                                <span class="form-text text-xs text-muted">{{date("Y/m/d h:i:A", strtotime($plan->start_date))}}</span>
                            </div>
                            <div class="col-6"> 
                                <span class="form-text text-sm text-dark">{{__('Closing Date')}}</span>
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
                        <h5 class="h3 mb-0">{{__('Description')}}</h5>
                        </div>
                        <div class="col-4 text-right">
                        @if($plan->units>0)
                            @if($plan->start_date <= Carbon\Carbon::now()->isoFormat('M/D/Y') && $plan->expiring_date > Carbon\Carbon::now()->isoFormat('M/D/Y'))
                                <a href="{{route('user.plans')}}"  class="btn btn-sm btn-success">{{__('Purchase Units')}}</a>
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
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <a href="{{ url()->previous()}}"><i class="fad fa-long-arrow-alt-left"></i> Back</a>
        </div>
    </div>
</div>
@stop