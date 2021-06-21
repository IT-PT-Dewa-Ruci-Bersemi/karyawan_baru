<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 05/01/20
 * Time: 02.49
 */
?>


<?php $__env->startSection('content'); ?>
    <h2> Laporran </h2>
    <table border="1">
        <thead>
        <tr>
            <th>test</th>
            <th>tes1</th>
            <th>tes1</th>
            <th>tes1</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>a</td>
            <td>b</td>
            <td>c</td>
            <td>d</td>
        </tr>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('tambahan_javascript'); ?>
    <script type="text/javascript">

        alert('test');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('kerangka.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Modules/Frontend/Views/laporan.blade.php ENDPATH**/ ?>