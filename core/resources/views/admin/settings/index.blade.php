@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">{{__('Congifure website')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.settings.update')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Website name')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="site_name" maxlength="200" value="{{$set->site_name}}" class="form-control">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Company email')}}</label>
                        <div class="col-lg-10">
                            <input type="email" name="email" value="{{$set->email}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Mobile')}}</label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="mobile" max-length="14" value="{{$set->mobile}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Short description')}}</label>
                        <div class="col-lg-10">
                            <textarea type="text" name="site_desc" rows="2" class="form-control" required>{{$set->site_desc}}</textarea>
                        </div>
                    </div>                        
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Address')}}</label>
                        <div class="col-lg-10">
                            <textarea type="text" name="address" rows="2" class="form-control">{{$set->address}}</textarea>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Website title')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="title" max-length="200" value="{{$set->title}}" class="form-control">
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Livechat code')}}</label>
                        <div class="col-lg-10">
                            <textarea type="text" name="livechat" class="form-control">{{$set->livechat}}</textarea>
                            <span class="form-text text-xs">Any livechat service javascript snippet should work</span>
                        </div>
                    </div>                     
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Welcome Message')}}</label>
                        <div class="col-lg-10">
                            <textarea type="text" rows="2" name="welcome_message" class="form-control">{{$set->welcome_message}}</textarea>
                            <span class="form-text text-xs">This message is sent to clients after registration via email, nothing is sent if left empty</span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Dashboard Message')}}</label>
                        <div class="col-lg-10">
                            <textarea type="text" name="dashboard_message" rows="2" class="form-control">{{$set->dashboard_message}}</textarea>
                            <span class="form-text text-xs">Inform your clients about any platform updates</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Affiliate Type')}}</label>
                        <div class="col-lg-10">
                        <select class="form-control select" name="referral_type" required>
                            <option value="url" @if($set->referral_type=="url") selected @endif</option>{{__('Referral Link')}}</option>
                            <option value="username" @if($set->referral_type=="username") selected @endif</option>{{__('Username')}}</option> 
                        </select>
                        <span class="form-text text-xs">Decide how you want to receive referrals, is it by sharing username or through referral link?</span>
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Default Website Font')}}</label>
                        <div class="col-lg-10">
                        <select class="form-control select" name="default_font" required>
                            <option value="Roboto" @if($set->default_font=="Roboto") selected @endif</option>{{__('Roboto')}}</option>
                            <option value="STIX Two Text" @if($set->default_font=="STIX Two Text") selected @endif</option>{{__('STIX Two Text')}}</option>
                            <option value="Atkinson Hyperlegible" @if($set->default_font=="Atkinson Hyperlegible") selected @endif</option>{{__('Atkinson Hyperlegible')}}</option>
                            <option value="Open Sans" @if($set->default_font=="Open Sans") selected @endif</option>{{__('Open Sans')}}</option>
                            <option value="Noto Sans JP" @if($set->default_font=="Noto Sans JP") selected @endif</option>{{__('Noto Sans JP')}}</option>
                            <option value="Roboto Condensed" @if($set->default_font=="Roboto Condensed") selected @endif</option>{{__('Roboto Condensed')}}</option>
                            <option value="Source Sans Pro" @if($set->default_font=="Source Sans Pro") selected @endif</option>{{__('Source Sans Pro')}}</option>
                            <option value="Noto Sans" @if($set->default_font=="Noto Sans") selected @endif</option>{{__('Noto Sans')}}</option>
                            <option value="PT Sans" @if($set->default_font=="PT Sans") selected @endif</option>{{__('PT Sans')}}</option>
                            <option value="Georama" @if($set->default_font=="Georama") selected @endif>{{__('Georama')}}</option>
                            <option value="Lato" @if($set->default_font=="Lato") selected @endif>{{__('Lato')}}</option> 
                            <option value="Montserrat" @if($set->default_font=="Montserrat") selected @endif>{{__('Montserrat')}}</option>  
                            <option value="Hahmlet" @if($set->default_font=="Hahmlet") selected @endif>{{__('Hahmlet')}}</option>  
                            <option value="Poppins" @if($set->default_font=="Poppins") selected @endif>{{__('Poppins')}}</option>  
                            <option value="Oswald" @if($set->default_font=="Oswald") selected @endif>{{__('Oswald')}}</option>  
                            <option value="Raleway" @if($set->default_font=="Raleway") selected @endif>{{__('Raleway')}}</option>  
                            <option value="Nunito" @if($set->default_font=="Nunito") selected @endif>{{__('Nunito')}}</option>  
                            <option value="Merriweather" @if($set->default_font=="Merriweather") selected @endif>{{__('Merriweather')}}</option>  
                            <option value="Ubuntu" @if($set->default_font=="Ubuntu") selected @endif>{{__('Ubuntu')}}</option>  
                            <option value="Rubik" @if($set->default_font=="Rubik") selected @endif>{{__('Rubik')}}</option>  
                            <option value="Lora" @if($set->default_font=="Lora") selected @endif>{{__('Lora')}}</option>  
                            <option value="Mukta" @if($set->default_font=="Mukta") selected @endif>{{__('Mukta')}}</option>  
                            <option value="Inter" @if($set->default_font=="Inter") selected @endif>{{__('Inter')}}</option>  
                            <option value="Quicksand" @if($set->default_font=="Quicksand") selected @endif>{{__('Quickand')}}</option>  
                            <option value="Heebo" @if($set->default_font=="Heebo") selected @endif>{{__('Karla')}}</option>  
                        </select>
                        <span class="form-text text-xs">Not satisfied with font options, send a ticket to boomchart.zendesk.com with your purchase code</span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Default Dashboard Color')}}</label>
                        <div class="col-lg-10">
                            <select class="form-control select" name="default_color" required>
                            <option value="bg-newlife" @if($set->default_color=="bg-newlife") selected @endif>{{__('New Life')}}</option>                             
                            <option value="bg-morpheusden" @if($set->default_color=="bg-morpheusden") selected @endif>{{__('Morpheus Den')}}</option>                             
                            <option value="bg-sharpblues" @if($set->default_color=="bg-sharpblues") selected @endif>{{__('Sharp Blue')}}</option>                             
                            <option value="bg-fruitblend" @if($set->default_color=="bg-fruitblend") selected @endif>{{__('Fruit Blend')}}</option>                             
                            <option value="bg-deepblue" @if($set->default_color=="bg-deepblue") selected @endif>{{__('Deep Blue')}}</option>                             
                            <option value="bg-fabledsunset" @if($set->default_color=="bg-fabledsunset") selected @endif>{{__('Fabled Sunset')}}</option>                                                       
                            <option value="bg-malibubeach" @if($set->default_color=="bg-malibubeach") selected @endif>{{__('Malibu Beach')}}</option>                                                       
                            <option value="bg-looncrest" @if($set->default_color=="bg-looncrest") selected @endif>{{__('Loon Crest')}}</option>                                                       
                            <option value="bg-aquasplash" @if($set->default_color=="bg-aquasplash") selected @endif>{{__('Aqua Splash')}}</option>                                                       
                            <option value="bg-lovekiss" @if($set->default_color=="bg-lovekiss") selected @endif>{{__('Love Kiss')}}</option>                                                       
                            <option value="bg-premiumdark" @if($set->default_color=="bg-premiumdark") selected @endif>{{__('Premium Dark')}}</option>                                                       
                            <option value="bg-coldevening" @if($set->default_color=="bg-coldevening") selected @endif>{{__('Cold Evening')}}</option>                                                       
                            <option value="bg-phoenixstart" @if($set->default_color=="bg-phoenixstart") selected @endif>{{__('Phoenix Start')}}</option>                                                       
                            <option value="bg-octobersilence" @if($set->default_color=="bg-octobersilence") selected @endif>{{__('October Silence')}}</option>                                                       
                            <option value="bg-marsparty" @if($set->default_color=="bg-marsparty") selected @endif>{{__('Mars Party')}}</option>                                                       
                            <option value="bg-eternalconstance" @if($set->default_color=="bg-eternalconstance") selected @endif>{{__('Eternal Constance')}}</option>                                                       
                            <option value="bg-amouramour" @if($set->default_color=="bg-amouramour") selected @endif>{{__('Amour Amour')}}</option>                                                       
                            <option value="bg-happymemories" @if($set->default_color=="bg-happymemories") selected @endif>{{__('Happy Memories')}}</option>                                                       
                            <option value="bg-midnightbloom" @if($set->default_color=="bg-midnightbloom") selected @endif>{{__('Midnight Bloom')}}</option>                                                       
                            <option value="bg-lecocktail" @if($set->default_color=="bg-lecocktail") selected @endif>{{__('Le Cocktail')}}</option>                                                       
                            <option value="bg-nightsky" @if($set->default_color=="bg-nightsky") selected @endif>{{__('Night Sky')}}</option>                                                       
                            <option value="bg-plumbath" @if($set->default_color=="bg-plumbath") selected @endif>{{__('Plumbath')}}</option>                                                       
                            <option value="bg-nightcall" @if($set->default_color=="bg-nightcall") selected @endif>{{__('Night call')}}</option>                                                                                                              
                            </select>
                            <span class="form-text text-xs">Not satisfied with dashboard colors options, send a ticket to boomchart.zendesk.com with your purchase code</span>
                        </div>
                    </div>                  
                    <div class="form-group row">                    
                        <label class="col-form-label col-lg-2">{{__('Balance on signup')}}</label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">{{$currency->symbol}}</span>
                                </span>
                                <input type="number" name="bal" step="any" max-length="10" value="{{convertFloat($set->balance_reg)}}" class="form-control">
                            </div>
                            <span class="form-text text-xs">Balance immediately after registration, leave empty if you don't want to give your clients a head start</span>
                        </div> 
                    </div> 
                    <div class="form-group row">   
                        <label class="col-form-label col-lg-2">{{__('Upgrade fee')}} </label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <span class="input-group-append">
                                    <span class="input-group-text">{{$currency->symbol}}</span>
                                </span>
                                <input type="number" name="upgrade_fee" max-length="10" value="{{$set->upgrade_fee}}" class="form-control">
                            </div>
                            <span class="form-text text-xs">Ensure Upgrade Account for Investment Bonus is active, This is what is required to be payed by a client to start receiving investment bonus</span>
                        </div>   
                    </div>                     
                    <div class="form-group row">   
                        <label class="col-form-label col-lg-2">{{__('Admin URL')}} </label>
                        <div class="col-lg-10">
                            <input type="text" name="admin_url" value="{{$set->admin_url}}" class="form-control" required>
                        </div>   
                    </div>   
                    <div class="form-group row">                                                                                                           
                        <label class="col-form-label col-lg-2">{{__('Transfer charge')}}</label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="number" name="transfer_charge" max-length="10" value="{{$set->transfer_charge}}" class="form-control">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                                      
                        </div>           
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{__('Features')}}</label>
                            <div class="col-lg-6">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->kyc==1)
                                        <input type="checkbox" name="kyc" id="customCheckLogin1" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="kyc" id="customCheckLogin1"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin1">
                                    <span class="text-muted">{{__('Know you customer (KYC)')}}</span>     
                                    </label>
                                </div>                        
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->email_verification==1)
                                        <input type="checkbox" name="email_activation" id="customCheckLogin2" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="email_activation"id="customCheckLogin2"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin2">
                                    <span class="text-muted">{{__('Email Verification')}}</span>     
                                    </label>
                                </div>                       
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->email_notify==1)
                                        <input type="checkbox" name="email_notify" id="customCheckLogin3" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="email_notify"id="customCheckLogin3"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin3">
                                    <span class="text-muted">{{__('Email Notification for Automated Emails')}}</span>     
                                    </label>
                                </div>                        
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->registration==1)
                                        <input type="checkbox" name="registration" id="customCheckLogin4" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="registration"id="customCheckLogin4"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin4">
                                    <span class="text-muted">{{__('Accept New Registration')}}</span>     
                                    </label>
                                </div> 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->referral==1)
                                        <input type="checkbox" name="referral" id="customCheckLogin5" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="referral"id="customCheckLogin5"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin5">
                                    <span class="text-muted">{{__('Affiliate System')}}</span>     
                                    </label>
                                </div>                                 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->recaptcha==1)
                                        <input type="checkbox" name="recaptcha" id="customCheckLogin6" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="recaptcha"id="customCheckLogin6"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin6">
                                    <span class="text-muted">{{__('Google Recaptcha v2 for login & Registration')}}</span>     
                                    </label>
                                </div>                                 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->instant_approval==1)
                                        <input type="checkbox" name="instant_approval" id="customCheckLogins6" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="instant_approval"id="customCheckLogins6"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogins6">
                                    <span class="text-muted">{{__('Let Script instantly approve standard investment')}}</span>     
                                    </label>
                                </div>                                                                                                                         
                            </div>
                            <div class="col-lg-6">                                      
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->upgrade_status==1)
                                        <input type="checkbox" name="upgrade_status" id="customCheckLogin16" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="upgrade_status" id="customCheckLogin16"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin16">
                                    <span class="text-muted">{{__('Upgrade Account for Investment Bonus')}}</span>     
                                    </label>
                                </div>  
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->kyc_restriction==1)
                                        <input type="checkbox" name="kyc_restriction" id="customCheckLogin117" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="kyc_restriction" id="customCheckLogin117"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin117">
                                    <span class="text-muted">{{__('Force Kyc on Clients')}}</span>     
                                    </label>
                                </div>                                
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->p_inv==1)
                                        <input type="checkbox" name="p_inv" id="customCheckLogin118" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="p_inv" id="customCheckLogin118"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin118">
                                    <span class="text-muted">{{__('Project Investment')}}</span>     
                                    </label>
                                </div>                                
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->s_inv==1)
                                        <input type="checkbox" name="s_inv" id="customCheckLogin119" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="s_inv" id="customCheckLogin119"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin119">
                                    <span class="text-muted">{{__('Standard Investment')}}</span>     
                                    </label>
                                </div>                                
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->savings==1)
                                        <input type="checkbox" name="savings" id="customCheckLogin127" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="savings" id="customCheckLogin127"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin127">
                                    <span class="text-muted">{{__('Savings')}}</span>     
                                    </label>
                                </div> 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->transfer==1)
                                        <input type="checkbox" name="transfer" id="customCheckLogin17" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="transfer" id="customCheckLogin17"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin17">
                                    <span class="text-muted">{{__('Transfer')}}</span>     
                                    </label>
                                </div>                                 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->language==1)
                                        <input type="checkbox" name="language" id="customCheckLoginf17" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="language" id="customCheckLoginf17"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLoginf17">
                                    <span class="text-muted">{{__('Display Multiple Languages in user and homepage')}}</span>     
                                    </label>
                                </div>                                                                                                                                                                                                                                                  
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{__('Homepage Settings')}}</label>
                            <div class="col-lg-3">                                                                                  
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->blog==1)
                                        <input type="checkbox" name="blog" id="customCheckLogin8" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="blog"id="customCheckLogin8"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin8">
                                    <span class="text-muted">{{__('Blog')}}</span>     
                                    </label>
                                </div>   
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->faq==1)
                                        <input type="checkbox" name="faq" id="customCheckLogin15" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="faq"id="customCheckLogin15"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin15">
                                    <span class="text-muted">{{__('Frequently Ask Questions')}}</span>     
                                    </label>
                                </div>                                                                
                            </div>
                            <div class="col-lg-3">  
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->review==1)
                                        <input type="checkbox" name="review" id="customCheckLogin10" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="review"id="customCheckLogin10"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin10">
                                    <span class="text-muted">{{__('Customer Review')}}</span>     
                                    </label>
                                </div> 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->contact==1)
                                        <input type="checkbox" name="contact" id="customCheckLogin14" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="contact"id="customCheckLogin14"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin14">
                                    <span class="text-muted">{{__('Contact us')}}</span>     
                                    </label>
                                </div>      
                            </div>                            
                            <div class="col-lg-3">  
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->team==1)
                                        <input type="checkbox" name="team" id="customCheckLogin12" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="team"id="customCheckLogin12"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin12">
                                    <span class="text-muted">{{__('Team')}}</span>     
                                    </label>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->stat==1)
                                        <input type="checkbox" name="stat" id="customCheckLogin13" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="stat"id="customCheckLogin13"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin13">
                                    <span class="text-muted">{{__('Investment Statistics')}}</span>     
                                    </label>
                                </div>     
                            </div>
                            <div class="col-lg-3">      
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->services==1)
                                        <input type="checkbox" name="services" id="customCheckLogin9" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="services"id="customCheckLogin9"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin9">
                                    <span class="text-muted">{{__('Services')}}</span>     
                                    </label>
                                </div>  
                                 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    @if($set->plan==1)
                                        <input type="checkbox" name="plan" id="customCheckLogin11" class="custom-control-input" value="1" checked>
                                    @else
                                        <input type="checkbox" name="plan"id="customCheckLogin11"  class="custom-control-input" value="1">
                                    @endif
                                    <label class="custom-control-label" for="customCheckLogin11">
                                    <span class="text-muted">{{__('Investment Plan')}}</span>     
                                    </label>
                                </div>                                                                                                                              
                                                                                                                                                                                                                                                                                                         
                            </div>
                        </div> 
                        <hr>  
                        <h3>Email Template</h3>    
                        <div class="table-responsive mb-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>CODE</th>
                                        <th>DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> &#123;&#123;message&#125;&#125;</td>
                                    <td> Details Text From the Script</td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> &#123;&#123;name&#125;&#125; </td>
                                    <td> Users Name. Will be Pulled From Database</td>
                                </tr>                                    
                                <tr>
                                    <td> 3 </td>
                                    <td> &#123;&#123;site_name&#125;&#125; </td>
                                    <td> Website Name. Will be Pulled From Database</td>
                                </tr>
                                </tbody>                    
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <textarea type="text" name="email_template" rows="4" class="form-control tinymce">{{$set->email_template}}</textarea>
                            </div>
                        </div>                        
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                        </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">{{__('Savings')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.savings.update')}}" method="post">
                    @csrf       
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{__('3 Months')}}</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" step="any"  name="s_3m" value="{{$set->s_3m}}" class="form-control" required>
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                    
                    </div>                                
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{__('6 Months')}}</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" step="any"  name="s_6m" value="{{$set->s_6m}}" class="form-control" required>
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                    
                    </div>                                
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{__('9 Months')}}</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" step="any"  name="s_9m" value="{{$set->s_9m}}" class="form-control" required>
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                    
                    </div>                                
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{__('12 Months')}}</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" step="any"  name="s_12m" value="{{$set->s_12m}}" class="form-control" required>
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                    
                    </div>                                 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{__('Minimum Amount')}}</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">{{$currency->symbol}}</span>
                                </span>
                                <input type="number" step="any"  name="s_min" value="{{$set->s_min}}" class="form-control" required>
                            </div>
                        </div>                                    
                    </div>  
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>    
        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="mb-0">{{__('Security')}}</h3>
                <p class="mb-0">Don't share credentails with any one</p>
            </div>
            <div class="card-body">
                <form action="{{route('admin.account.update')}}" method="post">
                    @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Username')}}</label>
                            <div class="col-lg-10">
                                <input type="text" name="username" value="{{$val->username}}" class="form-control">
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Password')}}</label>
                            <div class="col-lg-10">
                                <input type="password" name="password"  class="form-control">
                            </div>
                        </div>                          
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Recovery Email')}}</label>
                            <div class="col-lg-10">
                                <input type="email" name="recovery_email"  class="form-control" value="{{$val->recovery_email}}" required>
                                <span class="text-xs">Recovery link will be sent to this email is password is forgotten</span>
                            </div>
                        </div>          
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-block">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>    
@stop