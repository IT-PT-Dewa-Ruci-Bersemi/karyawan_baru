<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Grup',width:3,data:'grup',align:'left',sort:true,type:'text'},
                {head:'Jawab',width:1,data:'jawaban',align:'center',sort:true,type:'text'},
                {head:'Cek',width:1,data:'cek',align:'center',sort:true,type:'check'},
                {head:'',width:"2",type:'custom',align:'center',render:function (records, value) {
                    return '<a href="<?php echo e(url($__admin_path.'/cek')); ?>/'+records.id+'">Detail</a>';
                }},

            ];

            var filter  = [];

            var button  = {};


            i_form.initGrid({
                number: true,
                header: header,
                filter: [],
                button: [],
                sort: <?php echo e($menu_default_sort); ?>,
                data: <?php echo json_encode($records->toArray()); ?>,
                pagination: '<?php echo $pagination; ?>',
                menu_action: <?php echo json_encode($menu_action); ?>

            },$("#grid"));
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru-1\app\Providers/../Modules/Admin/Views/soal/vw_grup_soal_jawaban.blade.php ENDPATH**/ ?>