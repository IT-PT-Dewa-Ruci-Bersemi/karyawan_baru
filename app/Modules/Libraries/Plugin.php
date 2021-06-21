<?php
namespace App\Modules\Libraries;

class Plugin {

    private static $js  = [
        'datepicker'        => 'components/shared/plugins/datepicker/bootstrap-datepicker.js',
        'daterangepicker'   => [
            'components/shared/plugins/daterangepicker/moment.min.js',
            'components/shared/plugins/daterangepicker/daterangepicker.js'
        ],
        'timepicker'        => 'components/shared/plugins/timepicker/bootstrap-timepicker.min.js',
        'editor'            => 'components/shared/plugins/ckeditor/ckeditor.js',
        'dropzone'          => 'components/shared/plugins/dropzone/dropzone.js',
        'jquery_steps'      => 'components/shared/plugins/jquery-steps/jquery.steps.min.js',
        'jquery_validation' => [
            'components/shared/plugins/jquery-validation/jquery.validate.min.js',
            'components/shared/plugins/jquery-validation/additional-methods.min.js',
        ],
        'jquery_ui'         => 'components/shared/plugins/jQueryUI/jquery-ui.min.js',
        'select2'           => 'components/shared/plugins/select2/select2.full.min.js',
        'icheck'            => 'components/shared/plugins/iCheck/icheck.min.js',
        'owlcarousel'       => 'components/shared/plugins/owlcarousel2/owl.carousel.min.js',
        'jssocials'         => 'components/shared/plugins/jssocials/jssocials.min.js',
        'jcarousel'         => 'components/shared/plugins/jcarousel/jquery.jcarousel.min.js',
        'zoom'              => 'components/shared/plugins/elevateZoom/jquery.elevateZoom-3.0.8.min.js',
        'clipboard'         => [
            'components/shared/plugins/clipboard/clipboard.min.js',
            'components/shared/plugins/itooltip/itooltip.js',
        ],
        'chartjs'           => 'components/shared/plugins/chart.js/Chart.min.js',
        'bootbox'           => 'components/shared/plugins/bootbox/bootbox.min.js',
        'notify'			=> 'components/shared/plugins/bootstrap-notify/bootstrap-notify.min.js',
        'datatable'         => [
            'components/shared/plugins/datatables/jquery.dataTables.min.js',
            'components/shared/plugins/datatables/dataTables.bootstrap.min.js'
        ],
        'datatable_fixed_col'       => [
            'components/shared/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js',
        ],
        'datatable_fixed_header'    => [
            'components/shared/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedColumns.min.js',
        ],
        'candlestick'               => [
            'components/shared/plugins/techan/d3.v4.min.js',
            'components/shared/plugins/techan/techan.min.js',
        ],
        'bootstrap_toggle'          => 'components/shared/plugins/bootstrap-toggle/bootstrap-toggle.min.js',
    ];

    private static $style   = [
        'datepicker'        => 'components/shared/plugins/datepicker/datepicker3.css',
        'daterangepicker'   => 'components/shared/plugins/daterangepicker/daterangepicker-bs3.css',
        'timepicker'        => 'components/shared/plugins/timepicker/bootstrap-timepicker.min.css',
        'dropzone'          => 'components/shared/plugins/dropzone/dropzone.css',
        'select2'           => [
            'components/shared/plugins/select2/select2.min.css',
            'components/shared/plugins/select2/select2-bootstrap.min.css'
        ],
        'icheck'            => 'components/shared/plugins/iCheck/all.css',
        'owlcarousel'       => [
        	'components/shared/plugins/owlcarousel2/owl.carousel.min.css',
        	'components/shared/plugins/owlcarousel2/owl.theme.default.min.css'
		],
        'jssocials'         => 'components/shared/plugins/jssocials/jssocials.css',
		'notify'			=> 'components/shared/plugins/animate/animate.css',
        'datatable'         => [
            'components/shared/plugins/datatables/jquery.dataTables.min.css',
            'components/shared/plugins/datatables/dataTables.bootstrap.css'
        ],
        'datatable_fixed_col'       => 'components/shared/plugins/datatables/extensions/FixedColumns/css/dataTables.fixedColumns.min.css',
        'datatable_fixed_header'    => 'components/shared/plugins/datatables/extensions/FixedHeader/css/dataTables.fixedHeader.min.css',
        'bootstrap_toggle'          => 'components/shared/plugins/bootstrap-toggle/bootstrap-toggle.min.css',
    ];

    private static function checkSubdomain() {
        if((bool)getenv('MULTIPLE_SUBDOMAIN')) {
            $domain	= $_SERVER['HTTP_HOST'];
            $subDomain = explode('.', $domain)[0];

            if($subDomain == getenv('SUBDOMAIN_ADMIN_PREFIX')) {
                return getenv('APP_ADMIN_URL');
            } else if($subDomain == getenv('SUBDOMAIN_PREFIX')) {
                return getenv('APP_LAMBDA_URL');
            }
        }
        return getenv('APP_URL');
    }

    public static function get($index) {
        $base_url   = self::checkSubdomain();
        $temp       = '';

        if(isset(self::$js[$index])){
            if(is_array(self::$js[$index])) {
                foreach(self::$js[$index] as $value) {
                    $temp       .= '<script type="text/javascript" src="'.$base_url.'/'.$value.'"></script>';
                }
            } else $temp        .= '<script type="text/javascript" src="'.$base_url.'/'.self::$js[$index].'"></script>';
        }
        if(isset(self::$style[$index])) {
            if(is_array(self::$style[$index])) {
                foreach(self::$style[$index] as $value) {
                    $temp   .= '<link rel="stylesheet" href="'.$base_url.'/'.$value.'" type="text/css" />';
                }
            } else $temp    .= '<link rel="stylesheet" href="'.$base_url.'/'.self::$style[$index].'" type="text/css" />';
        }

        return $temp;
    }
}

?>