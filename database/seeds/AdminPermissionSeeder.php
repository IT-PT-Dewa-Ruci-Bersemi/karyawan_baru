<?php

use Illuminate\Database\Seeder;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data	= [[
			'position_id'				=> '1',
			'navigation_id' 			=> '1',
			'permission_menu_action'	=> '',
			'permission_menu_default'	=> '',
			'special_permission'		=> '',
		],[
			'position_id'				=> '1',
			'navigation_id' 			=> '2',
			'permission_menu_action'	=> '',
			'permission_menu_default'	=> '',
			'special_permission'		=> '',
		],[
			'position_id'				=> '1',
			'navigation_id' 			=> '3',
			'permission_menu_action'	=> 'edit;delete;fast_edit',
			'permission_menu_default'	=> 'add',
			'special_permission'		=> '',
		],[
			'position_id'				=> '1',
			'navigation_id' 			=> '4',
			'permission_menu_action'	=> 'edit;delete;fast_edit',
			'permission_menu_default'	=> 'add',
			'special_permission'		=> '',
		],[
			'position_id'				=> '1',
			'navigation_id' 			=> '5',
			'permission_menu_action'	=> '',
			'permission_menu_default'	=> '',
			'special_permission'		=> '',
		],[
			'position_id'				=> '1',
			'navigation_id' 			=> '6',
			'permission_menu_action'	=> 'edit',
			'permission_menu_default'	=> '',
			'special_permission'		=> '',
		]];

		foreach($data as $v) DB::table('admin_permission')->insert($v);
    }
}
