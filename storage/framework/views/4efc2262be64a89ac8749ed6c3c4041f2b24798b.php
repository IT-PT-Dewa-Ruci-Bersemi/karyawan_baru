<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 20/06/2016
 * Time: 21:11
 */
?>


<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function () {

            $("input[type=checkbox]").on("click", function(event) {
                event.stopPropagation();
                var data    = $(this).data('permission');

                if(data) {
                    var name    = $(this).attr('name');
                    var checked = $(this).prop('checked');

                    data    = data.split('-');

                    var clickedLevel    = data[0];
                    var dataID          = data[1];
                    var holder          = $("#cl-"+clickedLevel+"-"+dataID+" input[type='checkbox']");

                    var tempName    = name.split('-');
                    if(tempName.length > 2) {
                        var target  = 'nav';
                        for(var i=1;i<tempName.length;i++) {
                            target+='-'+tempName[i];
                            if(checked) $("input[name='"+target+"']").prop('checked', 'checked');
                        }
                    }

                    if(checked) holder.prop('checked', 'checked');
                    else holder.removeAttr('checked');
                } else {
                    var checked = $(this).prop('checked');
                    var parent  = $(this).data('parent');
                    var tempParent  = parent.split('-');
                    var target  = 'nav';

                    for(var i=1;i<tempParent.length;i++) {
                        target+='-'+tempParent[i];
                        if(checked) $("input[name='"+target+"']").prop('checked', 'checked');
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form method="post">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
            <div class="" id="user-permission">
                <?php $__currentLoopData = $mNavigationList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$mNav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="panel card box-primary">
                        <div class="card-header with-border">
                            <a data-toggle="collapse" class="nav-0" data-target="#cl-0-<?php echo e($mNav->id); ?>">
                                <input type="checkbox" name="nav-<?php echo e($mNav->id); ?>" data-permission="0-<?php echo e($mNav->id); ?>" <?php echo e(in_array($mNav->id, $groupMasterNav) ? 'checked' : ''); ?> />
                                <?php echo e($mNav->name); ?>

                            </a>
                        </div>
                        <div id="cl-0-<?php echo e($mNav->id); ?>" class="panel-collapse collapse">
                            <div class="card-body list-1-container">

                                
                                <?php $__currentLoopData = $mNav->navigation()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1=>$nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="panel card box-success">
                                        <div class="card-header with-border">
                                            <a data-toggle="collapse" class="nav-1" data-target="#cl-1-<?php echo e($nav->id); ?>">
                                                <input type="checkbox" name="nav-<?php echo e($mNav->id); ?>-<?php echo e($nav->id); ?>" data-permission="1-<?php echo e($nav->id); ?>" <?php echo e(array_key_exists($nav->id, $groupNavPermission) ? 'checked' : ''); ?> />
                                                <i class="fa <?php echo e($nav->image); ?>"></i> <?php echo e($nav->menu); ?>

                                            </a>
                                        </div>
                                        <div id="cl-1-<?php echo e($nav->id); ?>" class="panel-collapse collapse">
                                            <?php if($nav->subNav()->count()): ?>
                                                <div class="card-body list-2-container">


                                                    
                                                    <?php $__currentLoopData = $nav->subNav()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subNav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="panel card box-success">
                                                            <div class="card-header with-border">
                                                                <a data-toggle="collapse" class="nav-2" data-target="#cl-2-<?php echo e($subNav->id); ?>">
                                                                    <input type="checkbox" name="nav-<?php echo e($mNav->id); ?>-<?php echo e($nav->id); ?>-<?php echo e($subNav->id); ?>" data-permission="2-<?php echo e($subNav->id); ?>" <?php echo e(array_key_exists($subNav->id, $groupNavPermission) ? 'checked' : ''); ?> />
                                                                    <i class="fa <?php echo e($subNav->image); ?>"></i> <?php echo e($subNav->menu); ?>

                                                                </a>
                                                            </div>
                                                            <div id="cl-2-<?php echo e($subNav->id); ?>" class="panel-collapse collapse">
                                                                <?php if($subNav->menu_action || $subNav->menu_default || $subNav->special_permission): ?>
                                                                    <div class="card-body list-action">
                                                                        <?php if(count(explode(';', $subNav->menu_action)) && $subNav->menu_action != null): ?>
                                                                            <?php $__currentLoopData = explode(';', $subNav->menu_action); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input name="<?php echo e($menu); ?>-<?php echo e($subNav->id); ?>" <?php echo e(isset($groupNavPermission[$subNav->id]['menu_action']) ? in_array($menu, $groupNavPermission[$subNav->id]['menu_action']) ? 'checked': '' : ''); ?> data-parent="parent-<?php echo e($mNav->id); ?>-<?php echo e($nav->id); ?>-<?php echo e($subNav->id); ?>" type="checkbox"> <?php echo e(ucwords(str_replace('_', ' ', $menu))); ?>

                                                                                    </label>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                        <?php if(count(json_decode($subNav->menu_default, true) ? json_decode($subNav->menu_default, true) : [])): ?>
                                                                            <?php $__currentLoopData = json_decode($subNav->menu_default, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input name="d-<?php echo e($index); ?>-<?php echo e($subNav->id); ?>" <?php echo e(isset($groupNavPermission[$subNav->id]['menu_default']) ? in_array($index, $groupNavPermission[$subNav->id]['menu_default']) ? 'checked': '' : ''); ?> data-parent="parent-<?php echo e($mNav->id); ?>-<?php echo e($nav->id); ?>-<?php echo e($subNav->id); ?>" type="checkbox"> <?php echo e(ucwords($index)); ?>

                                                                                    </label>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <?php if($subNav->special_permission != null && count(explode(';',$subNav->special_permission))): ?>
                                                                        <div class="card-body list-action special-permission">
                                                                            <h4>Special Permission</h4>
                                                                            <?php $__currentLoopData = explode(';',$subNav->special_permission); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input name="s-p-<?php echo e($menu); ?>-<?php echo e($subNav->id); ?>" <?php echo e(isset($groupNavPermission[$subNav->id]['special_permission']) ? in_array($menu, $groupNavPermission[$subNav->id]['special_permission']) ? 'checked': '' : ''); ?> data-parent="parent-<?php echo e($mNav->id); ?>-<?php echo e($nav->id); ?>-<?php echo e($subNav->id); ?>" type="checkbox"> <?php echo e(ucwords(str_replace('_', ' ', $menu))); ?>

                                                                                    </label>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    

                                                </div>

                                            <?php else: ?>
                                                <?php if($nav->menu_action || $nav->menu_default || $nav->special_permission): ?>
                                                    <div class="card-body list-action">
                                                        <div>
                                                            <?php if(count(explode(';', $nav->menu_action)) && $nav->menu_action != null): ?>
                                                                <?php $__currentLoopData = explode(';', $nav->menu_action); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input name="<?php echo e($menu); ?>-<?php echo e($nav->id); ?>" <?php echo e(isset($groupNavPermission[$nav->id]['menu_action']) ? in_array($menu, $groupNavPermission[$nav->id]['menu_action']) ? 'checked': '' : ''); ?> data-parent="parent-<?php echo e($mNav->id); ?>-<?php echo e($nav->id); ?>" type="checkbox"> <?php echo e(ucwords(str_replace('_', ' ', $menu))); ?>

                                                                        </label>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                            <?php if(count(json_decode($nav->menu_default, true) ? json_decode($nav->menu_default, true) : [])): ?>
                                                                <?php $__currentLoopData = json_decode($nav->menu_default, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input name="d-<?php echo e($index); ?>-<?php echo e($nav->id); ?>" <?php echo e(isset($groupNavPermission[$nav->id]['menu_default']) ? in_array($index, $groupNavPermission[$nav->id]['menu_default']) ? 'checked': '' : ''); ?> data-parent="parent-<?php echo e($mNav->id); ?>-<?php echo e($nav->id); ?>" type="checkbox"> <?php echo e(ucwords($index)); ?>

                                                                        </label>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if(count(explode(';',$nav->special_permission)) && $nav->special_permission != null): ?>
                                                            <div class="card-body list-action special-permission">
                                                                <h4>Special Permission</h4>
                                                                <?php $__currentLoopData = explode(';',$nav->special_permission); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input name="s-p-<?php echo e($menu); ?>-<?php echo e($nav->id); ?>" <?php echo e(isset($groupNavPermission[$nav->id]['special_permission']) ? in_array($menu, $groupNavPermission[$nav->id]['special_permission']) ? 'checked': '' : ''); ?> data-parent="parent-<?php echo e($mNav->id); ?>-<?php echo e($nav->id); ?>" type="checkbox"> <?php echo e(ucwords(str_replace('_', ' ', $menu))); ?>

                                                                        </label>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="text-center padding-15">
                <button class="btn btn-success" type="submit"><i class="far fa-save"></i>&nbsp;Save</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru\app\Providers/../Modules/Admin/Views/administrator/permission.blade.php ENDPATH**/ ?>