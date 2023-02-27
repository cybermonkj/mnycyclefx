<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 <?php if(route('user.sandtrades')==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fal fa-sledding fa-lg"></i> <?php echo e(__('Investment')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 <?php if(route('user.sandsharing')==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-retweet"></i> <?php echo e(__('Sharing History')); ?></a>
                    </li>                   
                </ul>
            </div>
        </div>
      </div>          
    </div>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade <?php if(route('user.sandtrades')==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
        <div class="row">
          <?php if(count($profit)>0): ?>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="mb-0"><?php echo e(__('Transactions')); ?></h3>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons">
                    <thead>
                        <tr>
                        <th><?php echo e(__('S / N')); ?></th>
                        <th></th>
                        <th></th>
                        <th><?php echo e(__('Ref ID')); ?></th>
                        <th><?php echo e(__('Units')); ?></th>
                        <th><?php echo e(__('Amount')); ?></th>
                        <th><?php echo e(__('ROI')); ?></th>
                        <th><?php echo e(__('Status')); ?></th>
                        <th><?php echo e(__('Started')); ?></th>
                        <th><?php echo e(__('End date')); ?></th>
                        </tr>
                    </thead>
                    <tbody>  
                        <?php $__currentLoopData = $profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$k); ?>.</td>
                            <td><a href="<?php echo e(route('view.sandplan', ['id' => $val->plan['slug']])); ?>">Plan Updates</a></td>
                            <td><a data-toggle="modal" <?php if($val->status==2): ?> disabled <?php endif; ?> data-target="#share<?php echo e($val->id); ?>" title="share" href="">Share Units</a></td>
                            <td>#<?php echo e($val->trx); ?></td>
                            <td><?php echo e($val->units); ?></td>
                            <td><?php echo e($currency->symbol.number_format($val->amount, '2', '.', '')); ?></td>
                            <td><?php echo e($currency->symbol.number_format($val->profit-$val->amount, '2', '.', '')); ?></td>
                            <td><?php if($val->status==1): ?> Running <?php else: ?> Ended <?php endif; ?></td>
                            <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                            <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->expiring_date))); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                  <?php $__currentLoopData = $profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="modal fade" id="share<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card border-0 mb-0">
                            <div class="card-header bg-transparent pb-5">
                                <div class="text-dark text-center mt-2 mb-3"><small><?php echo e(__('Share Units')); ?></small></div>
                                <div class="btn-wrapper text-center">
                                <h4 class="text-uppercase ls-1 text-dark py-3 mb-0"><?php echo e($val->plan['name']); ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" action="<?php echo e(route('user.sandshare_plan')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="<?php echo e(__('Units')); ?>" name="units" min="1" max="<?php echo e($val->units); ?>" required>
                                    <input type="hidden" name="trx" value="<?php echo e($val->trx); ?>">
                                    </div>
                                </div>                            
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="<?php echo e(__('Merchant ID')); ?>" name="merchant_id" maxlength="6" required>
                                    </div>
                                </div>      
                                <div class="custom-control custom-control-alternative custom-checkbox mb-5">
                                    <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="terms" checked required>
                                    <label class="custom-control-label" for=" customCheckLogin">
                                            <p class="text-muted">This transaction requires your consent before continuing. Read <a href="<?php echo e(route('terms')); ?>">Terms & Conditions</a></p>
                                    </label>
                                </div>                                               
                                <div class="text-center">
                                    <button type="submit" class="btn btn-neutral btn-block"><?php echo e(__('Send Unit')); ?></button>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
            </div>
          <?php else: ?>
            <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">You have not invested on any plan</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="tab-pane fade <?php if(route('user.sandsharing')==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
        <div class="row">
          <?php if(count($sharing)>0): ?>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="mb-0"><?php echo e(__('Transactions')); ?></h3>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons2">
                    <thead>
                        <tr>
                        <th><?php echo e(__('S / N')); ?></th>
                        <th></th>
                        <th><?php echo e(__('Ref ID')); ?></th>
                        <th><?php echo e(__('Units')); ?></th>
                        <th><?php echo e(__('Amount')); ?></th>
                        <th><?php echo e(__('ROI')); ?></th>
                        <th><?php echo e(__('Status')); ?></th>
                        <th><?php echo e(__('Started')); ?></th>
                        <th><?php echo e(__('End date')); ?></th>
                        </tr>
                    </thead>
                    <tbody>  
                        <?php $__currentLoopData = $sharing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$k); ?>.</td>
                            <td><a href="<?php echo e(route('view.sandplan', ['id' => $val->plan['slug']])); ?>">Plan</a></td>
                            <td>#<?php echo e($val->trx); ?></td>
                            <td><?php echo e($val->units); ?></td>
                            <td><?php echo e($currency->symbol.number_format($val->amount, '2', '.', '')); ?></td>
                            <td><?php echo e($currency->symbol.number_format($val->profit-$val->amount, '2', '.', '')); ?></td>
                            <td><?php if($val->status==1): ?> Running <?php else: ?> Ended <?php endif; ?></td>
                            <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                            <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->expiring_date))); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php else: ?>
            <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">You have no sharing history</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/user/trading/sandtrades.blade.php ENDPATH**/ ?>