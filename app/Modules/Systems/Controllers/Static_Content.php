<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/11/2015
 * Time: 3:19 PM
 */

namespace App\Modules\Systems\Controllers;

use App\Modules\Systems\Models\NotesModel;

class Static_Content {

    public static function load_notes($reset = FALSE) {
        $global_content = \Cache::get('notes');
        if(empty($global_content) || $reset){
            $contents = NotesModel::all();
            $global_content = array();
            foreach($contents as $content){
                $global_content[$content->name] = $content->value;
            }

            \Cache::put('notes', $global_content, 86400);
        }
        return $global_content;
    }

    public static function get($name){
        $global_content = self::load_content();
        $result = "";

        if(isset($global_content[$name])){
            $result = $global_content[$name];
        }
        return $result;
    }
}
