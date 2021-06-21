
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Halaamaan Baru</title>
    <style>
        body {
            margin:0;
            padding:0;
            background:silver;
        }
        .container {
            width: 1000px;
            margin:auto;
            min-height: 500px;
            background:white;
        }
    </style>
    <?php echo $__env->yieldContent('tambahan_javascript'); ?>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="<?php echo e(route('home')); ?>">hoome</a></li>
            <li><a href="<?php echo e(route('laporan')); ?>">laporan</a></li>
        </ul>
    </nav>
</header>
<div class="container">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<footer>
    &copy;belajar laravel 2021;
</footer>
</body>
</html>
<?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Modules/Frontend/Views/kerangka/master.blade.php ENDPATH**/ ?>