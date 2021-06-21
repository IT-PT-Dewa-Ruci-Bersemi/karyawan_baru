<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Navigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('navigation', function (Blueprint $table) {
			$table->engine	= 'MyISAM';
			$table->increments('id');
			$table->integer('master_navigation_id');
			$table->string('name', 100)->nullable(true);
			$table->string('menu', 100);
			$table->string('route', 120)->nullable(true);
			$table->string('image', 100)->nullable(true);
			$table->integer('order_id')->default(0);
			$table->text('menu_action')->nullable(true);
			$table->text('menu_default')->nullable(true);
			$table->text('special_permission')->nullable(true);
			$table->integer('parent_id')->default(0);
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
