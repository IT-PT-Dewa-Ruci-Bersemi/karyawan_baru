<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Soal',width:2,data:'parent_id',sort:true, align:'left',type:'relation',belongsTo:['soal','menu']},
                {head:'Detail',width:2,data:'detail',align:'center',sort:true,type:'check'},
                {head:'Publish',width:2,data:'publish',align:'center',sort:true,type:'check'},
            ];

            var filter  = [
                {data:'category_id',type:'select', options: $.parseJSON('<?php echo json_encode($soal); ?>')},
                {data:'soal',type:'text'}
            ];

            var button  = {
                add:[{
                    name:'parent_id',
                    label:'Soal Parent',
                    type:'select',
                    data:<?php echo json_encode($soal); ?>,
                    required:true
                },{
                    name:'nama',
                    label:'Soal',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                },{
                    name:'detail',
                    label:'Detail',
                    type:'radio',
                    required:true,
                    option:[
                        {value:"1",display:"Ya"},
                        {value:"0",display:"tidak"}
                    ]
                }],
                edit:[{
                    name:'parent_id',
                    label:'Soal Parent',
                    type:'select',
                    data:<?php echo json_encode($soal); ?>,
                    required:true
                },{
                    name:'nama',
                    label:'Soal',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                },{
                    name:'detail',
                    label:'Detail',
                    type:'radio',
                    required:true,
                    option:[
                        {value:"1",display:"Ya"},
                        {value:"0",display:"tidak"}
                    ]
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

<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru\app\Providers/../Modules/Admin/Views/soal/soal_grid.blade.php ENDPATH**/ ?>baru\app\Providers/../Modules/Admin/Views/soal/soal_grid.blade.php ENDPATH**/ ?>u\app\Providers/../Modules/Admin/Views/soal/soal_grid.blade.php ENDPATH**/ ?>PATH**/ ?>?>         {value:"0",display:"tidak"}
                    ]
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

<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru\app\Providers/../Modules/Admin/Views/soal/soal_grid.blade.php ENDPATH**/ ?>