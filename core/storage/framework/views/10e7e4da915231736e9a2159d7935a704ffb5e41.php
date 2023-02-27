<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Bank transfer')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>                                                                       
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Created')); ?></th>
                                    <th><?php echo e(__('Updated')); ?></th>
                                    <th class="text-center"><?php echo e(__('Action')); ?></th>    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $deposit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td><a href="<?php echo e(url('admin/manage-user')); ?>/<?php echo e($val->user['id']); ?>"><?php echo e($val->user['first_name'].' '.$val->user['last_name']); ?></a></td>
                                    <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                                    <td>
                                        <?php if($val->status==0): ?>
                                            <span class="badge badge-danger"><?php echo e(__('Pending')); ?></span>
                                        <?php elseif($val->status==1): ?>
                                            <span class="badge badge-success"><?php echo e(__('Approved')); ?></span>
                                        <?php elseif($val->status==2): ?>
                                            <span class="badge badge-info"><?php echo e(__('Declined')); ?></span> 
                                        <?php endif; ?>
                                    </td>  
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                                    <td class="text-center">
                                        <div class="text-right">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Delete')); ?></a>
                                                    <a data-toggle="modal" data-target="#screenshot<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Screenshot')); ?></a>
                                                    <a data-toggle="modal" data-target="#details<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Transfer details')); ?></a>
                                                    <?php if($val->status==0): ?>
                                                        <a class='dropdown-item' href="<?php echo e(route('deposit.declinebk', ['id' => $val->id])); ?>"><?php echo e(__('Decline')); ?></a>
                                                        <a class='dropdown-item' href="<?php echo e(route('deposit.approvebk', ['id' => $val->id])); ?>"><?php echo e(__('Approve')); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                  
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
                                                        <a  href="<?php echo e(route('banktransfer.delete', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="details<?php echo e($val->id); ?>" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">   
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p class="text-sm text-dark"><?php echo e($val->details); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                                <div class="modal fade" id="screenshot<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="castro-fade">
                                            <div class="modal-body p-0" >
                                                <div class=" border-0 mb-0 text-center">
                                                    <div class="px-lg-5 py-lg-5">
                                                        <img src="<?php echo e(url('/')); ?>/asset/screenshot/<?php echo e($val->image); ?>" class="mb-3 user-profile">
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/admin/deposit/bank-transfer.blade.php ENDPATH**/ ?>