<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('admin_dashboard')); ?>"><img src="<?php echo e(asset('components/images/Logo PT.png')); ?>" width="35" />PT Dewa Ruci Bersemi</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo e(route('admin_dashboard')); ?>"><img src="<?php echo e(asset('components/images/Logo PT.png')); ?>" width="35" /></a>
        </div>
        <ul class="sidebar-menu">
            <?php $__currentLoopData = $master_nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $masterNav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($masterNav->navigation()->whereIn('id', $__role->get('permission'))->count()): ?>
                    <li class="menu-header"><?php echo e($masterNav->name); ?></li>
                    <?php $__currentLoopData = $masterNav->navigation()->whereIn('id', $__role->get('permission'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $__treeAvailable  = $nav->subNav()->whereIn('id', $__role->get('permission'))->count();
                            $__active         = $nav->name === $__role->get('current_page')->name || ($__role->get('parent_page') ? $nav->id == $__role->get('parent_page')->id : 0) ? true : false;
                        ?>
                        <?php if(!$__treeAvailable): ?>
                            <li>
                                <a class="nav-link <?php echo e($__active ? 'active' : ''); ?>" href="<?php echo e(($nav->route != '' || $nav->route != null) ? route($nav->route) : "#"); ?>">
                                    <?php if($nav->image): ?>
                                        <i class="fal <?php echo e($nav->image); ?>"></i>
                                    <?php endif; ?>
                                    <span style="font-size:12px;">&nbsp;<?php echo e($nav->menu); ?></span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item dropdown <?php echo e($__active ? 'active' : ''); ?>">
                                <a href="#" class="nav-link has-dropdown">
                                    <?php if($nav->image): ?>
                                        <i class="fal <?php echo e($nav->image); ?>"></i>
                                    <?php endif; ?>
                                    <span style="font-size:12px;">&nbsp;<?php echo e($nav->menu); ?></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $nav->subNav()->whereIn('id', $__role->get('permission'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subNav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a class="nav-link <?php echo e($subNav->name == $__role->get('current_page')->name ? 'active ' : ''); ?>" href="<?php echo e(route($subNav->route)); ?>">
                                            <?php if($subNav->image): ?>
                                                <i class="fal <?php echo e($subNav->image); ?>"></i>
                                            <?php endif; ?>
                                            <span style="font-size:12px;">&nbsp;<?php echo e($subNav->menu); ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </aside>
</div><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/templates/parts/menu.blade.php ENDPATH**/ ?>