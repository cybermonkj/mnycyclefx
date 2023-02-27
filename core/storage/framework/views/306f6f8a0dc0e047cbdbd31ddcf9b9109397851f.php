<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="modal fade" id="share<?php echo e($plan->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="mb-0 font-weight-bolder"><?php echo e(__('Share')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form>
                        <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="input-group">
                            <input type="text" class="form-control" value="<?php echo e(route('check.plan', ['id' => $plan->slug])); ?>">   
                            <div class="input-group-prepend">
                                <span class="input-group-text btn-icon-clipboard text-xs" data-clipboard-text="<?php echo e(route('check.plan', ['id' => $plan->slug])); ?>" title="Copy to clipboard">Copy link</span>
                            </div> 
                            </div>
                        </div>
                        </div>
                        <div class="text-center">
                        <?php echo QrCode::eye('circle')->style('round')->size(250)->generate(route('check.plan', ['id' => $plan->slug]));; ?> 
                        </div>      
                        <div class="text-center mb-3 mt-3">
                        <p>Scan QR code or Share using:</p>
                        </div>                    
                        <div class="text-center">      
                        <a href="https://wa.me/?text=<?php echo e(route('check.plan', ['id' => $plan->slug])); ?>" target="_blank" class="btn btn-slack btn-icon-only">
                            <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                        </a>                           
                        <a href="mailto:?body=<?php echo e(route('check.plan', ['id' => $plan->slug])); ?>" class="btn btn-twitter btn-icon-only">
                            <span class="btn-inner--icon"><i class="fal fa-envelope"></i></span>
                        </a>                                                  
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($plan->image); ?>" alt="Image placeholder">
                    <div class="card-body">
                        <span class="text-sm text-muted mb-0"><?php echo e($plan->original-$plan->units); ?> / <?php echo e($plan->original); ?> Units Sold</span>
                        <div class="progress progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e((($plan->original-$plan->units)*100)/$plan->original); ?>%;"></div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h5 class="h2 card-title mb-0 font-weight-bolder"><?php echo e($plan->name); ?></h5>
                            </div>
                            <div class="col-4 text-right">
                                <a data-toggle="modal" data-target="#share<?php echo e($plan->id); ?>" title="share" href=""><i class="fal fa-external-link"></i></a>
                            </div>
                        </div>
                        <small class="text-muted"><?php echo e($plan->location); ?></small>
                        <p class="text-sm text-dark mb-0"><span class="text-primary h3 font-weight-bolder"><?php echo e($plan->interest); ?>%</span> Returns in <?php echo e($plan->duration.' '.$plan->period); ?></p>
                        <p class="text-sm text-dark mb-0"><span class="text-success h4 font-weight-bolder"><?php echo e($currency->symbol.$plan->price); ?></span> per Unit</p>
                        <p class="text-sm text-dark mb-0"><?php if($plan->ref_percent!=null): ?><?php echo e($plan->ref_percent); ?>% <?php else: ?> <?php echo e(__('No')); ?> <?php endif; ?><?php echo e(__('Referral Bonus')); ?></p>
                        <div class="row justify-content-between align-items-center mb-3">
                            <div class="col-6">
                                <span class="form-text text-sm text-dark"><?php echo e(__('Opening Date')); ?></span>
                                <span class="form-text text-xs text-muted"><?php echo e(date("Y/m/d h:i:A", strtotime($plan->start_date))); ?></span>
                            </div>
                            <div class="col-6"> 
                                <span class="form-text text-sm text-dark"><?php echo e(__('Maturity Date')); ?></span>
                                <span class="form-text text-sm text-muted"><?php echo e(date("Y/m/d h:i:A", strtotime($plan->expiring_date))); ?></span> 
                            </div>
                        </div>             
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                        <h5 class="h3 mb-0 font-weight-bolder"><?php echo e(__('Description')); ?></h5>
                        </div>
                        <div class="col-4 text-right">
                        <?php if($plan->units>0): ?>
                            <?php if($plan->start_date <= Carbon\Carbon::now()->toDateTimeLocalString() && $plan->expiring_date > Carbon\Carbon::now()->toDateTimeLocalString()): ?>
                                <a href="#" data-toggle="modal" data-target="#buy<?php echo e($plan->id); ?>"   class="btn btn-sm btn-primary">Purchase Units</a>
                            <?php endif; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                    <p class="card-text text-sm mb-4"><?php echo $plan->description; ?></p>
                        <div class="row">
                            <div class="col-4">
                            <?php
                            $category=App\Models\Sandplancategory::whereid($plan->cat_id)->first();
                            ?>
                                <span class="form-text text-sm text-muted"><?php echo e(__('Category')); ?>: <?php echo e($category->name); ?></span>
                            </div>
                            <div class="col-4"> 
                                <span class="form-text text-sm text-muted"><?php echo e(__('Insurance')); ?>: <?php if($plan->insurance==1): ?> <?php echo e(__('Yes')); ?> <?php else: ?> <?php echo e(__('No')); ?> <?php endif; ?></span> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="mb-0"><?php echo e(__('Plan Updates')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                        <thead>
                            <tr>
                            <th><?php echo e(__('S / N')); ?></th>
                            <th><?php echo e(__('Information')); ?></th>
                            <th><?php echo e(__('Report')); ?></th>
                            <th><?php echo e(__('Activity')); ?></th>
                            <th><?php echo e(__('Stage')); ?></th>
                            <th><?php echo e(__('Weeks')); ?></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$k); ?>.</td>
                                <td><?php echo e(str_limit($val->information, 10)); ?></td>
                                <td><?php echo e(str_limit($val->report, 10)); ?></td>
                                <td><?php echo e(str_limit($val->activity, 10)); ?></td>
                                <td><?php echo e($val->stage); ?></td>
                                <td><?php echo e($val->weeks); ?></td>
                                <td><a href="<?php echo e(route('view.sandplan.update', ['id' => $val->id])); ?>"><i class="fa fa-eye"></i></a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="mb-0"><?php echo e(__('Your Investments')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                        <thead>
                            <tr>
                            <th><?php echo e(__('S / N')); ?></th>
                            <th><?php echo e(__('Reference ID')); ?></th>
                            <th><?php echo e(__('Units')); ?></th>
                            <th><?php echo e(__('Amount')); ?></th>
                            <th><?php echo e(__('Profit')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Created')); ?></th>
                            <th><?php echo e(__('Updated')); ?></th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php $__currentLoopData = $profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$k); ?>.</td>
                                <td>#<?php echo e($val->trx); ?></td>
                                <td><?php echo e($val->units); ?></td>
                                <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                                <td><?php echo e($currency->symbol.number_format($val->profit)); ?></td>
                                <td><?php if($val->status==1): ?> Running <?php else: ?> Ended <?php endif; ?></td>
                                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="buy<?php echo e($plan->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-body p-0">
            <div class="card border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
                <div class="text-dark text-center mt-2 mb-3"><small><?php echo e(__('Purchase plan')); ?></small></div>
                <div class="btn-wrapper text-center">
                <h4 class="text-uppercase ls-1 text-dark py-3 mb-0"><?php echo e($plan->name); ?></h4>
                </div>
            </div>
            <div class="card-body">
                <form role="form" action="<?php echo e(route('user.sandcheck_plan')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">#</span>
                    </div>
                    <input type="number" class="form-control" placeholder="<?php echo e(__('Units')); ?>" id="units" name="units" onkeyup="buycharge()"max="<?php echo e($plan->units); ?>" required>
                    <input type="hidden" name="plan" value="<?php echo e($plan->id); ?>">
                    <input type="hidden" name="price" id="price" value="<?php echo e($plan->price); ?>">
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
                    <button type="submit" class="btn btn-neutral btn-block"><?php echo e(__('Purchase')); ?> <span id="cardresult"></span></button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/user/trading/view.blade.php ENDPATH**/ ?>