<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0"><?php echo e(__('Congifure website')); ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.settings.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Website name')); ?></label>
                        <div class="col-lg-10">
                            <input type="text" name="site_name" maxlength="200" value="<?php echo e($set->site_name); ?>" class="form-control">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Company email')); ?></label>
                        <div class="col-lg-10">
                            <input type="email" name="email" value="<?php echo e($set->email); ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Mobile')); ?></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="mobile" max-length="14" value="<?php echo e($set->mobile); ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Short description')); ?></label>
                        <div class="col-lg-10">
                            <textarea type="text" name="site_desc" rows="2" class="form-control" required><?php echo e($set->site_desc); ?></textarea>
                        </div>
                    </div>                        
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Address')); ?></label>
                        <div class="col-lg-10">
                            <textarea type="text" name="address" rows="2" class="form-control"><?php echo e($set->address); ?></textarea>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Website title')); ?></label>
                        <div class="col-lg-10">
                            <input type="text" name="title" max-length="200" value="<?php echo e($set->title); ?>" class="form-control">
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Livechat code')); ?></label>
                        <div class="col-lg-10">
                            <textarea type="text" name="livechat" class="form-control"><?php echo e($set->livechat); ?></textarea>
                            <span class="form-text text-xs">Any livechat service javascript snippet should work</span>
                        </div>
                    </div>                     
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Welcome Message')); ?></label>
                        <div class="col-lg-10">
                            <textarea type="text" rows="2" name="welcome_message" class="form-control"><?php echo e($set->welcome_message); ?></textarea>
                            <span class="form-text text-xs">This message is sent to clients after registration via email, nothing is sent if left empty</span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Dashboard Message')); ?></label>
                        <div class="col-lg-10">
                            <textarea type="text" name="dashboard_message" rows="2" class="form-control"><?php echo e($set->dashboard_message); ?></textarea>
                            <span class="form-text text-xs">Inform your clients about any platform updates</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Affiliate Type')); ?></label>
                        <div class="col-lg-10">
                        <select class="form-control select" name="referral_type" required>
                            <option value="url" <?php if($set->referral_type=="url"): ?> selected <?php endif; ?></option><?php echo e(__('Referral Link')); ?></option>
                            <option value="username" <?php if($set->referral_type=="username"): ?> selected <?php endif; ?></option><?php echo e(__('Username')); ?></option> 
                        </select>
                        <span class="form-text text-xs">Decide how you want to receive referrals, is it by sharing username or through referral link?</span>
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Default Website Font')); ?></label>
                        <div class="col-lg-10">
                        <select class="form-control select" name="default_font" required>
                            <option value="Roboto" <?php if($set->default_font=="Roboto"): ?> selected <?php endif; ?></option><?php echo e(__('Roboto')); ?></option>
                            <option value="STIX Two Text" <?php if($set->default_font=="STIX Two Text"): ?> selected <?php endif; ?></option><?php echo e(__('STIX Two Text')); ?></option>
                            <option value="Atkinson Hyperlegible" <?php if($set->default_font=="Atkinson Hyperlegible"): ?> selected <?php endif; ?></option><?php echo e(__('Atkinson Hyperlegible')); ?></option>
                            <option value="Open Sans" <?php if($set->default_font=="Open Sans"): ?> selected <?php endif; ?></option><?php echo e(__('Open Sans')); ?></option>
                            <option value="Noto Sans JP" <?php if($set->default_font=="Noto Sans JP"): ?> selected <?php endif; ?></option><?php echo e(__('Noto Sans JP')); ?></option>
                            <option value="Roboto Condensed" <?php if($set->default_font=="Roboto Condensed"): ?> selected <?php endif; ?></option><?php echo e(__('Roboto Condensed')); ?></option>
                            <option value="Source Sans Pro" <?php if($set->default_font=="Source Sans Pro"): ?> selected <?php endif; ?></option><?php echo e(__('Source Sans Pro')); ?></option>
                            <option value="Noto Sans" <?php if($set->default_font=="Noto Sans"): ?> selected <?php endif; ?></option><?php echo e(__('Noto Sans')); ?></option>
                            <option value="PT Sans" <?php if($set->default_font=="PT Sans"): ?> selected <?php endif; ?></option><?php echo e(__('PT Sans')); ?></option>
                            <option value="Georama" <?php if($set->default_font=="Georama"): ?> selected <?php endif; ?>><?php echo e(__('Georama')); ?></option>
                            <option value="Lato" <?php if($set->default_font=="Lato"): ?> selected <?php endif; ?>><?php echo e(__('Lato')); ?></option> 
                            <option value="Montserrat" <?php if($set->default_font=="Montserrat"): ?> selected <?php endif; ?>><?php echo e(__('Montserrat')); ?></option>  
                            <option value="Hahmlet" <?php if($set->default_font=="Hahmlet"): ?> selected <?php endif; ?>><?php echo e(__('Hahmlet')); ?></option>  
                            <option value="Poppins" <?php if($set->default_font=="Poppins"): ?> selected <?php endif; ?>><?php echo e(__('Poppins')); ?></option>  
                            <option value="Oswald" <?php if($set->default_font=="Oswald"): ?> selected <?php endif; ?>><?php echo e(__('Oswald')); ?></option>  
                            <option value="Raleway" <?php if($set->default_font=="Raleway"): ?> selected <?php endif; ?>><?php echo e(__('Raleway')); ?></option>  
                            <option value="Nunito" <?php if($set->default_font=="Nunito"): ?> selected <?php endif; ?>><?php echo e(__('Nunito')); ?></option>  
                            <option value="Merriweather" <?php if($set->default_font=="Merriweather"): ?> selected <?php endif; ?>><?php echo e(__('Merriweather')); ?></option>  
                            <option value="Ubuntu" <?php if($set->default_font=="Ubuntu"): ?> selected <?php endif; ?>><?php echo e(__('Ubuntu')); ?></option>  
                            <option value="Rubik" <?php if($set->default_font=="Rubik"): ?> selected <?php endif; ?>><?php echo e(__('Rubik')); ?></option>  
                            <option value="Lora" <?php if($set->default_font=="Lora"): ?> selected <?php endif; ?>><?php echo e(__('Lora')); ?></option>  
                            <option value="Mukta" <?php if($set->default_font=="Mukta"): ?> selected <?php endif; ?>><?php echo e(__('Mukta')); ?></option>  
                            <option value="Inter" <?php if($set->default_font=="Inter"): ?> selected <?php endif; ?>><?php echo e(__('Inter')); ?></option>  
                            <option value="Quicksand" <?php if($set->default_font=="Quicksand"): ?> selected <?php endif; ?>><?php echo e(__('Quickand')); ?></option>  
                            <option value="Heebo" <?php if($set->default_font=="Heebo"): ?> selected <?php endif; ?>><?php echo e(__('Karla')); ?></option>  
                        </select>
                        <span class="form-text text-xs">Not satisfied with font options, send a ticket to boomchart.zendesk.com with your purchase code</span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Default Dashboard Color')); ?></label>
                        <div class="col-lg-10">
                            <select class="form-control select" name="default_color" required>
                            <option value="bg-newlife" <?php if($set->default_color=="bg-newlife"): ?> selected <?php endif; ?>><?php echo e(__('New Life')); ?></option>                             
                            <option value="bg-morpheusden" <?php if($set->default_color=="bg-morpheusden"): ?> selected <?php endif; ?>><?php echo e(__('Morpheus Den')); ?></option>                             
                            <option value="bg-sharpblues" <?php if($set->default_color=="bg-sharpblues"): ?> selected <?php endif; ?>><?php echo e(__('Sharp Blue')); ?></option>                             
                            <option value="bg-fruitblend" <?php if($set->default_color=="bg-fruitblend"): ?> selected <?php endif; ?>><?php echo e(__('Fruit Blend')); ?></option>                             
                            <option value="bg-deepblue" <?php if($set->default_color=="bg-deepblue"): ?> selected <?php endif; ?>><?php echo e(__('Deep Blue')); ?></option>                             
                            <option value="bg-fabledsunset" <?php if($set->default_color=="bg-fabledsunset"): ?> selected <?php endif; ?>><?php echo e(__('Fabled Sunset')); ?></option>                                                       
                            <option value="bg-malibubeach" <?php if($set->default_color=="bg-malibubeach"): ?> selected <?php endif; ?>><?php echo e(__('Malibu Beach')); ?></option>                                                       
                            <option value="bg-looncrest" <?php if($set->default_color=="bg-looncrest"): ?> selected <?php endif; ?>><?php echo e(__('Loon Crest')); ?></option>                                                       
                            <option value="bg-aquasplash" <?php if($set->default_color=="bg-aquasplash"): ?> selected <?php endif; ?>><?php echo e(__('Aqua Splash')); ?></option>                                                       
                            <option value="bg-lovekiss" <?php if($set->default_color=="bg-lovekiss"): ?> selected <?php endif; ?>><?php echo e(__('Love Kiss')); ?></option>                                                       
                            <option value="bg-premiumdark" <?php if($set->default_color=="bg-premiumdark"): ?> selected <?php endif; ?>><?php echo e(__('Premium Dark')); ?></option>                                                       
                            <option value="bg-coldevening" <?php if($set->default_color=="bg-coldevening"): ?> selected <?php endif; ?>><?php echo e(__('Cold Evening')); ?></option>                                                       
                            <option value="bg-phoenixstart" <?php if($set->default_color=="bg-phoenixstart"): ?> selected <?php endif; ?>><?php echo e(__('Phoenix Start')); ?></option>                                                       
                            <option value="bg-octobersilence" <?php if($set->default_color=="bg-octobersilence"): ?> selected <?php endif; ?>><?php echo e(__('October Silence')); ?></option>                                                       
                            <option value="bg-marsparty" <?php if($set->default_color=="bg-marsparty"): ?> selected <?php endif; ?>><?php echo e(__('Mars Party')); ?></option>                                                       
                            <option value="bg-eternalconstance" <?php if($set->default_color=="bg-eternalconstance"): ?> selected <?php endif; ?>><?php echo e(__('Eternal Constance')); ?></option>                                                       
                            <option value="bg-amouramour" <?php if($set->default_color=="bg-amouramour"): ?> selected <?php endif; ?>><?php echo e(__('Amour Amour')); ?></option>                                                       
                            <option value="bg-happymemories" <?php if($set->default_color=="bg-happymemories"): ?> selected <?php endif; ?>><?php echo e(__('Happy Memories')); ?></option>                                                       
                            <option value="bg-midnightbloom" <?php if($set->default_color=="bg-midnightbloom"): ?> selected <?php endif; ?>><?php echo e(__('Midnight Bloom')); ?></option>                                                       
                            <option value="bg-lecocktail" <?php if($set->default_color=="bg-lecocktail"): ?> selected <?php endif; ?>><?php echo e(__('Le Cocktail')); ?></option>                                                       
                            <option value="bg-nightsky" <?php if($set->default_color=="bg-nightsky"): ?> selected <?php endif; ?>><?php echo e(__('Night Sky')); ?></option>                                                       
                            <option value="bg-plumbath" <?php if($set->default_color=="bg-plumbath"): ?> selected <?php endif; ?>><?php echo e(__('Plumbath')); ?></option>                                                       
                            <option value="bg-nightcall" <?php if($set->default_color=="bg-nightcall"): ?> selected <?php endif; ?>><?php echo e(__('Night call')); ?></option>                                                                                                              
                            </select>
                            <span class="form-text text-xs">Not satisfied with dashboard colors options, send a ticket to boomchart.zendesk.com with your purchase code</span>
                        </div>
                    </div>                  
                    <div class="form-group row">                    
                        <label class="col-form-label col-lg-2"><?php echo e(__('Balance on signup')); ?></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </span>
                                <input type="number" name="bal" step="any" max-length="10" value="<?php echo e(convertFloat($set->balance_reg)); ?>" class="form-control">
                            </div>
                            <span class="form-text text-xs">Balance immediately after registration, leave empty if you don't want to give your clients a head start</span>
                        </div> 
                    </div> 
                    <div class="form-group row">   
                        <label class="col-form-label col-lg-2"><?php echo e(__('Upgrade fee')); ?> </label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <span class="input-group-append">
                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </span>
                                <input type="number" name="upgrade_fee" max-length="10" value="<?php echo e($set->upgrade_fee); ?>" class="form-control">
                            </div>
                            <span class="form-text text-xs">Ensure Upgrade Account for Investment Bonus is active, This is what is required to be payed by a client to start receiving investment bonus</span>
                        </div>   
                    </div>                     
                    <div class="form-group row">   
                        <label class="col-form-label col-lg-2"><?php echo e(__('Admin URL')); ?> </label>
                        <div class="col-lg-10">
                            <input type="text" name="admin_url" value="<?php echo e($set->admin_url); ?>" class="form-control" required>
                        </div>   
                    </div>   
                    <div class="form-group row">                                                                                                           
                        <label class="col-form-label col-lg-2"><?php echo e(__('Transfer charge')); ?></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="number" name="transfer_charge" max-length="10" value="<?php echo e($set->transfer_charge); ?>" class="form-control">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                                      
                        </div>           
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"><?php echo e(__('Features')); ?></label>
                            <div class="col-lg-6">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->kyc==1): ?>
                                        <input type="checkbox" name="kyc" id="customCheckLogin1" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="kyc" id="customCheckLogin1"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin1">
                                    <span class="text-muted"><?php echo e(__('Know you customer (KYC)')); ?></span>     
                                    </label>
                                </div>                        
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->email_verification==1): ?>
                                        <input type="checkbox" name="email_activation" id="customCheckLogin2" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="email_activation"id="customCheckLogin2"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin2">
                                    <span class="text-muted"><?php echo e(__('Email Verification')); ?></span>     
                                    </label>
                                </div>                       
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->email_notify==1): ?>
                                        <input type="checkbox" name="email_notify" id="customCheckLogin3" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="email_notify"id="customCheckLogin3"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin3">
                                    <span class="text-muted"><?php echo e(__('Email Notification for Automated Emails')); ?></span>     
                                    </label>
                                </div>                        
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->registration==1): ?>
                                        <input type="checkbox" name="registration" id="customCheckLogin4" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="registration"id="customCheckLogin4"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin4">
                                    <span class="text-muted"><?php echo e(__('Accept New Registration')); ?></span>     
                                    </label>
                                </div> 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->referral==1): ?>
                                        <input type="checkbox" name="referral" id="customCheckLogin5" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="referral"id="customCheckLogin5"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin5">
                                    <span class="text-muted"><?php echo e(__('Affiliate System')); ?></span>     
                                    </label>
                                </div>                                 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->recaptcha==1): ?>
                                        <input type="checkbox" name="recaptcha" id="customCheckLogin6" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="recaptcha"id="customCheckLogin6"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin6">
                                    <span class="text-muted"><?php echo e(__('Google Recaptcha v2 for login & Registration')); ?></span>     
                                    </label>
                                </div>                                 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->instant_approval==1): ?>
                                        <input type="checkbox" name="instant_approval" id="customCheckLogins6" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="instant_approval"id="customCheckLogins6"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogins6">
                                    <span class="text-muted"><?php echo e(__('Let Script instantly approve standard investment')); ?></span>     
                                    </label>
                                </div>                                                                                                                         
                            </div>
                            <div class="col-lg-6">                                      
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->upgrade_status==1): ?>
                                        <input type="checkbox" name="upgrade_status" id="customCheckLogin16" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="upgrade_status" id="customCheckLogin16"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin16">
                                    <span class="text-muted"><?php echo e(__('Upgrade Account for Investment Bonus')); ?></span>     
                                    </label>
                                </div>  
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->kyc_restriction==1): ?>
                                        <input type="checkbox" name="kyc_restriction" id="customCheckLogin117" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="kyc_restriction" id="customCheckLogin117"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin117">
                                    <span class="text-muted"><?php echo e(__('Force Kyc on Clients')); ?></span>     
                                    </label>
                                </div>                                
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->p_inv==1): ?>
                                        <input type="checkbox" name="p_inv" id="customCheckLogin118" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="p_inv" id="customCheckLogin118"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin118">
                                    <span class="text-muted"><?php echo e(__('Project Investment')); ?></span>     
                                    </label>
                                </div>                                
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->s_inv==1): ?>
                                        <input type="checkbox" name="s_inv" id="customCheckLogin119" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="s_inv" id="customCheckLogin119"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin119">
                                    <span class="text-muted"><?php echo e(__('Standard Investment')); ?></span>     
                                    </label>
                                </div>                                
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->savings==1): ?>
                                        <input type="checkbox" name="savings" id="customCheckLogin127" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="savings" id="customCheckLogin127"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin127">
                                    <span class="text-muted"><?php echo e(__('Savings')); ?></span>     
                                    </label>
                                </div> 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->transfer==1): ?>
                                        <input type="checkbox" name="transfer" id="customCheckLogin17" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="transfer" id="customCheckLogin17"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin17">
                                    <span class="text-muted"><?php echo e(__('Transfer')); ?></span>     
                                    </label>
                                </div>                                 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->language==1): ?>
                                        <input type="checkbox" name="language" id="customCheckLoginf17" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="language" id="customCheckLoginf17"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLoginf17">
                                    <span class="text-muted"><?php echo e(__('Display Multiple Languages in user and homepage')); ?></span>     
                                    </label>
                                </div>                                                                                                                                                                                                                                                  
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"><?php echo e(__('Homepage Settings')); ?></label>
                            <div class="col-lg-3">                                                                                  
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->blog==1): ?>
                                        <input type="checkbox" name="blog" id="customCheckLogin8" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="blog"id="customCheckLogin8"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin8">
                                    <span class="text-muted"><?php echo e(__('Blog')); ?></span>     
                                    </label>
                                </div>   
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->faq==1): ?>
                                        <input type="checkbox" name="faq" id="customCheckLogin15" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="faq"id="customCheckLogin15"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin15">
                                    <span class="text-muted"><?php echo e(__('Frequently Ask Questions')); ?></span>     
                                    </label>
                                </div>                                                                
                            </div>
                            <div class="col-lg-3">  
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->review==1): ?>
                                        <input type="checkbox" name="review" id="customCheckLogin10" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="review"id="customCheckLogin10"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin10">
                                    <span class="text-muted"><?php echo e(__('Customer Review')); ?></span>     
                                    </label>
                                </div> 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->contact==1): ?>
                                        <input type="checkbox" name="contact" id="customCheckLogin14" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="contact"id="customCheckLogin14"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin14">
                                    <span class="text-muted"><?php echo e(__('Contact us')); ?></span>     
                                    </label>
                                </div>      
                            </div>                            
                            <div class="col-lg-3">  
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->team==1): ?>
                                        <input type="checkbox" name="team" id="customCheckLogin12" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="team"id="customCheckLogin12"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin12">
                                    <span class="text-muted"><?php echo e(__('Team')); ?></span>     
                                    </label>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->stat==1): ?>
                                        <input type="checkbox" name="stat" id="customCheckLogin13" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="stat"id="customCheckLogin13"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin13">
                                    <span class="text-muted"><?php echo e(__('Investment Statistics')); ?></span>     
                                    </label>
                                </div>     
                            </div>
                            <div class="col-lg-3">      
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->services==1): ?>
                                        <input type="checkbox" name="services" id="customCheckLogin9" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="services"id="customCheckLogin9"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin9">
                                    <span class="text-muted"><?php echo e(__('Services')); ?></span>     
                                    </label>
                                </div>  
                                 
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <?php if($set->plan==1): ?>
                                        <input type="checkbox" name="plan" id="customCheckLogin11" class="custom-control-input" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="plan"id="customCheckLogin11"  class="custom-control-input" value="1">
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="customCheckLogin11">
                                    <span class="text-muted"><?php echo e(__('Investment Plan')); ?></span>     
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
                                <textarea type="text" name="email_template" rows="4" class="form-control tinymce"><?php echo e($set->email_template); ?></textarea>
                            </div>
                        </div>                        
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                        </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0"><?php echo e(__('Savings')); ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.savings.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>       
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><?php echo e(__('3 Months')); ?></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" step="any"  name="s_3m" value="<?php echo e($set->s_3m); ?>" class="form-control" required>
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                    
                    </div>                                
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><?php echo e(__('6 Months')); ?></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" step="any"  name="s_6m" value="<?php echo e($set->s_6m); ?>" class="form-control" required>
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                    
                    </div>                                
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><?php echo e(__('9 Months')); ?></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" step="any"  name="s_9m" value="<?php echo e($set->s_9m); ?>" class="form-control" required>
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                    
                    </div>                                
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><?php echo e(__('12 Months')); ?></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" step="any"  name="s_12m" value="<?php echo e($set->s_12m); ?>" class="form-control" required>
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>                                    
                    </div>                                 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><?php echo e(__('Minimum Amount')); ?></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </span>
                                <input type="number" step="any"  name="s_min" value="<?php echo e($set->s_min); ?>" class="form-control" required>
                            </div>
                        </div>                                    
                    </div>  
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>    
        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="mb-0"><?php echo e(__('Security')); ?></h3>
                <p class="mb-0">Don't share credentails with any one</p>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.account.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Username')); ?></label>
                            <div class="col-lg-10">
                                <input type="text" name="username" value="<?php echo e($val->username); ?>" class="form-control">
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Password')); ?></label>
                            <div class="col-lg-10">
                                <input type="password" name="password"  class="form-control">
                            </div>
                        </div>                          
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Recovery Email')); ?></label>
                            <div class="col-lg-10">
                                <input type="email" name="recovery_email"  class="form-control" value="<?php echo e($val->recovery_email); ?>" required>
                                <span class="text-xs">Recovery link will be sent to this email is password is forgotten</span>
                            </div>
                        </div>          
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-block"><?php echo e(__('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>