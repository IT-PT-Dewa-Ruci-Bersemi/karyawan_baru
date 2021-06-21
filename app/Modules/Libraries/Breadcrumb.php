<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/12/2015
 * Time: 6:26 AM
 */

namespace App\Modules\Libraries;

use Illuminate\Support\Str;

class Breadcrumb
{
    private static $_breadcrumbs = array();

    public static function add($text, $url = ''){
        $count = count(self::$_breadcrumbs);

        if($count>0)
            self::$_breadcrumbs[$count - 1]['last'] = false;

        self::$_breadcrumbs[$count]['text'] 	= ucwords($text);
        self::$_breadcrumbs[$count]['url'] 		= $url;
        self::$_breadcrumbs[$count]['last'] 	= true;
    }

    public static function get($separator = '', $wrapp = "li"){
        $return = '';

        if($wrapp == 'li'){
            $return  .= '<div class="section-header-breadcrumb">';
            $length = count(self::$_breadcrumbs);
            foreach(self::$_breadcrumbs as $index=>$bc){
                $return .= "<div class='breadcrumb-item ". ($bc['last']?'active':'') ."'>";
                if($length-1 != $index) $return .= "<a href='".$bc['url']."'>".$bc['text']."</a>";
                else $return .= Str::limit($bc['text'], 20);
                $return .= "</div>";
                if($separator!='' && !$bc['last']){
                    $return .= "<div class='breadcrumb-item'>".$separator."</div>";
                }
            }
            $return .= "</div>";
        }else{
            foreach(self::$_breadcrumbs as $bc) {
                $return .= "<a href='" . $bc['url'] . "' " . ($bc['last'] ? ' class="last"' : '') . ">" . $bc['text'] . "</a>";
                if ($separator != '' && !$bc['last']) {
                    $return .= "<span>" . $separator . "</span>";
                }
            }
        }

        return $return;
    }

    public static function get_raw(){
        return self::$_breadcrumbs;
    }
}