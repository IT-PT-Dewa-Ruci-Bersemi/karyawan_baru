<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MasterNavigation extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master_navigation', function (Blueprint $table) {
			$table->engine	= 'MyISAM';
			$table->increments('id');
			$table->string('name', 100);
			$table->integer('order_id')->default(0);
			$table->tinyInteger('publish')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
