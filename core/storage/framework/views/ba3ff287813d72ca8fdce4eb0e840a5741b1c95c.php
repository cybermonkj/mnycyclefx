<?php $__env->startSection('content'); ?>
  <div class="container">
    <div class="row no-gutters">
      <div class="col-md-8 col-lg-7 col-xl-6 offset-md-2 offset-lg-2 offset-xl-3 space-top-3 space-lg-0">
        <!-- Form -->
        <form role="form" action="<?php echo e(route('admin.check')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="mb-5 mb-md-7">
            <h1 class="h2"><?php echo e(__('Admin')); ?></h1>
            <p><?php echo e(__('Reset Password.')); ?></p>
          </div>
          <!-- End Title -->

          <!-- Form Group -->
          <div class="js-form-message form-group">
            <label class="input-label" for="signinSrPassword" tabindex="0">
              <span class="d-flex justify-content-between align-items-center">
                Password
              </span>
            </label>
            <input type="password" class="form-control" name="password"  tabindex="2" placeholder="********" aria-label="********" required data-msg="Your password is invalid. Please try again.">
          </div>
          <!-- End Form Group -->
 

          <!-- Button -->
          <div class="row align-items-center mb-5">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary btn-block transition-3d-hover"><?php echo e(__('Login')); ?></button>
            </div>
          </div>
          <!-- End Button -->
        </form>
        <!-- End Form -->
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/auth/resetadmin.blade.php ENDPATH**/ ?>