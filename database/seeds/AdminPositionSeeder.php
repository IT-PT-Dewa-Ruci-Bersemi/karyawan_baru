<?php

use Illuminate\Database\Seeder;

class AdminPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data	= [[
			'name' 					=> 'Developer',
			'level' 				=> '101',
			'active' 				=> '1',
		],[
			'name' 					=> 'Super Admin',
			'level' 				=> '100',
			'active' 				=> '1',
		],];

		foreach($data as $v) DB::table('admin_position')->insert($v);
    }
}
