<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminPosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('admin_position', function (Blueprint $table) {
			$table->engine	= 'MyISAM';

			$table->increments('id');
			$table->string('name', 100);
			$table->integer('level')->default(0);
			$table->tinyInteger('active')->default(0);
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
