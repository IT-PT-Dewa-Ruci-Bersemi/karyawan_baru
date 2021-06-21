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
                {head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                        return '<i class="fa '+records.image+'"></i>';
                    }},
                {head:'Label',width:"3",data:'menu',align:'left',sort:true},
                {head:'System Alias',width:"3",data:'name',align:'left',sort:true},
                {head:'Route',width:"4",data:'route',align:'left',sort:true},
                {head:'Active',width:"1",data:'publish',align:'center',sort:true,type:'check'},
                {head:'', width:"1",type:'custom',render:function(records, value) {
                    if(!records.subnav.length) {
                        return '<a href="<?php echo e(url($__admin_path.'/_core/navigation/permission/')); ?>/'+records.id+'">Permission</a>';
                    } else {
                        return '';
                    }
                }}
                <?php if($enableTree): ?>
                ,{head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                        return '<a href="<?php echo e(url($__admin_path.'/_core/navigation/')); ?>/'+records.master_navigation_id+'/'+records.id+'">Detail</a>';
                    }}
                <?php endif; ?>
            ];

            var filter  = [
                {data:'name',type:'text'}
            ];

            var button  = {
                add:[
                <?php if($parent_id): ?>
                    {
                        name:'parent_id',
                        type:'hidden',
                        value: '<?php echo e($parent_id); ?>'
                    },
                <?php endif; ?>
                {
                    name:'order_id',
                    type:'hidden',
                    value:'<?php echo e($total_data + 1); ?>'
                },{
                    name:'master_navigation_id',
                    type:'hidden',
                    value:'<?php echo e($mnavid); ?>'
                },{
                    name:'name',
                    label:'System Alias',
                    type:'text',
                    placeholder:'Input System Alias'
                },{
                    name:'menu',
                    label:'Label',
                    type:'text',
                    required:true,
                    placeholder:'Input Label Menu Name'
                }, {
                    name:'route',
                    label:'Route',
                    type:'text',
                    placeholder:'Input Admin Route'
                }, {
                    name:'image',
                    label:'Image',
                    type:'text',
                    required:true,
                    placeholder:'Input Font Awesome Icon CSS'
                }],
                edit:[{
                    name:'master_navigation_id',
                    type:'hidden',
                    value:'<?php echo e($mnavid); ?>'
                },{
                    name:'name',
                    label:'System Alias',
                    type:'text',
                    placeholder:'Input System Alias'
                },{
                    name:'menu',
                    label:'Label',
                    type:'text',
                    required:true,
                    placeholder:'Input Label Menu Name'
                }, {
                    name:'route',
                    label:'Route',
                    type:'text',
                    placeholder:'Input Admin Route'
                }, {
                    name:'image',
                    label:'Image',
                    type:'text',
                    required:true,
                    placeholder:'Input Font Awesome Icon CSS'
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

<?php echo $__env->make("admin::templates.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru\app\Providers/../Modules/Admin/Views/core/nav_grid.blade.php ENDPATH**/ ?>