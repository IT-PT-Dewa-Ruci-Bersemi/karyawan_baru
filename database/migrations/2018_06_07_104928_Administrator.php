<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Administrator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('administrator', function (Blueprint $table) {
			$table->engine	= 'MyISAM';
			$table->increments('id');
			$table->string('email', 100);
			$table->string('username', 30);
			$table->string('password', 150);
			$table->string('name', 100);
			$table->enum('gender', ['male', 'female']);
			$table->string('image', 100);
			$table->integer('position_id')->default(0);
			$table->dateTime('last_login')->nullable(true);
			$table->tinyInteger('active')->default(0);
			$table->integer('warning_counter')->default(0);
			$table->string('remember_token', 100)->nullable(true);
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
