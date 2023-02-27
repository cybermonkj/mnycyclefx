@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                <div class="card-body">
                    <a data-toggle="modal" data-target="#create" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Create Category')}}</a>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Category')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Status')}}</th>                                                                       
                                    <th>{{__('Created')}}</th>
                                    <th>{{__('Updated')}}</th>
                                    <th class="text-center">{{__('Action')}}</th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($profit as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->name}}</td>
                                    <td>
                                        @if($val->status==0)
                                        {{__('Disabled')}}
                                        @elseif($val->status==1)
                                        {{__('Active ')}}
                                        @endif
                                    </td>  
                                    <td>{{date("Y/m/d hiA", strtotime($val->created_at))}}</td>  
                                    <td>{{date("Y/m/d hiA", strtotime($val->updated_at))}}</td>
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="btn btn-sm btn-danger"><i class="fad fa-trash"></i> {{__('Delete')}}</a>
                                        <a data-toggle="modal" data-target="#update{{$val->id}}" href="" class="btn btn-sm btn-primary"><i class="fad fa-edit"></i> {{__('Edit')}}</a>
                                        @if($val->status==1)
                                            <a class='btn btn-sm btn-danger' href="{{route('category.unpublish', ['id' => $val->id])}}"><i class="fad fa-ban"></i> {{__('Disable')}}</a>
                                        @else
                                            <a class='btn btn-sm btn-success' href="{{route('category.publish', ['id' => $val->id])}}"><i class="fad fa-check"></i> {{__('Enable')}}</a>
                                        @endif
                                    </td>                   
                                </tr>
                                <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <a  href="{{route('py.category.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div id="update{{$val->id}}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">   
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{url('admin/sand-py-category-edit')}}" method="post">
                                            @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-2">{{__('Name')}}</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" name="name" class="form-control" value="{{$val->code}}">
                                                            <input type="hidden" name="id" value="{{$val->id}}">
                                                        </div>
                                                    </div>                                                                   
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                    <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach               
                            </tbody>                    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="create" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">   
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('admin/py-category-create')}}" method="post">
            @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Name')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>                                                                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop