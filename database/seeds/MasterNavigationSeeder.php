<?php

use Illuminate\Database\Seeder;

class MasterNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data	= [[
			'name'					=> 'Main Navigation',
			'order_id' 				=> '1',
			'publish' 				=> '1',
		],[
			'name'					=> 'Others',
			'order_id' 				=> '2',
			'publish' 				=> '1',
		],];

		foreach($data as $v) DB::table('master_navigation')->insert($v);
    }
}
