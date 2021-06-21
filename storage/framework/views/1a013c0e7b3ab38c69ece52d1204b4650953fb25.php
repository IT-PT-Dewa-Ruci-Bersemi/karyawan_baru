<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 05/01/20
 * Time: 02.50
 */
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo e($_meta_descriptions); ?>">
    <meta name="keywords" content="<?php echo e($_meta_keywords); ?>">
    <title><?php echo e($site_title); ?></title>
    <!-- Favicon -->
    <link href="<?php echo e(asset('components/images/'.$favicon)); ?>" rel="shortcut icon">
    <?php echo $__env->make('templates.includes.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body data-preloader="2">
<?php echo $__env->make('templates.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Scroll to top button -->
<div class="scrolltotop padding-10">
    <a class="button-circle button-circle-sm button-circle-dark" href="#"><i class="ti-arrow-up"></i></a>
</div>
<!-- end Scroll to top button -->
<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('templates.includes.footer_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ***** JAVASCRIPTS ***** -->
</body>
</html><?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Modules/Frontend/Views/templates/master.blade.php ENDPATH**/ ?>