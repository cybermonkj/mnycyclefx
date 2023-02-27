<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <a data-toggle="modal" data-target="#create" href="" class="btn btn-sm btn-neutral mb-5"><i class="fa fa-plus"></i> <?php echo e(__('Create Type')); ?></a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Email Settings')); ?></h3>
                        <small>You can use this code to edit the automated withdrawal messages. Don't use any code that is not on this table, else your emails to clients will have &#123;&#123;tags&#125;&#125; on it</small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>CODE</th>
                                        <th>DESCRIPTION</th>
                                        <th>Type</th>
                                        <th>Required</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1. </td>
                                    <td> &#123;&#123;amount&#125;&#125;</td>
                                    <td> Transaction amount</td>
                                    <td> Float</td>
                                    <td> No</td>
                                </tr>                                
                                <tr>
                                    <td> 2. </td>
                                    <td> &#123;&#123;charge&#125;&#125;</td>
                                    <td> Charge for processing withdrawal</td>
                                    <td> Float</td>
                                    <td> No</td>
                                </tr>
                                <tr>
                                    <td> 3. </td>
                                    <td> &#123;&#123;first_name&#125;&#125; </td>
                                    <td> Client first name</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                 
                                <tr>
                                    <td> 4. </td>
                                    <td> &#123;&#123;last_name&#125;&#125; </td>
                                    <td> Client last name</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                 
                                <tr>
                                    <td> 5. </td>
                                    <td> &#123;&#123;username&#125;&#125; </td>
                                    <td> Client username</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                    
                                <tr>
                                    <td> 6. </td>
                                    <td> &#123;&#123;site_name&#125;&#125; </td>
                                    <td> Your Website name</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                               
                                <tr>
                                    <td> 7. </td>
                                    <td> &#123;&#123;site_email&#125;&#125; </td>
                                    <td> Your Website email</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                               
                                <tr>
                                    <td> 8. </td>
                                    <td> &#123;&#123;duration&#125;&#125; </td>
                                    <td> Duration for payout to be processed</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                
                                <tr>
                                    <td> 9. </td>
                                    <td> &#123;&#123;method&#125;&#125; </td>
                                    <td> Payout methods</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                              
                                <tr>
                                    <td> 10. </td>
                                    <td> &#123;&#123;details&#125;&#125; </td>
                                    <td> Credentials needed to process payout</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>                                
                                <tr>
                                    <td> 11. </td>
                                    <td> &#123;&#123;reference&#125;&#125; </td>
                                    <td> Transaction reference</td>
                                    <td> String</td>
                                    <td> No</td>
                                </tr>
                                </tbody>                    
                            </table>
                        </div>
                    </div>
                </div>                
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Email Messages')); ?></h3>
                        <small>Don't use wrong email tags, as it will be displayed as &#123;&#123;random&#125;&#125; in email with no outputed content from database, you don't want that, so take your time to read what you are typing</small>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.withdrawemail.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 h4"><?php echo e(__('New Withdraw Request to Client')); ?></label>
                                    <div class="col-lg-12 mb-4">
                                        <input type="text" name="subject" value="<?php echo e($email1->subject); ?>" class="form-control" required>
                                        <input type="hidden" value="new_withdraw_request_user" name="type">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea type="text" name="body" rows="2" class="form-control" required><?php echo e($email1->body); ?></textarea>
                                    </div>
                                </div>                 
                                <div class="text-left">
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Update')); ?></button>
                                </div>
                        </form>     
                        <hr>                   
                        <form action="<?php echo e(route('admin.withdrawemail.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 h4"><?php echo e(__('New Withdraw Request to Admin')); ?></label>
                                    <div class="col-lg-12 mb-4">
                                        <input type="text" name="subject" value="<?php echo e($email2->subject); ?>" class="form-control" required>
                                        <input type="hidden" value="new_withdraw_request_admin" name="type">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea type="text" name="body" rows="2" class="form-control" required><?php echo e($email2->body); ?></textarea>
                                    </div>
                                </div>                 
                                <div class="text-left">
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Update')); ?></button>
                                </div>
                        </form>
                        <hr>                   
                        <form action="<?php echo e(route('admin.withdrawemail.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 h4"><?php echo e(__('Approve Withdraw Request')); ?></label>
                                    <div class="col-lg-12 mb-4">
                                        <input type="text" name="subject" value="<?php echo e($email3->subject); ?>" class="form-control" required>
                                        <input type="hidden" value="withdraw_request_approve" name="type">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea type="text" name="body" rows="2" class="form-control" required><?php echo e($email3->body); ?></textarea>
                                    </div>
                                </div>                 
                                <div class="text-left">
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Update')); ?></button>
                                </div>
                        </form>                        
                        <hr>                   
                        <form action="<?php echo e(route('admin.withdrawemail.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 h4"><?php echo e(__('Decline Withdraw Request')); ?></label>
                                    <div class="col-lg-12 mb-4">
                                        <input type="text" name="subject" value="<?php echo e($email4->subject); ?>" class="form-control" required>
                                        <input type="hidden" value="withdraw_request_decline" name="type">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea type="text" name="body" rows="2" class="form-control" required><?php echo e($email4->body); ?></textarea>
                                    </div>
                                </div>                 
                                <div class="text-left">
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Update')); ?></button>
                                </div>
                        </form>
                    </div>
                </div>                
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Next Settlement')); ?></h3>
                        <small>If Next settlement is not active, payouts duration will work with payout method duration. If any payout is due, it will be indicated on script</small>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.settle.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Duration')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="number" name="duration" pattern="[0-9]+(\.[0-9]{0,2})?%?" value="<?php echo e($set->duration); ?>" id="duration" class="form-control" placeholder="1" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Period')); ?></label>
                                    <div class="col-lg-10">
                                        <select class="form-control select" name="period" id="period" data-fouc required>    
                                            <option value="Day" 
                                                <?php if($set->period=='Day'): ?>
                                                <?php echo e(__('selected')); ?>

                                                <?php endif; ?>
                                                ><?php echo e(__('Day')); ?>

                                            </option>                                         
                                            <option value="Week" 
                                                <?php if($set->period=='Week'): ?>
                                                <?php echo e(__('selected')); ?>

                                                <?php endif; ?>
                                                ><?php echo e(__('Week')); ?>

                                            </option>                                         
                                            <option value="Month" 
                                                <?php if($set->period=='Month'): ?>
                                                <?php echo e(__('selected')); ?>

                                                <?php endif; ?>
                                                ><?php echo e(__('Month')); ?>

                                            </option>                                         
                                            <option value="Year" 
                                                <?php if($set->period=='Year'): ?>
                                                <?php echo e(__('selected')); ?>

                                                <?php endif; ?>
                                                ><?php echo e(__('Year')); ?>

                                            </option>                                       
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Next Settlement')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" readonly value='<?php echo e(date("Y/m/d", strtotime($set->next_settlement))); ?>' class="form-control">
                                    </div>
                                </div>                        
                                <div class="form-group row">
                                    <div class="col-lg-5">                            
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input type="checkbox" name="ns" id="customCheckLoginx17" class="custom-control-input" value="1" <?php if($set->ns==1): ?>checked <?php endif; ?>>                                       
                                            <label class="custom-control-label" for="customCheckLoginx17">
                                            <span class="text-muted"><?php echo e(__('Status')); ?></span>     
                                            </label>
                                        </div>
                                    </div>
                                </div>                   
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Payout Methods')); ?></h6>
                        <small>Using wrong email tags will cause errors on script</small>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th class="text-center"></th>   
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Charge')); ?></th>
                                    <th><?php echo e(__('Limit')); ?></th>
                                    <th><?php echo e(__('Duration')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Created')); ?></th>
                                    <th><?php echo e(__('Updated')); ?></th> 
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td class="text-center">
                                        <div class="text-right">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fad fa-chevron-circle-down"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <?php if($val->status==1): ?>
                                                        <a class='dropdown-item' href="<?php echo e(route('withdraw.declinedm', ['id' => $val->id])); ?>"><i class="fad fa-ban"></i> <?php echo e(__('Disable')); ?></a>
                                                    <?php else: ?>
                                                        <a class='dropdown-item' href="<?php echo e(route('withdraw.approvem', ['id' => $val->id])); ?>"><i class="fad fa-check"></i> <?php echo e(__('Activate')); ?></a>   
                                                    <?php endif; ?>
                                                    <a class='dropdown-item' data-toggle="modal" data-target="#edit<?php echo e($val->id); ?>" href=""><i class="fad fa-edit"></i> <?php echo e(__('Edit')); ?></a>
                                                    <a class='dropdown-item' data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href=""><i class="fad fa-trash"></i> <?php echo e(__('Delete')); ?></a>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>   
                                    <td><?php echo e($val->method); ?></td>
                                    <td><?php if($val->percent_charge!=null): ?><?php echo e($val->percent_charge); ?>% <?php else: ?> 0% <?php endif; ?> + <?php if($val->fiat_charge!=null): ?><?php echo e($val->fiat_charge.' '.$currency->name); ?> <?php else: ?> 0 <?php echo e($currency->name); ?> <?php endif; ?></td>
                                    <td><?php echo e($val->min.' - '.$val->max.' '.$currency->name); ?></td>
                                    <td><?php echo e($val->period.' '.$val->duration); ?>(s)</td>
                                    <td>
                                        <?php if($val->status==0): ?>
                                            <span class="badge badge-danger badge-pill"><?php echo e(__('Disabled')); ?></span>
                                        <?php elseif($val->status==1): ?>
                                            <span class="badge badge-success badge-pill"><?php echo e(__('Active')); ?></span> 
                                        <?php endif; ?>
                                    </td>  
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
        <?php $__currentLoopData = $method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div id="edit<?php echo e($val->id); ?>" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">   
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?php echo e(route('admin.withdraw.update')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($val->id); ?>" name="id">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <input type="text" name="method" class="form-control" value="<?php echo e($val->method); ?>" required placeholder="Name">
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" step="any"  name="min" value="<?php echo e($val->min); ?>" class="form-control" required placeholder="Min Amount">
                                        </div>
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" step="any"  name="max" value="<?php echo e($val->max); ?>" class="form-control" required placeholder="Max Amount">
                                        </div>
                                    </div>                                    
                                </div>                                                  
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" step="any"  name="fiat_charge" value="<?php echo e($val->fiat_charge); ?>" class="form-control" placeholder="Fiat Charge [Not Required">
                                        </div>
                                    </div>                                    
                                </div>                        
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <input type="number" step="any"  name="percent_charge" value="<?php echo e($val->percent_charge); ?>" class="form-control" placeholder="Percent Charge [Not Required]">
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                    
                                </div>                            
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <input type="number" name="period" value="<?php echo e($val->period); ?>" class="form-control" required placeholder="1">
                                    </div>  
                                    <div class="col-lg-9">
                                        <select class="form-control select" name="duration" required>
                                            <option value='day' <?php if($val->duration=="day"): ?>selected <?php endif; ?></option>Day</option>
                                            <option value='week' <?php if($val->duration=="week"): ?>selected <?php endif; ?>>Week</option>
                                            <option value='month' <?php if($val->duration=="month"): ?>selected <?php endif; ?>>Month</option>
                                            <option value='year' <?php if($val->duration=="year"): ?>selected <?php endif; ?>>Year</option>
                                        </select>
                                    </div>                                  
                                </div>                                   
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <input type="text"  name="requirements" class="form-control" value="<?php echo e($val->requirements); ?>" placeholder="Requirements [Required]" required>
                                        <span class="text-xs text-gray">This will be showed to clients as placeholder to tell them, what they must provide for a successful withdrawal</span>
                                    </div>                                    
                                </div>             
                            </div> 
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                                    <a  href="<?php echo e(route('withdraw.deletem', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
    <div id="create" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">   
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo e(route('admin.withdraw.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="method" class="form-control" required placeholder="Name">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                    </span>
                                    <input type="number" step="any"  name="min" class="form-control" placeholder="Min Amount" required>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                    </span>
                                    <input type="number" step="any"  name="max" class="form-control" placeholder="Max Amount" required>
                                </div>
                            </div>                                    
                        </div>                        
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                    </span>
                                    <input type="number" step="any"  name="fiat_charge" class="form-control" placeholder="Fiat Charge [Not Required]">
                                </div>
                            </div>                                    
                        </div>                        
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="number" step="any"  name="percent_charge" placeholder="Percent Charge [Not Required]" class="form-control">
                                    <span class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </span>
                                </div>
                            </div>                                    
                        </div>        
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <input type="number" name="period" class="form-control" required placeholder="1">
                            </div>  
                            <div class="col-lg-9">
                                <select class="form-control select" name="duration" required>
                                    <option value='day'>Day</option>
                                    <option value='week'>Week</option>
                                    <option value='month'>Month</option>
                                    <option value='year'>Year</option>
                                </select>
                            </div>                                  
                        </div>                                
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text"  name="requirements" class="form-control" placeholder="Requirements" required>
                                <span class="text-xs text-gray">This will be showed to clients as placeholder to tell them, what they must provide for a successful withdrawal</span>
                            </div>                                    
                        </div>             
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/admin/withdrawal/methods.blade.php ENDPATH**/ ?>