<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Pending')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th></th>
                                    <th><?php echo e(__('Ref')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>                                                                       
                                    <th><?php echo e(__('Plan')); ?></th>
                                    <th><?php echo e(__('Daily percent')); ?></th>
                                    <th><?php echo e(__('Duration')); ?></th>
                                    <th><?php echo e(__('Profit')); ?></th>
                                    <th><?php echo e(__('Bonus')); ?></th>                                                                    
                                    <th><?php echo e(__('Claimed')); ?></th>     
                                    <th><?php echo e(__('Created')); ?></th>
                                    <th><?php echo e(__('Updated')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('py.approve', ['id' => $val->id])); ?>" class="btn btn-sm btn-success"><?php echo e(__('Approve')); ?></a>
                                        <a href="<?php echo e(route('py.decline', ['id' => $val->id])); ?>" class="btn btn-sm btn-danger"><?php echo e(__('Decline')); ?></a>
                                    </td>   
                                    <td><?php echo e($val->trx); ?></td>
                                    <td><a href="<?php echo e(url('admin/manage-user')); ?>/<?php echo e($val->user['id']); ?>"><?php echo e($val->user['username']); ?></a></td>
                                    <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                                    <td><?php echo e($val->plan->name); ?></td>
                                    <td><?php echo e($val->percent); ?>%</td>
                                    <td><?php echo e($val->duration); ?>(s)</td>
                                    <td><?php echo e($currency->symbol.number_format($val->profit)); ?></td> 
                                    <td><?php echo e($currency->symbol.$val->bonus); ?></td> 
                                    <td><?php echo e($currency->symbol.$val->claimed); ?></td> 
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>  
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>                
                                </tr>

                                <div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Are you sure you want to delete this?')); ?></h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <a  href="<?php echo e(route('py.delete', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
                            </tbody>                    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/admin/investment/pending.blade.php ENDPATH**/ ?>