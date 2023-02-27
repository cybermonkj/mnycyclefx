@extends('loginlayout')

@section('content')
  <div class="container">
    <div class="row no-gutters">
      <div class="col-md-8 col-lg-7 col-xl-6 offset-md-2 offset-lg-2 offset-xl-3 space-top-3 space-lg-0">
        <!-- Form -->
        <form role="form" action="{{route('submitregister')}}" method="post">
          @csrf
          <div class="mb-5 mb-md-7">
            <h1 class="h2">{{ __('Sign up')}}</h1>
            <p>{{$set->title}}</p>
          </div>
          <!-- End Title -->

          <!-- Form Group -->
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <input class="form-control" placeholder="{{__('First name')}}" type="text" name="first_name" required>
                @if ($errors->has('first_name'))
                  <span class="font-size-1">{{$errors->first('first_name')}}</span>
                @endif
              </div>                 
            </div>                   
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <input class="form-control" placeholder="{{__('Last name')}}" type="text" name="last_name" required>
                @if ($errors->has('last_name'))
                  <span class="font-size-1">{{$errors->first('last_name')}}</span>
                @endif
              </div>                 
            </div>                 
          </div> 
          <div class="js-form-message form-group">
            <label class="input-label" for="signinSrEmail">{{ __('Username')}}</label>
            <input class="form-control" tabindex="1" placeholder="{{ __('Username') }}" type="text" name="username"  aria-label="{{ __('Username') }}" required
                    data-msg="Please enter a valid username.">
            @if ($errors->has('username'))
              <span class="font-size-1">{{$errors->first('username')}}</span>
            @endif
          </div>          
          <div class="js-form-message form-group">
            <label class="input-label" for="signinSrEmail">{{ __('Email address')}}</label>
            <input class="form-control" tabindex="1" placeholder="{{ __('Email address') }}" type="email" name="email"  aria-label="{{ __('Email address') }}" required
                    data-msg="Please enter a valid email address.">
            @if ($errors->has('email'))
              <span class="font-size-1">{{$errors->first('email')}}</span>
            @endif
          </div>
          @if($set->referral)
            @if($set->referral_type=="username")
            <div class="js-form-message form-group">
              <label class="input-label" for="signinSrEmail">{{ __('Referral')}} <span class="text-danger">(Not Required)</span></label>
              <input class="form-control" tabindex="1" placeholder="{{ __('Username') }}" type="text" name="ref" 
                      data-msg="Please enter a valid user id.">
              @if ($errors->has('ref'))
                  <span class="font-size-1">{{$errors->first('ref')}}</span>
              @endif
            </div>
            @endif
          @endif
          <!-- End Form Group -->

          <!-- Form Group -->
          <div class="js-form-message form-group">
            <label class="input-label" for="signinSrPassword" tabindex="0">
              <span class="d-flex justify-content-between align-items-center">
                Password
              </span>
            </label>
           <div class="input-group">
              <input type="password" name="password" class="form-control" data-toggle="password">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-eye"></i></span>
              </div>
            </div>
          </div>
          <!-- End Form Group -->
          <div class="js-form-message form-group">
            <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
              <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="termsCheckbox" required="" data-msg="Please accept our Terms and Conditions.">
              <label class="custom-control-label" for="termsCheckbox">
                <small>
                  I agree to the
                  <a class="link-underline" href="{{route('terms')}}">Terms and Conditions</a>
                </small>
              </label>
            </div>
          </div>
          @if($set->recaptcha==1)
            {!! app('captcha')->display() !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    {{ $errors->first('g-recaptcha-response') }}
                </span>
            @endif
          @endif

          <!-- Button -->
          <div class="row align-items-center mb-5">
            <div class="col-sm-12 mb-3">
              <span class="font-size-1 text-muted">{{__('Got an Account?')}}</span>
              <a class="font-size-1 font-weight-bold" href="{{route('login')}}">{{__('Login')}}</a>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary btn-block transition-3d-hover">{{__('Get Started')}}</button>
            </div>
          </div>
          <!-- End Button -->
        </form>
        <!-- End Form -->
      </div>
    </div>
  </div>
@stop