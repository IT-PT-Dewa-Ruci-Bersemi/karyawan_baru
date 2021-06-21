<?php namespace App\Modules\Frontend\Controllers;

use App\Modules\Systems\Controllers\Systems;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class EchoController extends Controller {
    protected $resetCache	= true;

	public function __construct(){
		parent::__construct();
        $this->initData();
        $this->startup();
	}

    protected function startup() {}

    protected function setMeta($title='', $description='', $keywords='') {
	    $this->data['site_title']   = $title;
	    $this->data['_meta_descriptions']   = $description;
	    $this->data['_meta_keywords']       = $keywords;
    }

	public function initData(){
        $this->data		= Systems::load_config('front', $this->resetCache);

        //Load SEO
//        $seo		    = StaticContent::loadContent('seo', $this->resetCache);
//        $content        = StaticContent::loadContent('content', $this->resetCache);
//        $contentJSON    = StaticContent::loadContent('content_json', $this->resetCache);

//        foreach($seo as $name=>$value) {
//            $this->data['seo'][$name]	= json_decode($value);
//        }
//        if(isset($this->data['seo'])) $this->data['seo']	= (object)$this->data['seo'];
//        foreach($contentJSON as $name=>$value) {
//            $this->data[$name]  = json_decode($value);
//        }

        //Load Content
//        $this->data	= array_merge($this->data, $content);
    }

    protected function set_meta($type){
        $this->data['web_title']            = $this->data['seo']->{$type}->meta_title;
        $this->data['web_description']      = $this->data['seo']->{$type}->meta_description;
        $this->data['web_keywords']         = $this->data['seo']->{$type}->meta_keywords;
        $this->set_og();
    }

    protected function setManualMeta($title, $description, $keyword, $fullURLImage=false) {
        $this->data['web_title']        = $title;
        $this->data['web_description']  = $description;
        $this->data['web_keywords']     = $keyword;
        $this->set_og($fullURLImage);
    }

    private function set_og($image=false){
        if(!$image) $this->data['meta_full_image']  	= $image;
        else $this->data['meta_full_image']  		    = asset('components/both/images/web/'.$this->data['website_logo']);
        $this->data['facebook_meta']['og:title']        = $this->data['web_title'];
        $this->data['facebook_meta']['og:site_name']    = $this->data['web_title'];
        $this->data['facebook_meta']['og:url']          = Request::url();
        $this->data['facebook_meta']['og:type']         = "article";
        $this->data['facebook_meta']['og:locale']       = "id_ID";
        $this->data['facebook_meta']['og:image']        = $this->data['meta_full_image'];
        $this->data['facebook_meta']['og:description']  = $this->data['web_description'];

        $this->data['twitter_meta']['twitter:card']          = "summary_large_image";
        $this->data['twitter_meta']['twitter:site']          = "@".$this->data['web_title'];
        $this->data['twitter_meta']['twitter:creator']       = "@".$this->data['web_title'];
        $this->data['twitter_meta']['twitter:url']           = Request::url();
        $this->data['twitter_meta']['twitter:title']         = $this->data['web_title'];
        $this->data['twitter_meta']['twitter:image']         = $this->data['meta_full_image'];
        $this->data['twitter_meta']['twitter:description']   = $this->data['web_description'];
    }
}
