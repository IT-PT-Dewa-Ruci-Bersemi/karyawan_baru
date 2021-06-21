<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Docs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('docs', function (Blueprint $table) {
			$table->engine	= 'MyISAM';

			$table->increments('id');
			$table->integer('parent_id')->default(0);
			$table->string('menu', 100);
			$table->string('permalink', 100);
			$table->text('detail');
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
