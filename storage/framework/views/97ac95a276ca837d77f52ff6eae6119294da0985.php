<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 12/04/19
 * Time: 11.19
 */
?>
<!-- Tweaks for older IEs--><!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
<script src="<?php echo e(asset('components/shared/plugins/jQuery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('components/shared/plugins/popper.js/umd/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('components/shared/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('components/shared/plugins/jquery.cookie/jquery.cookie.js')); ?>"></script>
<script src="<?php echo e(asset('components/shared/plugins/jquery.cookie/jquery.cookie.js')); ?>"></script>
<script src="<?php echo e(asset('components/shared/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('components/shared/plugins/nicescroll/jquery.nicescroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('components/admin/themes/stisla/js/stisla.js')); ?>"></script>

<script src="<?php echo e(asset('components/admin/assets/js/i_modal.js')); ?>"></script>
<script src="<?php echo e(asset('components/admin/assets/js/i_form.js')); ?>"></script>
<script src="<?php echo e(asset('components/admin/assets/js/date.js')); ?>"></script>
<script src="<?php echo e(asset('components/admin/assets/js/globalSettings.js')); ?>"></script>
<script src="<?php echo e(asset('components/shared/js/helper.js')); ?>"></script>






<script src="<?php echo e(asset('components/admin/assets/js/scripts.js')); ?>"></script>
<script src="<?php echo e(asset('components/admin/assets/js/loading-bar.js')); ?>"></script>


<script type="text/javascript">
    var __sort          = '<?php echo e(isset($_sort) ? $_sort:''); ?>';
    var __sort_method   = '<?php echo e(isset($_method) ? $_method:''); ?>';
    var __filter        = $.parseJSON('<?php echo isset($_filter) ? json_encode($_filter):json_encode(''); ?>');
    var __filter_url    = '<?php echo e(isset($_filter_url) ? $_filter_url : ""); ?>';
    var __current_page  = '<?php echo e(URL::current()); ?>';
    var __base_path     = "<?php echo addslashes(getenv('APP_URL')); ?>";
    

    $(function() {
        $('[data-toggle="tooltip"]').tooltip();


        $('.form-validate').each(function() {
            $(this).validate({
                errorElement: "div",
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                ignore: ':hidden:not(.summernote),.note-editable.card-block',
                errorPlacement: function (error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    //console.log(element);
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.siblings("label"));
                    }
                    else {
                        error.insertAfter(element);
                    }
                }
            });
        });

        var materialInputs = $('input.input-material');

        // activate labels for prefilled values
        materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

        // move label on focus
        materialInputs.on('focus', function () {
            $(this).siblings('.label-material').addClass('active');
        });

        // remove/keep label on blur
        materialInputs.on('blur', function () {
            $(this).siblings('.label-material').removeClass('active');

            if ($(this).val() !== '') {
                $(this).siblings('.label-material').addClass('active');
            } else {
                $(this).siblings('.label-material').removeClass('active');
            }
        });


        var pageContent = $('.page-content');

        $(document).on('sidebarChanged', function () {
            adjustFooter();
        });

        $(window).on('resize', function(){
            adjustFooter();
        })

        function adjustFooter() {
            var footerBlockHeight = $('.footer__block').outerHeight();
            pageContent.css('padding-bottom', footerBlockHeight + 'px');
        }

        $('.dropdown').on('show.bs.dropdown', function () {
            $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100).addClass('active');
        });
        $('.dropdown').on('hide.bs.dropdown', function () {
            $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100).removeClass('active');
        });

        $('.sidebar-toggle').on('click', function () {
            $(this).toggleClass('active');

            $('#sidebar').toggleClass('shrinked');
            $('.page-content').toggleClass('active');
            $(document).trigger('sidebarChanged');

            if ($('.sidebar-toggle').hasClass('active')) {
                $('.navbar-brand .brand-sm').addClass('visible');
                $('.navbar-brand .brand-big').removeClass('visible');
                $(this).find('i').attr('class', 'fa fa-long-arrow-right');
            } else {
                $('.navbar-brand .brand-sm').removeClass('visible');
                $('.navbar-brand .brand-big').addClass('visible');
                $(this).find('i').attr('class', 'fa fa-long-arrow-left');
            }
        });
    });
</script>
<?php echo \App\Modules\Libraries\Plugin::get('bootbox'); ?>


<?php if($menu_default_sort): ?>
    <?php echo Plugin::get('jquery_ui'); ?>

<?php endif; ?>
<?php echo $__env->yieldContent('scripts'); ?><?php /**PATH C:\xampp\htdocs\karyawan_baru\app\Providers/../Modules/Admin/Views/templates/parts/footer_script.blade.php ENDPATH**/ ?>