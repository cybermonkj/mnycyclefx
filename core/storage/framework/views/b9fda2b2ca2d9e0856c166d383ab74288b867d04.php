

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row" id="earnings">
      <div class="col-lg-12">
        <div class="row">
          <?php if(count($activity)>0): ?>
            <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $date_diffx=date_diff(date_create($val->date), date_create($val->end_date));
                $claimed=App\Models\Claimed::whereprofit_id($val->id)->sum('amount');
                $bonus=$val->amount*$val->c_bonus/100;
                $c=$val->recurring;
                $goalx=$val->compound*$val->amount/100;
                $goal=$val->compound*$val->amount/100;
                $profitx=$goalx-$val->amount;
                $profit=$goalx-$val->amount;
                $pp=$val->compound*$val->amount/100;
              ?>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header checkx">
                    <div class="row align-items-center">
                      <div class="col-6">
                        <h4 class="mb-1 h4 text-dark font-weight-bolder"><?php echo e($val->trx); ?></h4>
                      </div>
                      <div class="col-6 text-right">
                        <?php if($val->claim==1): ?>
                          <?php if($val->status!=2): ?>
                            <a href="#" data-toggle="modal" data-target="#history<?php echo e($val->id); ?>" class="btn btn-sm btn-neutral">
                            <i class="fal fa-sync"></i> <?php echo e(__('History')); ?></a>
                            <a href="#" data-toggle="modal" data-target="#claim<?php echo e($val->id); ?>" class="btn btn-sm btn-neutral">
                            <i class="fal fa-smile"></i> <?php echo e(__('Claim Profit')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row align-items-center mb-3">
                      <div class="col-6">                 
                        <p class="text-sm text-gray mb-0 text-uppercase"><?php echo e($val->plan->name); ?> <?php echo e(__('Plan')); ?> <?php echo e($val->duration); ?>(s)</p>
                        <p class="text-sm text-dark mb-0 text-uppercase"><?php echo e(date("M j, Y", strtotime($val->date))); ?> - <?php echo e(date("M j, Y", strtotime($val->end_date))); ?></p>
                        <p class="text-sm text-dark mb-0 text-uppercase"><?php echo e(__('Invested')); ?> <?php echo e($val->amount.$currency->name); ?></p>
                        <p class="text-sm text-dark mb-2 text-uppercase"><?php echo e($val->plan->percent); ?>% <?php echo e(__('Daily')); ?></p>
                        <?php if($val->status==1): ?>   
                        <h4 class="mb-1 h2 text-primary font-weight-bolder"><?php echo e($val->profit.$currency->name); ?></h4>
                        <?php elseif($val->status==3 || $val->status==4): ?> 
                        <h4 class="mb-1 h2 text-primary font-weight-bolder">0<?php echo e($currency->name); ?></h4>
                        <?php endif; ?>
                        <h5 class="h4 mb-0 text-dark text-uppercase"><?php echo e(__('Current Progress')); ?></h5>
                      </div>
                      <div class="col-6 text-right">
                        <h4 class="mb-1 h2 text-darker font-weight-bolder">GOAL <?php echo e($goal.$currency->name); ?></h4>
                        <p class="text-sm text-dark mb-0 text-uppercase"><?php echo e(__('ROI')); ?> - <?php echo e($profit.$currency->name); ?></p>
                        <?php if($val->plan->bonus!=null): ?><p class="text-sm text-dark mb-0 text-uppercase"><?php echo e(__('Bonus')); ?> - <?php echo e($bonus.$currency->name); ?></p><?php endif; ?>
                      </div>
                    </div>
                    <div class="row align-items-center mb-3">
                      <div class="col">                           
                        <div class="progress mb-0">
                        <?php if($val->status==1): ?>     
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(($val->profit*100)/$pp); ?>%;"></div>
                        <?php elseif($val->status==3 || $val->status==4): ?> 
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>
                        <?php endif; ?>    
                        </div>
                      </div>
                    </div>
                    <div class="row align-items-center mb-1"> 
                      <?php if($val->status==1): ?>             
                        <div class="col-12">
                          <?php if($val->recurring==1): ?>
                            <?php if($val->c_r==1): ?>
                            <a href="<?php echo e(url('/')); ?>/user/cancel-recurring/<?php echo e($val->trx); ?>" class="btn btn-sm btn-danger"><i class="fal fa-ban"></i> <?php echo e(__('Cancel Recurring')); ?></a>
                            <?php elseif($val->c_r==0): ?>
                            <a href="<?php echo e(url('/')); ?>/user/start-recurring/<?php echo e($val->trx); ?>" class="btn btn-sm btn-success"><i class="fal fa-check"></i> <?php echo e(__('Start Recurring')); ?></a>
                            <?php endif; ?>
                          <?php endif; ?>
                          <a href="#" data-toggle="modal" data-target="#share<?php echo e($val->id); ?>" title="Share trading activity" class="btn btn-sm btn-neutral"><i class="fal fa-share"></i> <?php echo e(__('Share')); ?></a>
                        </div>   
                      <?php endif; ?>
                    </div>
                    <div class="row align-items-center"> 
                      <?php if($val->status==1): ?>                 
                        <div class="col-12">
                          <?php if($val->claim==1): ?><span class="mb-1 text-xs text-muted text-uppercase"> <?php echo e(__('Claimed')); ?> - <?php echo e($val->claimed.$currency->name); ?> | <?php echo e(__('Unclaimed')); ?> - <?php echo e($profitx-$claimed.$currency->name); ?></span><?php endif; ?>
                        </div>
                      <?php endif; ?>                      
                      <?php if($val->status==2): ?>                 
                        <div class="col-12">
                          <span class="badge badge-pill badge-primary"> <?php echo e(__('Ended')); ?> </span>
                        </div>
                      <?php endif; ?>                       
                      <?php if($val->status==3): ?>                 
                        <div class="col-12">
                          <span class="badge badge-pill badge-primary"> <?php echo e(__('Under Review')); ?> </span>
                        </div>  
                      <?php endif; ?>                    
                      <?php if($val->status==4): ?>                 
                        <div class="col-12">
                          <span class="badge badge-pill badge-primary"> <?php echo e(__('Declined')); ?> </span>
                        </div>
                      <?php endif; ?>                  
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="claim<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card border-0 mb-0">
                          <div class="card-header bg-transparent pb-5">
                            <div class="text-dark text-center mt-2 mb-3"><small><?php echo e($val->name); ?></small></div>
                            <div class="btn-wrapper text-center">
                            <?php if(($goal-$val->amount)<$val->real_profit): ?>
                              <h1 class="text-uppercase ls-1 text-primary py-1 mb-0">Available <?php echo e(number_format($profit-$claimed,2).$currency->name); ?></h1>
                              <p class="text-uppercase text-sm text-dark mb-0">Unavailable 0<?php echo e($currency->name); ?></p>
                            <?php else: ?>
                              <h1 class="text-uppercase ls-1 text-primary py-1 mb-0">Available <?php echo e(number_format($val->real_profit-$claimed,2).$currency->name); ?></h1>
                              <p class="text-uppercase text-sm text-dark mb-0">unavailable <?php echo e(number_format($profitx-$val->real_profit,2).$currency->name); ?></p>
                            <?php endif; ?>
                            </div>
                          </div>
                          <div class="card-body">
                            <form role="form" action="<?php echo e(route('claim_profit')); ?>" method="post">
                              <?php echo csrf_field(); ?>    
                              <input type="hidden" name="activity" value="<?php echo e($val->id); ?>">   
                              <div class="form-group row">
                                <div class="col-lg-12">
                                  <div class="input-group">
                                      <span class="input-group-prepend">
                                          <span class="input-group-text text-uppercase"><?php echo e($currency->symbol); ?></span>
                                      </span>
                                      <?php if(($goal-$val->amount)<$val->real_profit): ?>
                                        <input type="number" step="any" class="form-control" name="amount" max="<?php echo e($profit-$claimed); ?>" required>
                                      <?php else: ?>
                                        <input type="number" step="any" class="form-control" name="amount" max="<?php echo e($val->real_profit-$claimed); ?>" required>
                                      <?php endif; ?>
                                      
                                  </div>
                                </div>
                              </div>                            
                              <div class="text-center">
                                <button type="submit" class="btn btn-neutral btn-block my-4"><?php echo e(__('Transfer to available profit')); ?></button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="recurring<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card border-0 mb-0">
                          <div class="card-header bg-transparent pb-5 checkx">
                            <h4 class="text-dark text-center mt-2 mb-3 text-uppercase er"><?php echo e(__('Recurring Capital')); ?></h4>
                            <p class="text-dark text-center text-sm"><?php echo e(__('Once recurring payment is active, capital will be retained until end of investment.')); ?></p>
                          </div>
                          <div class="card-body">
                            <h4 class="text-dark text-center mt-2 mb-3 text-uppercase er"><?php echo e(__('Extend investment duration')); ?></h4>
                            <p class="text-dark text-center text-sm"><?php echo e(__('You will not have access to cancel this once saved.')); ?></p>
                            <form role="form" action="<?php echo e(route('start-recurring')); ?>" method="post">
                            <?php echo csrf_field(); ?> 
                              <input type="hidden" name="plan" value="<?php echo e($val->id); ?>">   
                              <div class="form-group row">
                                <div class="col-lg-12">
                                  <div class="input-group">
                                      <span class="input-group-prepend">
                                          <span class="input-group-text text-uppercase"><?php echo e(__('By')); ?></span>
                                      </span>
                                      <input type="number" class="form-control" name="duration" value="1" min="1">
                                      <span class="input-group-append">
                                          <span class="input-group-text text-uppercase"><?php echo e($val->plan->period); ?></span>
                                      </span>
                                  </div>
                                </div>
                              </div>                             
                              <div class="text-center">
                                <button type="submit" class="btn btn-success btn-block my-4"><?php echo e(__('Save')); ?></button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="share<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered  modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card border-0 mb-0">
                          <div class="card-header bg-transparent pb-1">
                            <div class="text-dark text-center mt-2 mb-3 text-uppercase er"><?php echo e(__('Share Activity')); ?></div>
                          </div>
                          <div class="card-body">
                            <?php
                            if($set->referral_type=="url"){
                              $ref='Register with the link, '.route("referral", ["id"=>$user->merchant_id]).' to start earning.';
                            }else{
                              $ref='Register with username, '.$user->username.' to start earning.';
                            }
                            $message='I have currently earned '.$val->profit.$currency->name.' with '.$set->site_name.'. '.$ref;
                            ?>
                            <form role="form" action="" method="post">
                              <div class="form-group mb-3">
                                <textarea type="text"rows="5" name="address" class="form-control"><?php echo e($message); ?></textarea>
                              </div>
                              <div class="text-right">
                              <button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php if($set->referral_type=='username'): ?><?php echo e($user->username); ?> <?php else: ?> <?php echo e(route('referral', ['id'=>$user->merchant_id])); ?> <?php endif; ?>" title="Copy"><?php echo e(__('Copy')); ?></button>
                              </div>
                              <hr>
                              <div class="text-center"> 
                                <a href="https://wa.me/?text=<?php echo e($message); ?>" target="_blank" class="btn btn-slack btn-icon-only">
                                    <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                                </a>                           
                                <a href="mailto:?body=<?php echo e($message); ?>" class="btn btn-twitter btn-icon-only">
                                    <span class="btn-inner--icon"><i class="fal fa-envelope"></i></span>
                                </a>                                              
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>            
                <div class="modal fade" id="history<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card border-0 mb-0">
                          <div class="card-header bg-transparent pb-1 checkx">
                            <div class="text-dark text-center mt-2 mb-3 text-uppercase er"><?php echo e(__('Profit Claiming Log')); ?></div>
                          </div>
                          <div class="">
                            <div class="table-responsive">
                              <table class="table align-items-center table-flush">
                                <tbody>
                                  <?php $history=App\Models\Claimed::whereprofit_id($val->id)->get(); ?>
                                  <?php if(count($history)>0): ?>
                                    <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$hval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>                     
                                        <td><?php echo e($currency->symbol.$hval->amount); ?></td>
                                        <td>#<?php echo e($hval->ref); ?></td>
                                        <td><?php echo e(date("M j, Y", strtotime($hval->date))); ?></td>
                                      </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php else: ?>
                                    <tr>                     
                                      <td class="text-center"><?php echo e(__('Nothing found')); ?></td>
                                    </tr>
                                  <?php endif; ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <div class="col-md-12 mb-5">
            <div class="text-center mt-8">
              <div class="btn-wrapper text-center">
                  <a href="javascript:void;" class="btn btn-neutral btn-icon mb-3">
                      <span class="btn-inner--icon"><i class="fal fa-sad-tear fa-4x"></i></span>
                  </a>
              </div>
              <h3 class="text-dark">No Activity</h3>
              <p class="text-dark text-sm card-text">We couldn't find any investment activity to this account</p>
              <div class="row align-items-center py-4">
                <div class="col-12">
                  <a href="<?php echo e(route('user.plans')); ?>" class="btn btn-sm btn-primary"><i class="fal fa-plus"></i> <?php echo e(__('Purchase your first plan')); ?></a>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/user/trading/trades.blade.php ENDPATH**/ ?>