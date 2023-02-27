<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <a  href="<?php echo e(route('admin.plan.create')); ?>" class="btn btn-sm btn-neutral mb-5"><i class="fa fa-plus"></i> <?php echo e(__('Create Plan')); ?></a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Plans')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Daily')); ?> %</th>                                                                       
                                    <th><?php echo e(__('Min')); ?></th>
                                    <th><?php echo e(__('Max')); ?></th>
                                    <th><?php echo e(__('Duration')); ?></th>
                                    <th><?php echo e(__('Referral')); ?></th>
                                    <th><?php echo e(__('Bonus')); ?></th>
                                    <th><?php echo e(__('Claim')); ?></th>
                                    <th><?php echo e(__('Recurring')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td class="text-center">
                                        <div class="text-right">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fad fa-chevron-circle-down"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a href="<?php echo e(route('admin.plan.edit', ['id' => $val->id])); ?>" class="dropdown-item"><i class="fad fa-edit"></i><?php echo e(__('Edit')); ?></a>
                                                    <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="dropdown-item"><i class="fad fa-trash"></i> <?php echo e(__('Delete')); ?></a>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>   
                                    <td><?php echo e($val->name); ?></td>
                                    <td><?php echo e($val->percent); ?>%</td>
                                    <td><?php echo e($currency->symbol.number_format($val->min_deposit)); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                                    <td><?php echo e($val->duration.$val->period); ?>(s)</td>
                                    <td><?php echo e($val->ref_percent); ?>%</td>
                                    <td><?php echo e($val->bonus); ?>%</td>
                                    <td><?php if($val->claim==1): ?><?php echo e(__('Yes')); ?><?php else: ?><?php echo e(__('No')); ?><?php endif; ?></td>                                    
                                    <td><?php if($val->recurring==1): ?><?php echo e(__('Yes')); ?><?php else: ?><?php echo e(__('No')); ?><?php endif; ?></td>  
                                    <td>
                                        <?php if($val->status==1): ?>
                                            <span class="badge badge-success"><?php echo e(__('Active')); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-danger"><?php echo e(__('Disabled')); ?></span>
                                        <?php endif; ?>
                                    </td>                 
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
                            </tbody>                    
                        </table>
                        <?php $__currentLoopData = $plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card bg-white border-0 mb-0">
                                            <div class="card-header">
                                                <h3 class="mb-0 font-weight-bolder"><?php echo e(__('Delete Plan')); ?></h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                <span class="mb-0 text-xs"><?php echo e(__('Are you sure you want to delete this?')); ?></span>
                                            </div>
                                            <div class="card-body">
                                                <a  href="<?php echo e(route('py.plan.delete', ['id' => $val->id])); ?>" class="btn btn-danger btn-block"><?php echo e(__('Proceed')); ?></a>
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
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/admin/investment/plans.blade.php ENDPATH**/ ?>