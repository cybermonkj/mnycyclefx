<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="mb-0"><?php echo e(__('Update Keywords')); ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.update.language')); ?>" method="post">                           
                            <div class="text-right mb-5">
                                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                            </div>
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($castro->id); ?>" name="id">
                            <?php $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4"><?php echo e($key); ?></label>
                                    <div class="col-lg-8">
                                        <input type="text" name="keys[<?php echo e($key); ?>]" class="form-control" value="<?php echo e($value); ?>" required>
                                    </div>
                                </div>   
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>           
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/admin/user/lang-edit.blade.php ENDPATH**/ ?>