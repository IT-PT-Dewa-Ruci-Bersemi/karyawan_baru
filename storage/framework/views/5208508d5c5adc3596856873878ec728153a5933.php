<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 05/01/20
 * Time: 02.49
 */
?>

    <?php $__env->startSection('content'); ?>
    <table border="1">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Masuk</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $student; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index+1); ?></td>
                <td><?php echo e($s->nama); ?></td>
                <td><?php echo e($s->created_at->format('d M Y H:i:s')); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('kerangka.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Modules/Frontend/Views/home_index.blade.php ENDPATH**/ ?>