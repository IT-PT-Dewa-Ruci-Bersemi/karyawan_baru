<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <?php echo $__env->yieldContent('extra_css'); ?>
    <?php echo $__env->yieldContent('extra_script'); ?>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="<?php echo e(route('nama_alias')); ?>">Home</a></li>
            <li><a href="<?php echo e(route('book_bioskop')); ?>">Book</a></li>
            <li><a href="<?php echo e(route('ketiga')); ?>">Ketiga</a></li>
            <li><a href="<?php echo e(route('keempat')); ?>">Keempat</a></li>
            <li><a href="<?php echo e(route('keempat')); ?>">516161</a></li>
            <li><a href="<?php echo e(route('keempat')); ?>">123</a></li>
        </ul>
    </nav>
</header>
<?php echo $__env->yieldContent('content'); ?>
<footer>
    &copy;belajar laravel rabumallam
</footer>
</body>
</html>
<?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Modules/Frontend/Views/template/master.blade.php ENDPATH**/ ?>