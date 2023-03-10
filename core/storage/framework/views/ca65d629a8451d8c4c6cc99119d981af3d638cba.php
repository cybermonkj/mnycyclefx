

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-4">
        <h6 class="h2 d-inline-block mb-0 font-weight-bolder"><?php echo e(__('Payout')); ?></h6>
      </div>
      <div class="col-8 text-right">
        <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fad fa-plus"></i> <?php echo e(__('Withdraw request')); ?></a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="mb-0 h3"><?php echo e(__('Create Payout Request')); ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo e(route('withdraw.submit')); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                    <div class="col-lg-12">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                        </div>
                        <input type="number" step="any" name="amount" maxlength="10" id="amount" onkeyup="withdrawcharge()" class="form-control" required="">
                        <input type="hidden" value="<?php echo e($set->withdraw_charge); ?>" id="charge" name="charge">
                      </div>
                      <span class="form-text text-xs">Withdrawal charge is <?php echo e($set->withdraw_charge); ?>%</span>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <select class="form-control select" name="type" required>
                        <option value=""><?php echo e(__('Type')); ?></option>
                        <option value="1"><?php echo e(__('Profit')); ?> - <?php echo e($currency->symbol.number_format($user->profit)); ?></option>
                        <option value="2"><?php echo e(__('Account balance')); ?> - <?php echo e($currency->symbol.number_format($user->balance)); ?></option>
                        <option value="3"><?php echo e(__('Referral earnings')); ?> - <?php echo e($currency->symbol.number_format($user->ref_bonus)); ?></option>
                      </select>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <select class="form-control select" name="coin" data-dropdown-css-class="bg-primary" data-fouc required>
                      <option value=""><?php echo e(__('Method')); ?></option>
                      <?php $__currentLoopData = $method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value='<?php echo e($val->id); ?>'><?php echo e($val->method); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <div class="col-lg-12">
                    <textarea type="text" name="details" rows="4" class="form-control" placeholder="Details" required=""></textarea>
                    </div>
                  </div>                
                  <div class="text-right">
                    <button type="submit" class="btn btn-success btn-block"><?php echo e(__('Request Payout')); ?> <span id="result"></span></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>   
    <div class="row">
      <div class="col-md-12">
        <div class="row"> 
          <?php if(count($withdraw)>0): ?>
            <?php $__currentLoopData = $withdraw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-4">
                <div class="card">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <!-- Title -->
                        <h4 class="mb-0 text-dark"><?php echo e($val->reference); ?></h4>
                      </div>
                      <div class="col-4 text-right">
                        <?php if($val->status==0): ?>
                          <a data-toggle="modal" data-target="#modal-forma<?php echo e($val->id); ?>" href="" class="btn btn-sm btn-success"><?php echo e(__('Update')); ?></a>
                        <?php endif; ?>
                      </div>
                      <div class="col">
                        <p class="text-sm mb-0"><?php echo e(__('Amount')); ?>: <?php echo e(number_format($val->amount).$currency->name); ?></p>
                        <p class="text-sm mb-0"><?php echo e(__('Method')); ?>: <?php echo e($val->wallet['method']); ?></p>
                        <p class="text-sm mb-0"><?php echo e(__('Details')); ?>: <?php echo e($val->details); ?></p>
                        <p class="text-sm mb-0"><?php echo e(__('Type')); ?>: <?php if($val->type==1): ?> <?php echo e(__('Trading profit')); ?> <?php elseif($val->type==2): ?> <?php echo e(__('Account balance')); ?> <?php elseif($val->type==3): ?> <?php echo e(__('Referral bonus')); ?> <?php endif; ?></p>
                        <hr>
                        <p class="text-sm mb-0"><?php echo e(__('Next Settlement')); ?>: <?php if($val->status==0): ?><?php echo e(date("Y/m/d", strtotime($val->next_settlement))); ?> <?php else: ?> - <?php endif; ?></p>
                        <p class="text-sm mb-0"><?php echo e(__('Created')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></p>
                        <p class="text-sm mb-2"><?php echo e(__('Updated')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></p>
                        <span class="badge badge-pill badge-primary"><?php echo e(__('Charge')); ?>: <?php echo e($currency->symbol.number_format($val->charge, 2, '.', '')); ?></span>
                        <?php if($val->status==1): ?>
                          <span class="badge badge-pill badge-success"><i class="fad fa-check"></i> <?php echo e(__('Paid out')); ?></span>
                        <?php elseif($val->status==0): ?>
                          <span class="badge badge-pill badge-danger"><i class="fad fa-spinner"></i>  <?php echo e(__('Pending')); ?></span>                        
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="modal fade" id="modal-forma<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="mb-0"><?php echo e(__('Withdraw Request')); ?></h3>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo e(url('user/withdraw-update')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Method')); ?></label>
                          <div class="col-lg-12">
                            <select class="form-control select" name="coin" data-fouc>
                            <?php $__currentLoopData = $method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value='<?php echo e($valx->id); ?>'
                                <?php if($valx->id==$val->wallet->id): ?>
                                <?php echo e(__('selected')); ?>

                                <?php endif; ?>
                                ><?php echo e($valx->method); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Details')); ?></label>
                          <div class="col-lg-12">
                            <textarea name="details" class="form-control" rows="4"><?php echo e($val->details); ?></textarea>
                            <input name="withdraw_id" type="hidden" value="<?php echo e($val->id); ?>">
                          </div>
                        </div>                
                        <div class="text-right">
                          <button type="submit" class="btn btn-success btn-block"><?php echo e(__('Save')); ?></button>
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
              <div class="mb-3">
                <img src="<?php echo e(url('/')); ?>/asset/images/empty.svg">
              </div>
              <h3 class="text-dark">No Payout</h3>
              <p class="text-dark text-sm card-text">We couldn't find any payouts money request to this account</p>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <div class="row">
          <div class="col-md-12">
          <?php echo e($withdraw->links('pagination::bootstrap-4')); ?>

          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/kingsmen/new/core/resources/views/user/profile/withdraw.blade.php ENDPATH**/ ?>