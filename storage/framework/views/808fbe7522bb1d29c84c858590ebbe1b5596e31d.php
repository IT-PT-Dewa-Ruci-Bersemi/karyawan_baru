<?php $__env->startSection('content'); ?>
<div class="container">
    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
        <fieldset>
            <!-- Form Name -->
            <legend><h2><b> <?php echo e($grup->grup); ?> </b></h2></legend><br>
            <?php $__currentLoopData = $soals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-4">
                        <label class="col-md-6 control-label" ><?php echo e($soal->soal); ?></label>  
                    </div>
                    <div class="col-md-6">
                        <input name="jawaban" placeholder="<?php echo e($soal->soal); ?>" class="form-control" type="text">
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            

            <div class="form-group"> 
                <label class="col-md-4 control-label">Department / Office</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="department" class="form-control selectpicker">
                            <option value="">Select your Department/Office</option>
                            <option>Department of Engineering</option>
                            <option>Department of Agriculture</option>
                            <option>Accounting Office</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Select Basic -->
            <!-- Success message -->
            <div class="alert alert-success" role="alert" id="success_message">Success 
                <i class="glyphicon glyphicon-thumbs-up">
                </i> Success!.
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4"><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/soal/soal_identitas.blade.php ENDPATH**/ ?>