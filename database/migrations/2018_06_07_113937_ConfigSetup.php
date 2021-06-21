<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfigSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('config', function (Blueprint $table) {
			$table->engine	= 'MyISAM';

			$table->increments('id');
			$table->string('name', 100);
			$table->text('value')->nullable(true);
			$table->enum('config_type', ['front', 'back', 'both']);
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
