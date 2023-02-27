<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Email Settings')); ?></h3>
                        <small>You can use this code to edit your deposit messages. Don't use any code that is not on this table, else your emails to clients will have &#123;&#123;tags&#125;&#125; on it</small>
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
                        <form action="<?php echo e(route('admin.depositemail.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 h4"><?php echo e(__('Approve Deposit Request')); ?></label>
                                    <div class="col-lg-12 mb-4">
                                        <input type="text" name="subject" value="<?php echo e($email1->subject); ?>" class="form-control" required>
                                        <input type="hidden" value="deposit_request_approve" name="type">
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
                        <form action="<?php echo e(route('admin.depositemail.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 h4"><?php echo e(__('Decline Deposit Request')); ?></label>
                                    <div class="col-lg-12 mb-4">
                                        <input type="text" name="subject" value="<?php echo e($email2->subject); ?>" class="form-control" required>
                                        <input type="hidden" value="deposit_request_decline" name="type">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea type="text" name="body" rows="2" class="form-control" required><?php echo e($email2->body); ?></textarea>
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
                        <h3 class="card-title"><?php echo e(__('Automated Gateways')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th><?php echo e(__('Main name')); ?></th>
                                    <th><?php echo e(__('Name for users')); ?></th>
                                    <th><?php echo e(__('Min')); ?></th>
                                    <th><?php echo e(__('Max')); ?></th>
                                    <th><?php echo e(__('Charge')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Updated')); ?></th>
                                    <th class="text-center"></th>    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td><?php echo e($val->main_name); ?></td>
                                    <td><?php echo e($val->name); ?></td>
                                    <td><?php echo e($currency->symbol.$val->minamo); ?></td>
                                    <td><?php echo e($currency->symbol.$val->maxamo); ?></td>
                                    <td><?php if($val->percent_charge!=null): ?><?php echo e($val->percent_charge); ?>% <?php else: ?> 0% <?php endif; ?> + <?php if($val->fiat_charge!=null): ?><?php echo e($val->fiat_charge.' '.$currency->name); ?> <?php else: ?> 0 <?php echo e($currency->name); ?> <?php endif; ?></td>
                                    <td>
                                        <?php if($val->status==0): ?>
                                            <span class="badge badge-danger badge-pill"><?php echo e(__('Disabled')); ?></span>
                                        <?php elseif($val->status==1): ?>
                                            <span class="badge badge-success badge-pill"><?php echo e(__('Active')); ?></span> 
                                        <?php endif; ?>
                                    </td>  
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                                    <td class="text-center">
                                    <a data-toggle="modal" data-target="#edit<?php echo e($val->id); ?>" class="btn btn-primary btn-sm text-white" >
                                        <?php echo e(__('Edit')); ?>

                                    </a>
                                    </td>                   
                                </tr>
                                <div id="edit<?php echo e($val->id); ?>" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><?php echo e($val->main_name); ?></h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="<?php echo e(url('admin/storegateway')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label class="col-form-label"><?php echo e(__('Name of gateway for users')); ?></label>
                                                                <input value="<?php echo e($val->id); ?>"type="hidden" name="id">
                                                                <input type="text" value="<?php echo e($val->name); ?>" name="name" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label class="col-form-label"><?php echo e(__('Minimum Amount')); ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                                    </span>
                                                                    <input type="number" name="minamo" maxlength="10" class="form-control"value="<?php echo e($val->minamo); ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="col-form-label"><?php echo e(__('Maximum Amount')); ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                                    </span>
                                                                    <input type="number" name="maxamo" maxlength="10" class="form-control"value="<?php echo e($val->maxamo); ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label class="col-form-label"><?php echo e(__('Fiat Charge [Not Required]')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend">
                                                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                                </span>
                                                                <input type="number" step="any"  name="fiat_charge" value="<?php echo e($val->fiat_charge); ?>" class="form-control">
                                                            </div>
                                                        </div>  
                                                        <div class="col-lg-6">
                                                            <label class="col-form-label"><?php echo e(__('Percent Charge [Not Required]')); ?></label>
                                                            <div class="input-group">
                                                                <input type="number" step="any"  name="percent_charge" value="<?php echo e($val->percent_charge); ?>" class="form-control">
                                                                <span class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </span>
                                                            </div>
                                                        </div>                                  
                                                    </div>                          
                                                    <?php if($val->id==101): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('PAYPAL BUSINESS EMAIL')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    <?php elseif($val->id==102): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Perfect Money USD account')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Alternate passphrase')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php elseif($val->id==103): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Publishable key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php elseif($val->id==104): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Merchant email')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <?php elseif($val->id==107): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Public key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <?php elseif($val->id==108): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Public key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php elseif($val->id==501): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Api key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Xpub code')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php elseif($val->id==505): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Public key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Private key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>                                                      
                                                        <?php elseif($val->id==506): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Public key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Private key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <?php elseif($val->id==507): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('API key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>                                                       
                                                        <?php elseif($val->id==508): ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control" id="val2" name="val2">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val3); ?>" class="form-control" id="val3" name="val3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php else: ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="col-form-label"><?php echo e(__('Payment Details')); ?></label>
                                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><?php echo e(__('Status')); ?></label>
                                                            <select class="form-control select" name="status">
                                                                <option value="1" 
                                                                    <?php if($val->status==1): ?>
                                                                        selected
                                                                    <?php endif; ?>
                                                                    ><?php echo e(__('Active')); ?>

                                                                </option>
                                                                <option value="0"  
                                                                    <?php if($val->status==0): ?>
                                                                        selected
                                                                    <?php endif; ?>
                                                                    ><?php echo e(__('Deactive')); ?>

                                                                </option>
                                                            </select>
                                                        </div>
                                                        <?php if($val->id==505 || $val->id==506): ?>
                                                            <ol>
                                                                <li>Ensure the coin you want to receive is added to your coin payment accepted coins on the API key page, ensure certain permissions are checked</li>
                                                                <li>create_transaction</li>
                                                                <li>get_tx_info</li>
                                                                <li>get_callback_address</li>
                                                                <li>rates</li>
                                                                <li>create_transfer</li>
                                                            </ol>
                                                        <?php endif; ?>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save changes')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
                            </tbody>                    
                        </table>
                    </div>
                </div> 
                <a href="" data-toggle="modal" data-target="#create" class="btn btn-sm btn-neutral mb-5"><i class="fad fa-plus"></i> <?php echo e(__('Add Manual Gateway')); ?></a>   
                <div id="create" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create Gateway</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form action="<?php echo e(url('admin/creategateway2')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label"><?php echo e(__('Name of gateway for users')); ?></label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label"><?php echo e(__('Minimum Amount')); ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                    </span>
                                                    <input type="number" name="minamo" maxlength="10" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="col-form-label"><?php echo e(__('Maximum Amount')); ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                    </span>
                                                    <input type="number" name="maxamo" maxlength="10" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-form-label"><?php echo e(__('Fiat Charge [Not Required]')); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                </span>
                                                <input type="number" step="any"  name="fiat_charge" class="form-control">
                                            </div>
                                        </div>  
                                        <div class="col-lg-6">
                                            <label class="col-form-label"><?php echo e(__('Percent Charge [Not Required]')); ?></label>
                                            <div class="input-group">
                                                <input type="number" step="any"  name="percent_charge"  class="form-control">
                                                <span class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </span>
                                            </div>
                                        </div>                                  
                                    </div>                                                                                  
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label"><?php echo e(__('Payment Details')); ?></label>
                                                <input type="text" class="form-control" id="val1" name="val1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save changes')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>             
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Manual Gateways')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons2">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Min')); ?></th>
                                    <th><?php echo e(__('Max')); ?></th>
                                    <th><?php echo e(__('Charge')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Updated')); ?></th>
                                    <th class="text-center"></th>    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $manual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td><?php echo e($val->name); ?></td>
                                    <td><?php echo e($currency->symbol.$val->minamo); ?></td>
                                    <td><?php echo e($currency->symbol.$val->maxamo); ?></td>
                                    <td><?php if($val->percent_charge!=null): ?><?php echo e($val->percent_charge); ?>% <?php else: ?> 0% <?php endif; ?> + <?php if($val->fiat_charge!=null): ?><?php echo e($val->fiat_charge.' '.$currency->name); ?> <?php else: ?> 0 <?php echo e($currency->name); ?> <?php endif; ?></td>
                                    <td>
                                        <?php if($val->status==0): ?>
                                            <span class="badge badge-danger badge-pill"><?php echo e(__('Disabled')); ?></span>
                                        <?php elseif($val->status==1): ?>
                                            <span class="badge badge-success badge-pill"><?php echo e(__('Active')); ?></span> 
                                        <?php endif; ?>
                                    </td>  
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                                    <td class="text-center">
                                    <a data-toggle="modal" data-target="#edit<?php echo e($val->id); ?>" href=""class="btn btn-primary btn-sm"><?php echo e(__('Edit')); ?></a>
                                    <a href="<?php echo e(route('gateway.delete', ['id'=>$val->id])); ?>"class="btn btn-danger btn-sm"><?php echo e(__('Delete')); ?></a>
                                    </td>                   
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
                            </tbody>                    
                        </table>
                        <?php $__currentLoopData = $manual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div id="edit<?php echo e($val->id); ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?php echo e($val->main_name); ?></h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="<?php echo e(url('admin/storegateway2')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label"><?php echo e(__('Name of gateway for users')); ?></label>
                                                        <input value="<?php echo e($val->id); ?>"type="hidden" name="id">
                                                        <input type="text" value="<?php echo e($val->name); ?>" name="name" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label"><?php echo e(__('Minimum Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend">
                                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                            </span>
                                                            <input type="number" name="minamo" maxlength="10" class="form-control"value="<?php echo e($val->minamo); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label"><?php echo e(__('Maximum Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend">
                                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                            </span>
                                                            <input type="number" name="maxamo" maxlength="10" class="form-control"value="<?php echo e($val->maxamo); ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label class="col-form-label"><?php echo e(__('Fiat Charge [Not Required]')); ?></label>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                        </span>
                                                        <input type="number" step="any"  name="fiat_charge" value="<?php echo e($val->fiat_charge); ?>" class="form-control">
                                                    </div>
                                                </div>  
                                                <div class="col-lg-6">
                                                    <label class="col-form-label"><?php echo e(__('Percent Charge [Not Required]')); ?></label>
                                                    <div class="input-group">
                                                        <input type="number" step="any"  name="percent_charge" value="<?php echo e($val->percent_charge); ?>" class="form-control">
                                                        <span class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                        </span>
                                                    </div>
                                                </div>                                  
                                            </div>                                                                                  
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label"><?php echo e(__('Payment Details')); ?></label>
                                                        <input type="text" value="<?php echo e($val->val1); ?>" class="form-control" id="val1" name="val1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Status')); ?></label>
                                                <select class="form-control select" name="status">
                                                    <option value="1" 
                                                        <?php if($val->status==1): ?>
                                                            selected
                                                        <?php endif; ?>
                                                        ><?php echo e(__('Active')); ?>

                                                    </option>
                                                    <option value="0"  
                                                        <?php if($val->status==0): ?>
                                                            selected
                                                        <?php endif; ?>
                                                        ><?php echo e(__('Deactive')); ?>

                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save changes')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Bank Transfer Details')); ?></h3>
                        <p class="card-text text-sm"><?php echo e(__('Last updated')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($bank->updated_at))); ?></p>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(url('admin/bankdetails')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Name')); ?></label>
                                <div class="col-lg-10">
                                <input type="text" name="name" class="form-control" value="<?php echo e($bank->name); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Bank name')); ?></label>
                                <div class="col-lg-10">
                                <input type="text" name="bank_name" class="form-control" value="<?php echo e($bank->bank_name); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Bank address')); ?></label>
                                <div class="col-lg-10">
                                <input type="text" name="address" class="form-control" value="<?php echo e($bank->address); ?>">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('IBAN code')); ?></label>
                                <div class="col-lg-10">
                                <input type="text" name="iban" class="form-control" value="<?php echo e($bank->iban); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('SWIFT code')); ?></label>
                                <div class="col-lg-10">
                                <input type="text" name="swift" class="form-control" value="<?php echo e($bank->swift); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Account number')); ?></label>
                                <div class="col-lg-10">
                                <input type="number" name="acct_no" class="form-control" value="<?php echo e($bank->acct_no); ?>">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <div class="col-lg-5"> 
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <?php if($bank->status==1): ?>
                                            <input type="checkbox" name="status" id="customCheckLogin" class="custom-control-input" value="1" checked>
                                        <?php else: ?>
                                            <input type="checkbox" name="status" id="customCheckLogin"  class="custom-control-input" value="1">
                                        <?php endif; ?>
                                        <label class="custom-control-label" for="customCheckLogin">
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
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/flutter/core/resources/views/admin/deposit/methods.blade.php ENDPATH**/ ?>