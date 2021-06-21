<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 23/09/2017
 * Time: 21:14
 */
?>


<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block">
            <h4>List of Testing Module</h4>
            <ul>
                <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route($module['route'])); ?>" target="_blank"><?php echo e($module['name']); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Providers/../Modules/Admin/Views/core/core_board.blade.php ENDPATH**/ ?>