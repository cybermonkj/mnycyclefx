@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-lg-10">
        <h6 class="h2 d-inline-block mb-0">{{__('Disputes')}}</h6>
      </div>
      <div class="col-lg-2 text-right">
        <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fal fa-flag"></i> {{__('Raise a Dispute')}}</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="mb-0 h3">{{__('Open Ticket')}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('submit-ticket')}}" method="post">
                  @csrf
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <div class="input-group input-group-merge">
                        <input type="text" name="subject" class="form-control" placeholder="{{__('Subject')}}" required>
                      </div>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <select class="form-control select" name="category" required>
                        <option value="">{{__('Priority')}}</option>
                        <option value="Low">{{__('Low')}}</option>
                        <option value="Medium">{{__('Medium')}}</option> 
                        <option value="High">{{__('High')}}</option>  
                      </select>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <textarea name="details" class="form-control" rows="4" required placeholder="Details"></textarea>
                    </div>
                  </div>                
                  <div class="text-right">
                    <button type="submit" class="btn btn-success btn-block">{{__('Submit')}}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>  
    <div class="row">
      @if(count($ticket)>0)
        @foreach($ticket as $k=>$val)
          <div class="col-md-6">
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-7">
                      <!-- Title -->
                      <h5 class="h4 mb-0">#{{$val->ticket_id}}</h5>
                    </div>
                    <div class="col-5 text-right">
                      <a href="{{url('/')}}/user/reply-ticket/{{$val->ticket_id}}" class="btn btn-sm btn-neutral">{{__('Reply')}}</a>
                      <a href="{{url('/')}}/user/ticket/delete/{{$val->id}}" class="btn btn-sm btn-danger">{{__('Delete')}}</a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p class="text-sm text-dark mb-0">{{__('Subject')}}: {{$val->subject}}</p>
                      <p class="text-sm text-dark mb-0">{{__('Priority')}}: {{$val->priority}}</p>
                      <p class="text-sm text-dark mb-0">{{__('Status')}}: @if($val->status==0){{__('Open')}} @elseif($val->status==1){{__('Closed')}} @elseif($val->status==2){{__('Resolved')}} @endif</p>
                      <p class="text-sm text-dark mb-0">{{__('Created')}}: {{date("Y/m/d h:i:A", strtotime($val->created_at))}}</p>
                      <p class="text-sm text-dark mb-0">{{__('Updated')}}: {{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</p>
                    </div>
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
                <span class="btn-inner--icon"><i class="fal fa-user-headset fa-4x"></i></span>
            </a>
          </div>
          <h3 class="text-dark">{{__('No Disputes')}}</h3>
          <p class="text-dark text-sm card-text">{{__('We couldn\'t find any dispute to this account')}}</p>
          <div class="row align-items-center py-4">
            <div class="col-12">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fal fa-plus"></i> {{__('Raise a dispute')}}</a>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
    <div class="row">
      <div class="col-md-12">
      {{ $ticket->links('pagination::bootstrap-4') }}
      </div>
    </div>
@stop