<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('admin::templates.parts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('head'); ?>
</head>
<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1 ">
        <div class="navbar-bg"></div>
        <?php echo $__env->make('admin::templates.parts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::templates.parts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1><?php echo e(Str::limit($page_title, 30)); ?></h1>
                    <div class="section-header-button">
                        <?php $__currentLoopData = $menu_default; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($value->type == 'form'): ?>
                                <a data-target="#modal-<?php echo e($name); ?>" title="<?php echo e(ucwords($name)); ?>" href="#" data-toggle="tooltip" class="btn btn-primary menu-default">
                                    <i class="far <?php echo e($value->image); ?>"></i>
                                </a>
                            <?php elseif($value->type == 'link'): ?>
                                <a title="<?php echo e(ucwords($name)); ?>" href="<?php echo e(is_array($value->route) ? route($value->route[0], $value->route[1]) : route($value->route)); ?>" href="#" data-toggle="tooltip" class="btn btn-primary menu-default">
                                    <i class="far <?php echo e($value->image); ?>"></i>
                                </a>
                            <?php elseif($value->type == 'order'): ?>
                                <a title="<?php echo e(ucwords($name)); ?>" class="btn btn-primary menu-order" href="#" data-toggle="tooltip" id="menu-default-<?php echo e($name); ?>">
                                    <i class="far <?php echo e($value->image); ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->yieldContent('menu'); ?>
                    </div>
                    <?php echo \App\Modules\Libraries\Breadcrumb::get(); ?>

                </div>
                <?php echo \App\Modules\Libraries\Alert::show(); ?>

                <?php echo $__env->yieldContent('content'); ?>
                <div id="grid"></div>
            </section>
        </div>
        <?php echo $__env->make('admin::templates.parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="overlay"></div>
    <div class="loading">Loading&#8230;</div>
</div>
<div class="modal-holder">
<?php echo $__env->yieldContent('modal_holder'); ?>
</div>
<?php echo $__env->make('admin::templates.parts.footer_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/templates/master.blade.php ENDPATH**/ ?>