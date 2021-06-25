<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Grup',width:5,data:'grup',align:'left',sort:true,type:'text'},
                {head:'Publish',width:1,data:'publish',align:'center',sort:true,type:'check'},
            ];

            var filter  = [
                {data:'grup',type:'text'}
            ];

            var button  = {
                add:[{
                    name:'grup',
                    label:'Grup',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                }],
                edit:[{
                    name:'grup',
                    label:'Grup',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                }]
            };


            i_form.initGrid({
                number: true,
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
<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/soal/soal_grup_grid.blade.php ENDPATH**/ ?>