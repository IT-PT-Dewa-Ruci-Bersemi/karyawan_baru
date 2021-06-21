<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('admin_permission', function (Blueprint $table) {
			$table->engine	= 'MyISAM';

			$table->integer('position_id');
			$table->integer('navigation_id');
			$table->string('permission_menu_action', 200);
			$table->string('permission_menu_default', 200);
			$table->string('special_permission', 200);
			$table->timestamps();

			$table->primary(['position_id', 'navigation_id']);
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
