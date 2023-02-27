<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
  <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral mb-5"><i class="fal fa-plus"></i> <?php echo e(__('Send money')); ?></a>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="mb-0"><?php echo e(__('Transfer money')); ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo e(route('submit.ownbank')); ?>" method="post" id="modal-details">
                  <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                      <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">#</span>
                      </div>
                      <input type="text" class="form-control" placeholder="<?php echo e(__('Merchant ID')); ?>" name="merchant_id" maxlength="6" required>
                      </div>
                    </div>  
                    <div class="form-group row">
                      <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                      <div class="col-lg-12">
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                          </span>
                          <input type="number" class="form-control" name="amount" id="amount" onchange="transfercharge()" required>
                          <input type="hidden" name="charge" id="charge" value="<?php echo e($set->transfer_charge); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-12">
                        <select class="form-control select" name="type" required>
                            <option value=""><?php echo e(__('Debit From')); ?></option>
                            <option value="1"><?php echo e(__('Profit')); ?> - <?php echo e($currency->symbol.number_format($user->profit)); ?></option>
                            <option value="2"><?php echo e(__('Account balance')); ?> - <?php echo e($currency->symbol.number_format($user->balance)); ?></option>
                            <option value="3"><?php echo e(__('Referral earnings')); ?> - <?php echo e($currency->symbol.number_format($user->ref_bonus)); ?></option>
                        </select>
                      </div>
                    </div>     
                    <div class="custom-control custom-control-alternative custom-checkbox mb-5">
                        <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="terms" checked required>
                        <label class="custom-control-label" for=" customCheckLogin">
                                <p class="text-muted">This transaction requires your consent before continuing. Read <a href="<?php echo e(route('terms')); ?>">Terms & Conditions</a></p>
                        </label>
                    </div>                   
                    <div class="text-center">
                    <button type="submit" class="btn btn-neutral btn-block" form="modal-details"><?php echo e(__('Send')); ?> <span id="result"></span></button>
                    <span class="text-xs form-text">Transfer Charge is <?php echo e($set->transfer_charge); ?>%</span>
                    </div>         
                </form>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="row">  
          <?php if(count($transfer)>0): ?>
            <?php $__currentLoopData = $transfer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-6">
              <div class="card">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8">
                        <!-- Title -->
                        <h5 class="h4 mb-0 text-dark">#<?php echo e($val->ref_id); ?></h5>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Amount')); ?>: <?php echo e($currency->symbol.number_format($val->amount)); ?></p>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Charge')); ?>: <?php echo e($currency->symbol.number_format($val->charge)); ?></p>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->receiver['email']); ?></p>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Status')); ?>: <?php if($val->status==1): ?>Confirmed <?php elseif($val->status==0): ?>Pending <?php elseif($val->status==2): ?>Returned <?php endif; ?></p>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Created')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></p>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Updated')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></p>
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
                    <span class="btn-inner--icon"><i class="fal fa-random fa-4x"></i></span>
                </a>
              </div>
              <h3 class="text-dark">No Transfer Request</h3>
              <p class="text-dark text-sm card-text">We couldn't find any transfer request to this account</p>
            </div>
          </div>
          <?php endif; ?>
        </div> 
        <div class="row">
          <div class="col-md-12">
          <?php echo e($transfer->links('pagination::bootstrap-4')); ?>

          </div>
        </div>
      </div> 
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4">
                <?php echo e(__('Statistics')); ?>

                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> <?php echo e(__('Sent')); ?></span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($sent)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle"><?php echo e(__('Pending')); ?></span><br>
                  <span class="surtitle "><?php echo e(__('Total')); ?></span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($pending)); ?>.00</span><br>
                  <span class="surtitle"><?php echo e($currency->name); ?> <?php echo e(number_format($total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/user/transfer/index.blade.php ENDPATH**/ ?>