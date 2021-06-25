<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <?php if(Auth::guard('admin')->user()->position->level == 101): ?>
            <?php echo $__env->make('admin::core.includes.admin_mega_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"><?php echo e(\Illuminate\Support\Facades\Auth::guard('admin')->user()->name); ?></div>
                <a href="<?php echo e(route('admin_personal_setting')); ?>" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('admin_logout')); ?>" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/templates/parts/header.blade.php ENDPATH**/ ?>