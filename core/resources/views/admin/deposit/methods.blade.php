@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Email Settings')}}</h3>
                        <small>You can use this code to edit your deposit messages. Don't use any code that is not on this table, else your emails to clients will have &#123;&#123;tags&#125;&#125; on it</small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>CODE</th>
                                        <th>DESCRIPTION</th>
                                        <th>Type</th>
                                        <th>Required</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1. </td>
                                    <td> &#123;&#123;amount&#125;&#125;</td>
                                    <td> Transaction amount</td>
                                    <td> Float</td>
                                    <td> No</td>
                                </tr>                                
                                <tr>
                                    <td> 2. </td>
                                    <td> &#123;&#123;charge&#125;&#125;</td>
                                    <td> Charge for processing withdrawal</td>
                                    <td> Float</td>
                                    <td> No</td>
                                </tr>
                                <tr>
                                    <td> 3. </td>
                                    <td> &#123;&#123;first_name&#125;&#125; </td>
                                    <td> Client first name</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                 
                                <tr>
                                    <td> 4. </td>
                                    <td> &#123;&#123;last_name&#125;&#125; </td>
                                    <td> Client last name</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                 
                                <tr>
                                    <td> 5. </td>
                                    <td> &#123;&#123;username&#125;&#125; </td>
                                    <td> Client username</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                    
                                <tr>
                                    <td> 6. </td>
                                    <td> &#123;&#123;site_name&#125;&#125; </td>
                                    <td> Your Website name</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                               
                                <tr>
                                    <td> 7. </td>
                                    <td> &#123;&#123;site_email&#125;&#125; </td>
                                    <td> Your Website email</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                                                                                                      
                                <tr>
                                    <td> 8. </td>
                                    <td> &#123;&#123;reference&#125;&#125; </td>
                                    <td> Transaction reference</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>
                                </tbody>                    
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Email Messages')}}</h3>
                        <small>Don't use wrong email tags, as it will be displayed as &#123;&#123;random&#125;&#125; in email with no outputed content from database, you don't want that, so take your time to read what you are typing</small>
                    </div>
                    <div class="card-body">                 
                        <form action="{{route('admin.depositemail.update')}}" method="post">
                            @csrf         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 h4">{{__('Approve Deposit Request')}}</label>
                                    <div class="col-lg-12 mb-4">
                                        <input type="text" name="subject" value="{{$email1->subject}}" class="form-control" required>
                                        <input type="hidden" value="deposit_request_approve" name="type">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea type="text" name="body" rows="2" class="form-control" required>{{$email1->body}}</textarea>
                                    </div>
                                </div>                 
                                <div class="text-left">
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Update')}}</button>
                                </div>
                        </form>                        
                        <hr>                   
                        <form action="{{route('admin.depositemail.update')}}" method="post">
                            @csrf         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 h4">{{__('Decline Deposit Request')}}</label>
                                    <div class="col-lg-12 mb-4">
                                        <input type="text" name="subject" value="{{$email2->subject}}" class="form-control" required>
                                        <input type="hidden" value="deposit_request_decline" name="type">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea type="text" name="body" rows="2" class="form-control" required>{{$email2->body}}</textarea>
                                    </div>
                                </div>                 
                                <div class="text-left">
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Update')}}</button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Automated Gateways')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th>{{__('Main name')}}</th>
                                    <th>{{__('Name for users')}}</th>
                                    <th>{{__('Min')}}</th>
                                    <th>{{__('Max')}}</th>
                                    <th>{{__('Charge')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Updated')}}</th>
                                    <th class="text-center"></th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($gateway as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->main_name}}</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$currency->symbol.$val->minamo}}</td>
                                    <td>{{$currency->symbol.$val->maxamo}}</td>
                                    <td>@if($val->percent_charge!=null){{$val->percent_charge}}% @else 0% @endif + @if($val->fiat_charge!=null){{$val->fiat_charge.' '.$currency->name}} @else 0 {{$currency->name}} @endif</td>
                                    <td>
                                        @if($val->status==0)
                                            <span class="badge badge-danger badge-pill">{{__('Disabled')}}</span>
                                        @elseif($val->status==1)
                                            <span class="badge badge-success badge-pill">{{__('Active')}}</span> 
                                        @endif
                                    </td>  
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                    <td class="text-center">
                                    <a data-toggle="modal" data-target="#edit{{$val->id}}" class="btn btn-primary btn-sm text-white" >
                                        {{__('Edit')}}
                                    </a>
                                    </td>                   
                                </tr>
                                <div id="edit{{$val->id}}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{$val->main_name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{url('admin/storegateway')}}" method="post">
                                            @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label class="col-form-label">{{__('Name of gateway for users')}}</label>
                                                                <input value="{{$val->id}}"type="hidden" name="id">
                                                                <input type="text" value="{{$val->name}}" name="name" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label class="col-form-label">{{__('Minimum Amount')}}</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                        <span class="input-group-text">{{$currency->symbol}}</span>
                                                                    </span>
                                                                    <input type="number" name="minamo" maxlength="10" class="form-control"value="{{$val->minamo}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="col-form-label">{{__('Maximum Amount')}}</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                        <span class="input-group-text">{{$currency->symbol}}</span>
                                                                    </span>
                                                                    <input type="number" name="maxamo" maxlength="10" class="form-control"value="{{$val->maxamo}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label class="col-form-label">{{__('Fiat Charge [Not Required]')}}</label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend">
                                                                    <span class="input-group-text">{{$currency->symbol}}</span>
                                                                </span>
                                                                <input type="number" step="any"  name="fiat_charge" value="{{$val->fiat_charge}}" class="form-control">
                                                            </div>
                                                        </div>  
                                                        <div class="col-lg-6">
                                                            <label class="col-form-label">{{__('Percent Charge [Not Required]')}}</label>
                                                            <div class="input-group">
                                                                <input type="number" step="any"  name="percent_charge" value="{{$val->percent_charge}}" class="form-control">
                                                                <span class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </span>
                                                            </div>
                                                        </div>                                  
                                                    </div>                          
                                                    @if($val->id==101)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('PAYPAL BUSINESS EMAIL')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    @elseif($val->id==102)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Perfect Money USD account')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Alternate passphrase')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif($val->id==103)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Publishable key')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif($val->id==104)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Merchant email')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        @elseif($val->id==107)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Public key')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        @elseif($val->id==108)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Public key')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif($val->id==501)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Api key')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Xpub code')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif($val->id==505)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Public key')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Private key')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>                                                      
                                                        @elseif($val->id==506)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Public key')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Private key')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        @elseif($val->id==507)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('API key')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>                                                       
                                                        @elseif($val->id==508)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Public Key')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Secret Key')}}</label>
                                                                    <input type="text" value="{{$val->val2}}" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Merchant Key')}}</label>
                                                                    <input type="text" value="{{$val->val3}}" class="form-control" id="val3" name="val3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label">{{__('Payment Details')}}</label>
                                                                    <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label class="col-form-label">{{__('Status')}}</label>
                                                            <select class="form-control select" name="status">
                                                                <option value="1" 
                                                                    @if($val->status==1)
                                                                        selected
                                                                    @endif
                                                                    >{{__('Active')}}
                                                                </option>
                                                                <option value="0"  
                                                                    @if($val->status==0)
                                                                        selected
                                                                    @endif
                                                                    >{{__('Deactive')}}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        @if($val->id==505 || $val->id==506)
                                                            <ol>
                                                                <li>Ensure the coin you want to receive is added to your coin payment accepted coins on the API key page, ensure certain permissions are checked</li>
                                                                <li>create_transaction</li>
                                                                <li>get_tx_info</li>
                                                                <li>get_callback_address</li>
                                                                <li>rates</li>
                                                                <li>create_transfer</li>
                                                            </ol>
                                                        @endif
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                    <button type="submit" class="btn btn-success btn-sm">{{__('Save changes')}}</button>
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
                <a href="" data-toggle="modal" data-target="#create" class="btn btn-sm btn-neutral mb-5"><i class="fad fa-plus"></i> {{__('Add Manual Gateway')}}</a>   
                <div id="create" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create Gateway</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form action="{{url('admin/creategateway2')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">{{__('Name of gateway for users')}}</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">{{__('Minimum Amount')}}</label>
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">{{$currency->symbol}}</span>
                                                    </span>
                                                    <input type="number" name="minamo" maxlength="10" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="col-form-label">{{__('Maximum Amount')}}</label>
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">{{$currency->symbol}}</span>
                                                    </span>
                                                    <input type="number" name="maxamo" maxlength="10" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-form-label">{{__('Fiat Charge [Not Required]')}}</label>
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text">{{$currency->symbol}}</span>
                                                </span>
                                                <input type="number" step="any"  name="fiat_charge" class="form-control">
                                            </div>
                                        </div>  
                                        <div class="col-lg-6">
                                            <label class="col-form-label">{{__('Percent Charge [Not Required]')}}</label>
                                            <div class="input-group">
                                                <input type="number" step="any"  name="percent_charge"  class="form-control">
                                                <span class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </span>
                                            </div>
                                        </div>                                  
                                    </div>                                                                                  
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">{{__('Payment Details')}}</label>
                                                <input type="text" class="form-control" id="val1" name="val1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Save changes')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>             
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Manual Gateways')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons2">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Min')}}</th>
                                    <th>{{__('Max')}}</th>
                                    <th>{{__('Charge')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Updated')}}</th>
                                    <th class="text-center"></th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($manual as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$currency->symbol.$val->minamo}}</td>
                                    <td>{{$currency->symbol.$val->maxamo}}</td>
                                    <td>@if($val->percent_charge!=null){{$val->percent_charge}}% @else 0% @endif + @if($val->fiat_charge!=null){{$val->fiat_charge.' '.$currency->name}} @else 0 {{$currency->name}} @endif</td>
                                    <td>
                                        @if($val->status==0)
                                            <span class="badge badge-danger badge-pill">{{__('Disabled')}}</span>
                                        @elseif($val->status==1)
                                            <span class="badge badge-success badge-pill">{{__('Active')}}</span> 
                                        @endif
                                    </td>  
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                    <td class="text-center">
                                    <a data-toggle="modal" data-target="#edit{{$val->id}}" href=""class="btn btn-primary btn-sm">{{__('Edit')}}</a>
                                    <a href="{{route('gateway.delete', ['id'=>$val->id])}}"class="btn btn-danger btn-sm">{{__('Delete')}}</a>
                                    </td>                   
                                </tr>
                                @endforeach               
                            </tbody>                    
                        </table>
                        @foreach($manual as $k=>$val)
                        <div id="edit{{$val->id}}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{$val->main_name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{url('admin/storegateway2')}}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label">{{__('Name of gateway for users')}}</label>
                                                        <input value="{{$val->id}}"type="hidden" name="id">
                                                        <input type="text" value="{{$val->name}}" name="name" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">{{__('Minimum Amount')}}</label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend">
                                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                                            </span>
                                                            <input type="number" name="minamo" maxlength="10" class="form-control"value="{{$val->minamo}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">{{__('Maximum Amount')}}</label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend">
                                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                                            </span>
                                                            <input type="number" name="maxamo" maxlength="10" class="form-control"value="{{$val->maxamo}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">{{__('Fiat Charge [Not Required]')}}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                                        </span>
                                                        <input type="number" step="any"  name="fiat_charge" value="{{$val->fiat_charge}}" class="form-control">
                                                    </div>
                                                </div>  
                                                <div class="col-lg-6">
                                                    <label class="col-form-label">{{__('Percent Charge [Not Required]')}}</label>
                                                    <div class="input-group">
                                                        <input type="number" step="any"  name="percent_charge" value="{{$val->percent_charge}}" class="form-control">
                                                        <span class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                        </span>
                                                    </div>
                                                </div>                                  
                                            </div>                                                                                  
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label">{{__('Payment Details')}}</label>
                                                        <input type="text" value="{{$val->val1}}" class="form-control" id="val1" name="val1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('Status')}}</label>
                                                <select class="form-control select" name="status">
                                                    <option value="1" 
                                                        @if($val->status==1)
                                                            selected
                                                        @endif
                                                        >{{__('Active')}}
                                                    </option>
                                                    <option value="0"  
                                                        @if($val->status==0)
                                                            selected
                                                        @endif
                                                        >{{__('Deactive')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                            <button type="submit" class="btn btn-success btn-sm">{{__('Save changes')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Bank Transfer Details')}}</h3>
                        <p class="card-text text-sm">{{__('Last updated')}}: {{date("Y/m/d h:i:A", strtotime($bank->updated_at))}}</p>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/bankdetails')}}" method="post">
                        @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Name')}}</label>
                                <div class="col-lg-10">
                                <input type="text" name="name" class="form-control" value="{{$bank->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Bank name')}}</label>
                                <div class="col-lg-10">
                                <input type="text" name="bank_name" class="form-control" value="{{$bank->bank_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Bank address')}}</label>
                                <div class="col-lg-10">
                                <input type="text" name="address" class="form-control" value="{{$bank->address}}">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('IBAN code')}}</label>
                                <div class="col-lg-10">
                                <input type="text" name="iban" class="form-control" value="{{$bank->iban}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('SWIFT code')}}</label>
                                <div class="col-lg-10">
                                <input type="text" name="swift" class="form-control" value="{{$bank->swift}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Account number')}}</label>
                                <div class="col-lg-10">
                                <input type="number" name="acct_no" class="form-control" value="{{$bank->acct_no}}">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <div class="col-lg-5"> 
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        @if($bank->status==1)
                                            <input type="checkbox" name="status" id="customCheckLogin" class="custom-control-input" value="1" checked>
                                        @else
                                            <input type="checkbox" name="status" id="customCheckLogin"  class="custom-control-input" value="1">
                                        @endif
                                        <label class="custom-control-label" for="customCheckLogin">
                                        <span class="text-muted">{{__('Status')}}</span>     
                                        </label>
                                    </div> 
                                </div> 
                            </div>               
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@stop