<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 22/02/2018
 * Time: 13:25
 */
?>


<?php $__env->startSection('scripts'); ?>
    <?php echo \App\Modules\Libraries\Plugin::get('editor'); ?>

    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Title',width:"10",data:'menu',align:'left',sort:true},
                {head:'Active',width:"1",data:'publish',align:'center',sort:true,type:'check'}
                <?php if($view_detail): ?>
                ,{head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                        return '<a href="<?php echo e(url($__admin_path.'/_core/docs')); ?>/'+records.id+'">Detail</a>';
                    }}
                <?php endif; ?>
            ];

            var filter  = [
                {data:'menu',type:'text'}
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
                        type:'hidden'
                    },{
                        name:'menu',
                        label:'Title',
                        type:'text',
                        required:true,
                        permalink:true,
                        placeholder:'Input Docs Title'
                    },{
                        name:'detail',
                        label:'Detail',
                        type:'editor',
                        admin:true
                    }],
                edit:[{
                    name:'menu',
                    label:'Title',
                    type:'text',
                    required:true,
                    permalink:true,
                    placeholder:'Input Docs Title'
                },{
                    name:'detail',
                    label:'Detail',
                    type:'editor',
                    admin:true
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


<?php echo $__env->make("admin::templates.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/echoinfinite/Documents/bootcamp/empty/app/Providers/../Modules/Admin/Views/core/docs_grid.blade.php ENDPATH**/ ?>