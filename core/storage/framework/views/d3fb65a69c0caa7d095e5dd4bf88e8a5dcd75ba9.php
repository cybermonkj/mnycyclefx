<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-12">
        <h6 class="h2 d-inline-block mb-0 font-weight-bolder"><?php echo e(__('Followed Plans')); ?></h6>
      </div>
    </div>
    <div class="row align-items-center"> 
      <?php if(count($followed)>0): ?> 
        <?php $__currentLoopData = $followed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-lg-4">
            <div class="card">
            <a href="<?php echo e(route('view.sandplan', ['id' => $val->plan['slug']])); ?>">
              <img class="card-img-top" src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($val->plan['image']); ?>" alt="Image placeholder">
            </a>
              <div class="card-body">
                <span class="text-sm text-muted mb-0"><?php echo e($val->plan['original']-$val->plan['units']); ?> / <?php echo e($val->plan['original']); ?> Units Sold</span>
                <div class="progress progress mb-3">
                  <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e((($val->plan['original']-$val->plan['units'])*100)/$val->plan['original']); ?>%;"></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <a href="<?php echo e(route('view.sandplan', ['id' => $val->plan['slug']])); ?>">
                            <h5 class="h2 card-title mb-0 font-weight-bolder"><?php echo e($val->plan['name']); ?></h5>
                        </a>
                    </div>
                    <div class="col-4 text-right">
                        <a data-toggle="modal" data-target="#share<?php echo e($val->plan['id']); ?>" title="share" href=""><i class="fal fa-external-link"></i></a>
                    </div>
                </div>
                <small class="text-muted"><?php echo e($val->plan['location']); ?> - <?php echo e($val->plan['duration'].' '.$val->plan['period']); ?></small>
                <p class="text-sm text-dark mb-0"><span class="text-primary h3 font-weight-bolder"><?php echo e($val->plan['interest']); ?>%</span> Returns in <?php echo e($val->plan['duration'].' '.$val->plan['period']); ?></p>
                <p class="text-sm text-dark mb-0"><span class="text-success h4 font-weight-bolder"><?php echo e($currency->symbol.$val->plan['price']); ?></span> per Unit</p>
                <p class="text-sm text-dark mb-0"><?php if($val->plan['ref_percent']!=null): ?><?php echo e($val->plan['ref_percent']); ?>% <?php else: ?> <?php echo e(__('No')); ?> <?php endif; ?><?php echo e(__('Referral Bonus')); ?></p>
                <div class="row justify-content-between align-items-center">
                    <div class="col-6">
                        <span class="form-text text-sm text-dark"><?php echo e(__('Opening Date')); ?></span>
                        <span class="form-text text-xs text-muted"><?php echo e(date("Y/m/d h:i:A", strtotime($val->plan['start_date']))); ?></span>
                    </div>
                    <div class="col-6"> 
                        <span class="form-text text-sm text-dark"><?php echo e(__('Maturity Date')); ?></span>
                        <span class="form-text text-sm text-muted"><?php echo e(date("Y/m/d h:i:A", strtotime($val->plan['expiring_date']))); ?></span> 
                    </div>
                </div>    
                  <?php
                    $check=App\Models\Sandfollowed::whereplan_id($val->plan['id'])->whereuser_id($user->id)->get();     
                    $ss=App\Models\Sandfollowed::whereplan_id($val->plan['id'])->whereuser_id($user->id)->first();     
                  ?> 
                  <div class="row justify-content-between align-items-center">
                    <div class="col-6 text-left"> 
                      <?php if(count($check)>0): ?>
                        <a href="<?php echo e(route('unfollow', ['id' => $val->plan['id']])); ?>" class="text-uppercase text-xs">unfollow<i class="fad fa-angle-right fa-sm ml-1"></i></a>
                      <?php endif; ?>
                    </div>
                  </div>        
              </div>
            </div>
          </div>
          <div class="modal fade" id="share<?php echo e($val->plan['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="mb-0 font-weight-bolder"><?php echo e(__('Share')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form>
                        <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="input-group">
                            <input type="text" class="form-control" value="<?php echo e(route('check.plan', ['id' => $val->plan['slug']])); ?>">   
                            <div class="input-group-prepend">
                                <span class="input-group-text btn-icon-clipboard text-xs" data-clipboard-text="<?php echo e(route('check.plan', ['id' => $val->plan['slug']])); ?>" title="Copy to clipboard">Copy link</span>
                            </div> 
                            </div>
                        </div>
                        </div>
                        <div class="text-center">
                        <?php echo QrCode::eye('circle')->style('round')->size(250)->generate(route('check.plan', ['id' => $val->plan['slug']]));; ?> 
                        </div>      
                        <div class="text-center mb-3 mt-3">
                        <p>Scan QR code or Share using:</p>
                        </div>                    
                        <div class="text-center">      
                        <a href="https://wa.me/?text=<?php echo e(route('check.plan', ['id' => $val->plan['slug']])); ?>" target="_blank" class="btn btn-slack btn-icon-only">
                            <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                        </a>                           
                        <a href="mailto:?body=<?php echo e(route('check.plan', ['id' => $val->plan['slug']])); ?>" class="btn btn-twitter btn-icon-only">
                            <span class="btn-inner--icon"><i class="fal fa-envelope"></i></span>
                        </a>                                                  
                        </div>
                    </form>
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
                    <span class="btn-inner--icon"><i class="fad fa-sad-tear fa-4x"></i></span>
                </a>
            </div>
            <h3 class="text-dark">No Plans</h3>
            <p class="text-dark text-sm card-text"><?php echo e(__('You have not followed any plan')); ?></p>
          </div>
        </div>
      <?php endif; ?>      
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/user/trading/followed.blade.php ENDPATH**/ ?>