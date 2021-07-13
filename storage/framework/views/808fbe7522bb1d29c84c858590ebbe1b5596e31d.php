<?php $__env->startSection('scripts'); ?>
    <?php echo \App\Modules\Libraries\Plugin::get('datepicker'); ?>

    <script type="text/javascript">
        $(".tanggal").datepicker();
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <form class="well form-horizontal" action="<?php echo e(route('move')); ?>" method="post" id="contact_form">
        <?php echo csrf_field(); ?>
            <!-- Form Name -->
            <legend><h2><b> <?php echo e($grup->grup); ?> </b></h2></legend><br>
            <input type="hidden" name="grup_id" value="<?php echo e($grup->id); ?>" >
            <?php
                $temp_datepicker=[];
            ?>
            <?php $__currentLoopData = $soals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$soal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php switch($soal->type):
                case ("input"): ?>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="<?php echo e($soal->id); ?>" >
                                <label class="col-md-6 control-label" ><?php echo e($soal->soal); ?></label>
                            </div>
                            <div class="col-md-6">
                                <input name="jawaban[]" placeholder="<?php echo e($soal->soal); ?>" class="form-control" type="text" value="<?php echo e($soal->jawaban); ?>">
                            </div>
                        </div>
                    </div>
                    <?php break; ?>
                <?php case ("textarea"): ?>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="<?php echo e($soal->id); ?>" >
                                <label class="col-md-6 control-label" ><?php echo e($soal->soal); ?></label>
                            </div>
                            <div class="col-md-6">
                                <textarea id="jawaban" name="jawaban[]" placeholder="<?php echo e($soal->soal); ?>" class="form-control" value="<?php echo e($soal->jawaban); ?>">
                            </div>
                        </div>
                    </div>
                    <?php break; ?>
                <?php case ("select"): ?>
                    <?php
                        if ($soal->option=='') {
                        goto skip;
                        }
                        $options=explode(';',$soal->option);
                    ?>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="<?php echo e($soal->id); ?>" >
                                <label class="col-md-6 control-label" ><?php echo e($soal->soal); ?></label>
                            </div>
                            <div class="col-md-6">
                                <select name="jawaban[]" class="form-control selectpicker">
                                <option value="">Please select</option>
                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($option); ?>" <?php echo e($soal->jawaban==$option?'selected':''); ?>><?php echo e($option); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                        skip:
                    ?>
                    <?php break; ?>
                <?php case ("datepicker"): ?>
                    <?php
                        array_push($temp_datepicker,$index);
                    ?>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="<?php echo e($soal->id); ?>" >
                                <label class="col-md-6 control-label" ><?php echo e($soal->soal); ?></label>
                            </div>
                            <div class="col-md-6">
                                <input value="<?php echo e($soal->jawaban); ?>" type="text" name="jawaban[]" class="form-control tanggal" id="datepicker-<?php echo e($index); ?>">
                            </div>
                        </div>
                    </div>
                    <?php break; ?>
                <?php case ("datepicker"): ?>
                    <?php
                        array_push($temp_datepicker,$index);
                    ?>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="<?php echo e($soal->id); ?>" >
                                <label class="col-md-6 control-label" ><?php echo e($soal->soal); ?></label>
                            </div>
                            <div class="col-md-6">
                                <input value="<?php echo e($soal->jawaban); ?>" type="text" name="jawaban[]" class="form-control tanggal" id="datepicker-<?php echo e($index); ?>">
                            </div>
                        </div>
                    </div>
                <?php break; ?>
                <?php default: ?>
            <?php endswitch; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="row">
                <div class="col-12 col-md-8">
                    <button type="submit" name="action" class="btn btn-warning" value="back">Back<span class="glyphicon glyphicon-send"></span></button>
                </div>
                <div class="col-6 col-md-4">
                    <button type="submit" name="action" class="btn btn-success" value="save">Next<span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/soal/soal_identitas.blade.php ENDPATH**/ ?>