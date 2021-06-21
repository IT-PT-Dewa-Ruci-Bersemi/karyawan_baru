<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 07/09/2017
 * Time: 18:08
 */
?>



<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Name',width:"10",data:'name',align:'left',sort:true},
                {head:'Active',width:"1",data:'publish',align:'center',sort:true,type:'check'},
                {head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                    return '<a href="<?php echo e(url($__admin_path.'/_core/navigation/master')); ?>/'+records.id+'">Detail</a>';
                }}
            ];

            var filter  = [
                {data:'name',type:'text'}
            ];

            var button  = {
                add:[{
                    name:'name',
                    label:'Master Navigation',
                    type:'text',
                    required:true,
                    placeholder:'Input Master Navigation'
                }],
                edit:[{
                    name:'name',
                    label:'Master Navigation',
                    type:'text',
                    required:true,
                    placeholder:'Input Master Navigation'
                }]
            };


            i_form.initGrid({
                header: header,
                filter: filter,
                button: button,
                sort: <?php echo e($menu_default_sort); ?>,
                data: <?php echo json_encode($records->toArray()); ?>,
                pagination: '<?php echo $pagination; ?>',
                menu_action: <?php echo json_encode($menu_action); ?>

            },$("#grid"));
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin::templates.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Providers/../Modules/Admin/Views/core/master_navigation_grid.blade.php ENDPATH**/ ?>