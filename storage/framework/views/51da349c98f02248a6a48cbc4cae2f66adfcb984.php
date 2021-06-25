<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 12:05 PM
 */
?>
<html>
<head>
    <title><?php echo e($meta_title); ?></title>
    <?php if($favicon != ''): ?><link rel="shortcut icon" href="<?php echo e(asset('components/shared/images/'.$favicon)); ?>" /><?php endif; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo e(asset($asset_path.'css/login.css')); ?>" />
    <script src="<?php echo e(asset('components/admin/themes/adminLTE/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
    <script>
        $(function(){
            $('input[name=email]').focus();
        });
    </script>
</head>
<body id="body_colour">
<div id="content_login">
    <center>
        <p>ADMINISTRATOR LOGIN AREA</p>
    </center>
    <form action="<?php echo e(route('admin_login_process')); ?>" method="post" id="formlogin">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        <div><input type="text" name="username" placeholder="Username" autofocus /></div>
        <div><input type="password" name="password" placeholder="Password" /></div>
        <div><input type="submit" value="LOGIN" /></div>
    </form>
    <?php if(isset($errors)): ?>
        <div class="login-error"><?php echo $errors->first('email'); ?><?php echo $errors->first('password'); ?></div>
    <?php endif; ?>
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/login/login.blade.php ENDPATH**/ ?>