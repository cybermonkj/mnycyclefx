@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">{{ __('Currency')}}</h3>
            </div>
            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-buttons">
                    <thead>
                        <tr>
                            <th>{{ __('S/N')}}</th>
                            <th>{{ __('Name')}}</th>
                            <th>{{ __('Country')}}</th>
                            <th>{{ __('Symbol')}}</th>
                            <th>{{ __('Status')}}</th>
                            <th class="text-center"></th>    
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cur as $k=>$val)
                        <tr>
                            <td>{{++$k}}.</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->country}}</td>
                            <td>{{$val->symbol}}</td>
                            <td>                                    
                                @if($val->status==1)
                                    <span class="badge badge-success">{{ __('Active')}}</span>
                                @else
                                    <span class="badge badge-danger">{{ __('Pending')}}</span>
                                @endif
                            </td>                               
                            <td class="text-center">
                                @if($val->status==0)
                                    <a class='btn btn-success btn-sm' href="{{route('change.currency', ['id' => $val->id])}}">{{ __('Set as default')}}</a>
                                @endif
                            </td>                 
                        </tr>
                        @endforeach               
                    </tbody>                    
                </table>
            </div>
        </div>
@stop