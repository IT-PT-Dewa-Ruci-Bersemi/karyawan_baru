<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 22/02/2018
 * Time: 13:24
 */
namespace App\Modules\Admin\Models\Core;

use App\Modules\Admin\Models\CoreGenesisModel;

class DocsModel extends CoreGenesisModel {
	protected $table    = 'docs';

	public function children($onlyPublish=false) {
		if($onlyPublish)
			return $this->hasMany($this->namespace.'\Core\DocsModel', 'parent_id', 'id')->where('publish', 1)->orderBy('order_id');
		return $this->hasMany($this->namespace.'\Core\DocsModel', 'parent_id', 'id')->orderBy('order_id');
	}

	public function findChildren($permalink) {
		return $this->hasMany($this->namespace.'\Core\DocsModel', 'parent_id', 'id')
			->where('permalink', $permalink)->count();
	}

	public function parent() {
		return $this->hasOne($this->namespace.'\Core\DocsModel', 'id', 'parent_id');
	}
}