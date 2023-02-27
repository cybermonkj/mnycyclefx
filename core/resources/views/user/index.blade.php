@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-lg-6">
          <div class="media align-items-center ml-3">
            <span class="avatar avatar-md rounded-circle">
              <img alt="Image placeholder" src="{{url('/')}}/asset/profile/{{$cast}}">
            </span>
            <div class="media-body ml-2">
              <h3 class="mb-0 h2 text-dark font-weight-bolder">{{$user->first_name}} {{$user->last_name}}</h3>
              <p class="mb-1 text-dark">{{__('Hi')}}, {{$user->username}} {{__('welcome to your dashboard')}}</p>
            </div>
          </div>
      </div>      
    </div>
    <div class="row">
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-6">
                <h4 class="card-title mb-0 font-weight-bolder">{{__('Balance')}}</h4>
                <span class="mb-0 text-dark">{{$currency->symbol.number_format($user->balance)}}</span>
              </div>
              <div class="col-6 text-right">
                <a href="{{route('user.fund')}}" class="btn btn-sm btn-neutral">{{__('Add Funds')}}</a>
              </div>
            </div>
          </div>
        </div>
      </div>          
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h4 class="card-title mb-0 font-weight-bolder">{{__('Available Profit')}}</h4>
                <span class="mb-0 text-dark">{{$currency->symbol.number_format($user->profit)}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h4 class="card-title mb-0 font-weight-bolder">{{__('Total Profit')}}</h4>
                <span class="mb-0 text-dark">{{$currency->symbol.number_format($user->total_profit)}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h4 class="card-title mb-0 font-weight-bolder">{{__('Investment Bonus')}}</h4>
                <span class="mb-0 text-dark">{{$currency->symbol.number_format($user->trade_bonus)}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="accordion" id="accordionExample">
          @if($set->p_inv==1)       
            <div class="accordion-item">
              <div class="accordion-header" id="headingTwo">
                <span>
                  <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span><i class="fal fa-globe"></i> {{__('Invest in Companies')}}</span>
                  </button>
                </span>
              </div>
              <div id="collapseTwo" class="collapse show" aria-labelledby="headinTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <p class="text-dark mb-2"> {{__('Invest in startups and existing companies buy purchasing units.')}}</p>
                  <a class="btn btn-sm btn-primary" href="{{route('user.sandplans')}}">{{__('Buy units')}} <i class="fal fa-arrow-right"></i></a>
                </div>
              </div>  
            </div> 
          @endif           
          @if($set->s_inv==1)       
            <div class="accordion-item">
              <div class="accordion-header" id="headingOne">
                <span>
                  <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <span><i class="fal fa-exchange"></i> {{__('Standard Investment')}}</span>
                  </button>
                </span>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headinOne" data-parent="#accordionExample">
                <div class="card-body">
                  <p class="text-dark mb-2"> {{__('With our low risk plans, easy access to profit, recurring capital.')}}</p>
                  <a class="btn btn-sm btn-primary" href="{{route('user.plans')}}">{{__('Investment Plans')}} <i class="fal fa-arrow-right"></i></a>
                </div>
              </div>  
            </div> 
          @endif  
          @if($user->fa_status==0)
            <div class="accordion-item">
              <div class="accordion-header" id="headingSeven">
                <span>
                  <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    <span><i class="fal fa-lock"></i> {{__('Secure your')}} {{$set->site_name}} {{__('account with Two Factor Authentication')}}</span>
                  </button>
                </span>
              </div>
              <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                <div class="card-body">
                  <p class="text-dark mb-2"> {{__('Two Factor Authentication on your account is currently disabled.')}}</p>
                  <a class="btn btn-sm btn-primary" href="{{route('user.2fa')}}">{{__('Please enable')}} <i class="fal fa-arrow-right"></i></a>
                </div>
              </div>  
            </div> 
          @endif            
          @if($set->dashboard_message!=null)
            <div class="accordion-item">
              <div class="accordion-header" id="headingSix">
                <span>
                  <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <span><i class="fal fa-megaphone"></i> {{$set->site_name}} {{__('Announcement')}}</span>
                  </button>
                </span>
              </div>
              <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                  <p class="text-dark mb-2"> {{$set->dashboard_message}}</p>
                </div>
              </div>  
            </div> 
          @endif  
          @if($set->upgrade_status==1)
            @if($user->upgrade==0)
              <div class="accordion-item">
                <div class="accordion-header" id="headingFive">
                  <span>
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      <span><i class="fal fa-award"></i> {{__('Start Receiving Investment Bonuses')}}</span>
                    </button>
                  </span>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                  <div class="card-body">
                    <p class="text-dark mb-2"> {{__('You can now receive certain bonus of total profit after standard investment ends. Don\'t let your money sit there, upgrade your account & start receiving bonuses. Upgrade fee costs')}} {{$currency->symbol.$set->upgrade_fee}}</p>
                    <a class="btn btn-sm btn-primary" href="{{route('user.upgrade')}}">{{__('Start now')}} <i class="fal fa-arrow-right"></i></a>
                  </div>
                </div>  
              </div> 
            @endif  
          @endif            
          @if($set->referral==1)       
            <div class="accordion-item">
              <div class="accordion-header" id="headingFour">
                <span>
                  <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <span><i class="fal fa-share"></i> {{__('Affiliate System')}}</span>
                  </button>
                </span>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                  <p class="text-dark mb-2"> {{__('Earn money by referring family and friends to invest on')}} {{$set->site_name}}.</p>
                  <a class="btn btn-sm btn-primary" href="{{route('user.referral')}}">{{__('Refer family & friends')}} <i class="fal fa-arrow-right"></i></a>
                </div>
              </div>  
            </div> 
          @endif           
          @if($set->savings==1)       
            <div class="accordion-item">
              <div class="accordion-header" id="headingThree">
                <span>
                  <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <span><i class="fal fa-piggy-bank"></i> {{__('Save & Earn')}}</span>
                  </button>
                </span>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headinThree" data-parent="#accordionExample">
                <div class="card-body">
                  <p class="text-dark mb-2"> {{__('Let\'s run the race with you. Save and earn competitive percentage.')}}</p>
                  <a class="btn btn-sm btn-primary" href="{{route('user.savings')}}">{{__('Apply now')}} <i class="fal fa-arrow-right"></i></a>
                </div>
              </div>  
            </div> 
          @endif            
        </div>
      </div>
    </div>
@stop