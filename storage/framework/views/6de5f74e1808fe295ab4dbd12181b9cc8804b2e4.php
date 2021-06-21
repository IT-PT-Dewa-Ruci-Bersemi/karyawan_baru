<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 14/12/19
 * Time: 22.14
 */
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Test</title>
    <!-- Favicon -->
    <link href="<?php echo e(asset('components/images/favicon.png')); ?>" rel="shortcut icon">
    <!-- CSS -->
    <link href="<?php echo e(asset('components/frontend/coming_soon/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('components/frontend/coming_soon/css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('components/frontend/coming_soon/css/coming_soon.css')); ?>" rel="stylesheet">
    <!-- Fonts/Icons -->
</head>
<body data-preloader="2">


<!-- ***** JAVASCRIPTS ***** -->
<script src="<?php echo e(asset('components/frontend/coming_soon/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('components/frontend/coming_soon/js/plugins.js')); ?>"></script>
<script src="<?php echo e(asset('components/frontend/coming_soon/js/functions.js')); ?>"></script>
<?php echo $__env->make('templates.includes.google-analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Modules/Frontend/Views/templates/coming_soon.blade.php ENDPATH**/ ?>
