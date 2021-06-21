<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo e($page_title); ?><?php echo e($meta_title != '' ? ' | '.$meta_title : ''); ?></title>
<meta name="description" content="">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="all,follow">
<!-- Bootstrap CSS-->
<!-- Favicon-->
<?php if(env('app_env') == 'production'): ?>
<script src="https://kit.fontawesome.com/9a2beca39e.js" crossorigin="anonymous"></script>
<?php else: ?>
<link rel="stylesheet" href="<?php echo e(asset('components/shared/fontawesome/css/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('components/shared/fontawesome/css/brands.min.css')); ?>">
<?php endif; ?>

<link rel="stylesheet" href="<?php echo e(asset('components/shared/plugins/bootstrap/css/bootstrap.min.css')); ?>">


<!-- theme stylesheet-->
<link rel="stylesheet" href="<?php echo e(asset('components/admin/themes/stisla/css/style.css')); ?>" id="theme-stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('components/admin/themes/stisla/css/components.css')); ?>" id="theme-stylesheet">

<link rel="stylesheet" href="<?php echo e(asset($asset_path.'css/styles.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset($asset_path.'css/admin_style.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset($asset_path.'css/i_form.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset($asset_path.'css/loading-bar.min.css')); ?>" />
<?php echo $__env->yieldContent('style'); ?>

<?php if($favicon != ''): ?><link rel="shortcut icon" href="<?php echo e(asset('components/images/'.$favicon)); ?>" /><?php endif; ?><?php /**PATH C:\xampp\htdocs\karyawan_baru\app\Providers/../Modules/Admin/Views/templates/parts/head.blade.php ENDPATH**/ ?>