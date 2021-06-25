<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 20/06/2016
 * Time: 10:19
 */
?>


<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Admin Group Name',width:"8",data:'name',align:'left',sort:true},
                {head:'Level',width:"3",data:'level',align:'left',sort:true},
                {head:'Active',width:"1",data:'active',align:'center',sort:true,type:'check'},
                {head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                    return '<a href="<?php echo e(url($__admin_path.'/administrator_group/permission')); ?>/'+records.id+'">Permissions</a>';
                }}
            ];

            var filter  = [
                {data:'name', type:'text'}
            ];

            var button  = {
                add:[{
                    name:'name',
                    label:'Group Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Group Name'
                },{
                    name:'level',
                    label:'Level',
                    type:'number',
                    placeholder:'Input Number of Level (1-<?php echo e($level); ?>)',
                    properties: {
                        min:1
                    },
                    required:true
                }],
                edit:[{
                    name:'name',
                    label:'Group Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Group Name'
                },{
                    name:'level',
                    label:'Level',
                    type:'number',
                    placeholder:'Input Number of Level (1-<?php echo e($level); ?>)',
                    properties: {
                        min:1,
                        max:<?php echo e($level); ?>

                    },
                    required:true
                }]
            };

            i_form.initGrid({
                header: header,
                filter:filter,
                button: button,
                sort: <?php echo e($menu_default_sort); ?>,
                data: <?php echo json_encode($records->toArray()); ?>,
                pagination: '<?php echo $pagination; ?>',
                menu_action: <?php echo json_encode($menu_action); ?>

            },$("#grid"));
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/administrator/group_grid.blade.php ENDPATH**/ ?>