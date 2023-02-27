

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-4">
        <h6 class="h2 d-inline-block mb-0 font-weight-bolder"><?php echo e(__('Payouts')); ?></h6>
      </div>
      <div class="col-8 text-right">
        <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fal fa-plus"></i> <?php echo e(__('Request payout')); ?></a>
      </div>
    </div>
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
                <div class="col-lg-12">
                  <select class="form-control select" name="coin" id="method" onkeyup="setwithdrawcharge()" required>
                  <option value=''><?php echo e(__('Select Payout Method')); ?></option>
                  <?php $__currentLoopData = $method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value='<?php echo e($val->id); ?>*<?php if($val->fiat_charge!=null): ?><?php echo e($val->fiat_charge); ?><?php else: ?> 0 <?php endif; ?>*<?php if($val->percent_charge!=null): ?><?php echo e($val->percent_charge); ?><?php else: ?> 0 <?php endif; ?>*<?php echo e($val->min); ?>*<?php echo e($val->max); ?>*<?php echo e($val->requirements); ?>'><?php echo e($val->method); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <span class="text-xs text-gray" id="xx"></span>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                    </div>
                    <input type="number" step="any" name="amount" maxlength="10" id="withdraw_amount" onkeyup="withdrawcharge()" class="form-control" placeholder="0.00" required>
                    <input type="hidden" id="percent_charge" name="percent_charge">
                    <input type="hidden" id="fiat_charge" name="fiat_charge">
                  </div>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-lg-12">
                  <select class="form-control select" name="type" required>
                    <option value=""><?php echo e(__('Debit From')); ?></option>
                    <option value="1"><?php echo e(__('Profit')); ?> - <?php echo e($currency->symbol.number_format($user->profit,2)); ?></option>
                    <option value="2"><?php echo e(__('Account balance')); ?> - <?php echo e($currency->symbol.number_format($user->balance,2)); ?></option>
                    <option value="3"><?php echo e(__('Referral earnings')); ?> - <?php echo e($currency->symbol.number_format($user->ref_bonus,2)); ?></option>
                  </select>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-lg-12">
                <textarea type="text" name="details" rows="4" id="details" class="form-control" placeholder="Details" required=""></textarea>
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
    <div class="row">
      <div class="col-md-8">
        <div class="row"> 
          <?php if(count($withdraw)>0): ?>
            <?php $__currentLoopData = $withdraw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-6">
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
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Amount')); ?>: <?php echo e(number_format($val->amount, 2, '.', '').$currency->name); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Method')); ?>: <?php echo e($val->wallet['method']); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Details')); ?>: <?php echo e($val->details); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Type')); ?>: <?php if($val->type==1): ?> <?php echo e(__('Trading profit')); ?> <?php elseif($val->type==2): ?> <?php echo e(__('Account balance')); ?> <?php elseif($val->type==3): ?> <?php echo e(__('Referral bonus')); ?> <?php endif; ?></p>
                        <hr>
                        <?php if($set->ns==1): ?>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Next Settlement')); ?>: <?php echo e(date("Y/m/d", strtotime($val->next_settlement))); ?></p>
                        <?php else: ?>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Due By')); ?>: <?php if($val->status==0): ?><?php echo e(date("Y/m/d", strtotime($val->next_settlement))); ?> <?php else: ?> - <?php endif; ?></p>
                        <?php endif; ?>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Created')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></p>
                        <p class="text-sm text-dark mb-2"><?php echo e(__('Updated')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></p>
                        <span class="badge badge-pill badge-primary"><?php echo e(__('Charge')); ?>: <?php echo e($currency->symbol.number_format($val->charge, 2, '.', '')); ?></span>
                        <?php if($val->status==1): ?>
                          <span class="badge badge-pill badge-success"><i class="fal fa-check"></i> <?php echo e(__('Paid out')); ?></span>
                        <?php elseif($val->status==0): ?>
                          <span class="badge badge-pill badge-danger"><i class="fal fa-spinner"></i>  <?php echo e(__('Pending')); ?></span>                         
                        <?php elseif($val->status==2): ?>
                          <span class="badge badge-pill badge-danger"><i class="fal fa-ban"></i>  <?php echo e(__('Declined')); ?></span>                        
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
                      <h3 class="mb-0"><?php echo e(__('Edit Payout Details')); ?></h3>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo e(url('user/withdraw-update')); ?>" method="post">
                        <?php echo csrf_field(); ?> 
                        <div class="form-group row">
                          <div class="col-lg-12">
                            <textarea name="details" class="form-control" rows="4" placeholder="<?php echo e($val->wallet->requirements); ?>"><?php echo e($val->details); ?></textarea>
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
              <div class="btn-wrapper text-center">
                <a href="javascript:void;" class="btn btn-neutral btn-icon mb-3">
                    <span class="btn-inner--icon"><i class="fal fa-calendar fa-4x"></i></span>
                </a>
              </div>
              <h3 class="text-dark"><?php echo e(__('No Payout')); ?></h3>
              <p class="text-dark text-sm card-text"><?php echo e(__('We couldn\'t find any payouts money request to this account')); ?></p>
              <div class="row align-items-center py-4">
                <div class="col-12">
                  <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fal fa-plus"></i> <?php echo e(__('First Payout Request')); ?></a>
                </div>
              </div>
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
      <div class="col-md-4">
        <?php if($set->ns==1): ?>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h3 class="mb-0 h4 font-weight-bolder"><?php echo e(__('Next Settlement')); ?></h3>
                  <ul class="list list-unstyled mb-0">
                    <li><span class="text-default text-sm"><?php echo e(date("Y/m/d", strtotime($set->next_settlement))); ?></span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo e(__('Profit')); ?> - <?php echo e($currency->symbol.number_format($user->profit, 2)); ?></li>
            <li class="list-group-item"><?php echo e(__('Account balance')); ?> - <?php echo e($currency->symbol.number_format($user->balance, 2)); ?></li>
            <li class="list-group-item"><?php echo e(__('Referral earnings')); ?> - <?php echo e($currency->symbol.number_format($user->ref_bonus, 2)); ?></li>
          </ul>
        </div>
        <div class="card widget-calendar">
            <!-- Card header -->
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <!-- Title -->
                  <h5 class="h4 mb-0">Payout Method</h5>
                </div>
              </div>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <ul class="list-group list-group-flush list my--3">
                <?php $__currentLoopData = $method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="list-group-item px-0">
                    <div class="row align-items-center">
                      <div class="col-12">
                      <h5 class="mb-0"><?php echo e($val->method); ?></h5>
                      </div>
                      <div class="col">
                        <small>Limit</small>
                        <h5 class="mb-0"><?php echo e($val->min); ?>-<?php echo e($val->max); ?><?php echo e($currency->name); ?></h5>
                      </div>
                      <?php if($set->ns==0): ?>
                      <div class="col">
                        <small>Duration</small>
                        <h5 class="mb-0"><?php echo e($val->period); ?> <?php echo e($val->duration); ?>(s)</h5>
                      </div>
                      <?php endif; ?>
                      <div class="col">
                        <small>Charge</small>
                        <h5 class="mb-0"><?php if($val->percent_charge!=null): ?><?php echo e($val->percent_charge); ?>% <?php else: ?> 0% <?php endif; ?>+ <?php if($val->fiat_charge!=null): ?><?php echo e($val->fiat_charge); ?> <?php else: ?> 0 <?php endif; ?><?php echo e($currency->name); ?></h5>
                      </div>
                    </div>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/user/profile/withdraw.blade.php ENDPATH**/ ?>