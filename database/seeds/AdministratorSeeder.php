<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data	= [[
			'email'					=> 'admin@admin.com',
            'username'              => 'super_admin',
			'password' 				=> '$2y$10$LNMqLeK5Vi4A7dSY2w7yXeUYD.ritdsi0iFarmHGccgdyonZ9KGkq',
			'name' 					=> 'Administrator',
			'gender' 				=> 'male',
			'image' 				=> '',
			'position_id' 			=> '1',
			'last_login' 			=> '',
			'active' 				=> '1',
			'warning_counter' 		=> '0',
			'remember_token' 		=> '',
		]];

		foreach($data as $v) DB::table('administrator')->insert($v);
    }
}
