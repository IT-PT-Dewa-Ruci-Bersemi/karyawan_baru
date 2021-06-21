<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 07/09/2017
 * Time: 17:59
 */
?>


<?php $__env->startSection('head'); ?>
    <?php echo \App\Modules\Libraries\Plugin::get('icheck'); ?>

    <?php echo \App\Modules\Libraries\Plugin::get('editor'); ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.nav-tabs li a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
                history.pushState(null, null, $(this).attr('href'));
            });

            // navigate to a tab when the history changes
            window.addEventListener("popstate", function(e) {
                var activeTab = $('[href=' + location.hash + ']');
                if (activeTab.length) {
                    activeTab.tab('show');
                } else {
                    $('.nav-tabs a:first').tab('show');
                }
            });

            $('input[type="radio"].maintenance_check').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });

            var resourcesPath    = '<?php echo addslashes(asset('')); ?>';
            CKEDITOR.replace('text-maintenance', {
                toolbarGroups: [
                    { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'links' }
                ]
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <br />
    <ul class="nav nav-tabs">
        <li class="active"><a href="#config">System Config</a></li>
    </ul>
    <div class="tab-content">
        <div id="config" class="tab-pane active">
            <br />
            <br />
            <div class="form-group">
                <a href="<?php echo e(route('admin_config_cache')); ?>" class="btn btn-info"><i class="fa fa-refresh"></i> Refresh Cache</a>
            </div>

            <form method="post" action="<?php echo e(route('admin_save_config')); ?>">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                <input type="hidden" name="_tab" value="config" />
                <br />
                <div class="form-group">
                    <h4>Maintenance Status</h4>
                    <div class="row">
                        <div class="col-xs-2">
                            <label><input type="radio" name="maintenance_mode" <?php echo e($config['maintenance_mode'] == 1 ? "checked" : ''); ?> class="maintenance_check" value="1">On</label>
                        </div>
                        <div class="col-xs-2">
                            <label><input type="radio" name="maintenance_mode" <?php echo e($config['maintenance_mode'] == 0 ? "checked" : ''); ?> class="maintenance_check" value="0">Off</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text-whitelist">Whitelist IP</label>
                    <textarea name="whitelist_ip" class="form-control" id="text-whitelist"><?php echo e($config['whitelist_ip']); ?></textarea>
                    <small>Find your ip <a href="http://www.whatsmyip.org/" target="_blank">here</a>. Use ,(commas) for several IPs</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru\app\Providers/../Modules/Admin/Views/configs/global_config.blade.php ENDPATH**/ ?>