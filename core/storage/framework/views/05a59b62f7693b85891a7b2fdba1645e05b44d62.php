<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">  
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0 text-dark font-weight-bolder"><?php echo e(__('Affiliate Earnings')); ?></h3>
          </div>
          <div class="table-responsive py-4">
            <table class="table table-flush" id="datatable-buttons">
              <thead>
                <tr>
                  <th><?php echo e(__('S / N')); ?></th>
                  <th><?php echo e(__('Amount')); ?></th>
                  <th><?php echo e(__('From')); ?></th>
                  <th><?php echo e(__('Type')); ?></th>
                  <th><?php echo e(__('Created')); ?></th>
                </tr>
              </thead>
              <tbody>  
                <?php $__currentLoopData = $earning; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(++$k); ?>.</td>
                    <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                    <td><?php if($val->ref_id!=null): ?><?php echo e($val->shared['first_name']); ?> <?php echo e($val->shared['last_name']); ?> <?php else: ?> [Account Deleted]<?php endif; ?></td>
                    <td><?php if($val->type==0): ?> Standard Investment <?php else: ?> Project Investment <?php endif; ?></td>
                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <?php if($set->referral==1): ?>
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h4 class="card-title mb-0 font-weight-bolder"><?php echo e(__('Affiliate Bonus')); ?></h4>
                <span class="mb-0 text-dark"><?php echo e($currency->symbol.number_format($user->ref_bonus)); ?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-3"><?php echo e(__('Affiliate link')); ?></h4>
            <p class="text-dark text-sm"><?php echo e(__('Automatically Top up your Balance by Sharing your Affiliate Link, Earn a percentage of whatever Plan your Referred user Buys.')); ?></p>
            <?php if($set->referral_type=="username"): ?>
            <span class="text-dark text-sm"><?php echo e($user->username); ?></span><br>
            <button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e($user->username); ?>" title="Copy"><?php echo e(__('Copy')); ?></button>
            <?php else: ?>
            <span class="text-dark text-sm"><?php echo e(route('referral', ['id'=>$user->merchant_id])); ?></span><br>
            <button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e(route('referral', ['id'=>$user->merchant_id])); ?>" title="Copy"><?php echo e(__('Copy')); ?></button>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>
          <div class="card">
            <div class="card-header border-0">
              <div class="row">
                <div class="col-6">
                  <h4 class="mb-0">Referrals</h4>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <tbody>
                  <?php $__currentLoopData = $referral; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="table-user">
                        <img src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($val['image']); ?>" class="avatar rounded-circle mr-3">
                      </td>                      
                      <td>
                        <?php echo e($val->first_name); ?> <?php echo e($val->last_name); ?>

                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      </div> 
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/user/profile/referral.blade.php ENDPATH**/ ?>