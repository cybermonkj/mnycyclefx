@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                <div class="card-body">
                    <a  href="{{route('admin.sand.plan.create')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Create Plan')}}</a>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Plans')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th></th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Duration')}}</th>
                                    <th>{{__('Units')}}</th>
                                    <th>{{__('Interest')}}</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Location')}}</th>
                                    <th>{{__('Insurance')}}</th>
                                    <th>{{__('Start date')}}</th>
                                    <th>{{__('Expiring date')}}</th>
                                    <th>{{__('Status')}}</th>   
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($plan as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-chevron-circle-down"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a href="{{route('admin.sand.femail', ['id' => $val->id])}}" class="dropdown-item">{{__('Send email to Investors & Followers')}}</a>
                                                    <a href="{{route('admin.sand.plan.invest', ['id' => $val->id])}}" class="dropdown-item">{{__('Investors')}}</a>
                                                    <a href="{{route('admin.sand.plan.edit', ['id' => $val->id])}}" class="dropdown-item">{{__('Edit')}}</a>
                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item"><i class="fad fa-trash"></i> {{__('Delete')}}</a>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>   
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->duration.$val->period}}(s)</td>
                                    <td>{{$val->original-$val->units}}/{{$val->original}}</td>
                                    <td>{{$val->interest}}%</td>
                                    <td>{{$val->cated['name']}}</td>
                                    <td>{{$val->location}}</td>
                                    <td>@if($val->insurance==1) Yes @else No @endif</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->start_date))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</td>
                                    <td>
                                        @if($val->status==1)
                                            <span class="badge badge-pill badge-success">{{__('Active')}}</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">{{__('Disabled')}}</span>
                                        @endif
                                    </td>                 
                                </tr>
                                @endforeach               
                            </tbody>                    
                        </table>
                        @foreach($plan as $k=>$val)
                        <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card bg-white border-0 mb-0">
                                            <div class="card-header">
                                                <h3 class="mb-0 font-weight-bolder">{{__('Delete Plan')}}</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                <span class="mb-0 text-xs">{{__('Are you sure you want to delete this?')}}</span>
                                            </div>
                                            <div class="card-body">
                                                <a  href="{{route('sand.py.plan.delete', ['id' => $val->id])}}" class="btn btn-danger btn-block">{{__('Proceed')}}</a>
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
        </div>
    </div>
</div>
@stop