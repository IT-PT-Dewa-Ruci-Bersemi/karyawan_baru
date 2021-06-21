<?php

use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data	= [[
			'master_navigation_id' 	=> '1',
			'name'					=> 'dashboard',
			'menu' 					=> 'Dashboard',
			'route' 				=> 'admin_dashboard',
			'image' 				=> 'fa-chart-line',
			'order_id' 				=> '1',
			'menu_action' 			=> '',
			'menu_default' 			=> '',
			'special_permission' 	=> '',
			'parent_id' 			=> '0',
			'publish' 				=> '1',
		],[
			'master_navigation_id' 	=> '2',
			'name'					=> '',
			'menu' 					=> 'Adm. Management',
			'route' 				=> '',
			'image' 				=> 'fa-users',
			'order_id' 				=> '1',
			'menu_action' 			=> '',
			'menu_default' 			=> '',
			'special_permission' 	=> '',
			'parent_id' 			=> '0',
			'publish' 				=> '1',
		],[
			'master_navigation_id' 	=> '2',
			'name'					=> 'administrator',
			'menu' 					=> 'Administrator',
			'route' 				=> 'admin_administrator',
			'image' 				=> 'fa-users',
			'order_id' 				=> '1',
			'menu_action' 			=> 'edit;delete;fast_edit',
			'menu_default' 			=> '{"add":{"image":"fa-plus","type":"form"}}',
			'special_permission' 	=> '',
			'parent_id' 			=> '2',
			'publish' 				=> '1',
		],[
			'master_navigation_id' 	=> '2',
			'name'					=> 'administrator_group',
			'menu' 					=> 'Admin Position',
			'route' 				=> 'admin_administrator_group',
			'image' 				=> 'fa-briefcase',
			'order_id' 				=> '2',
			'menu_action' 			=> 'edit;delete;fast_edit',
			'menu_default' 			=> '{"add":{"image":"fa-plus","type":"form"}}',
			'special_permission' 	=> '',
			'parent_id' 			=> '2',
			'publish' 				=> '1',
		],[
			'master_navigation_id' 	=> '2',
			'name'					=> 'system_docs',
			'menu' 					=> 'System Documentations',
			'route' 				=> 'admin_system_docs',
			'image' 				=> 'fa-question-circle',
			'order_id' 				=> '2',
			'menu_action' 			=> '',
			'menu_default' 			=> '',
			'special_permission' 	=> '',
			'parent_id' 			=> '0',
			'publish' 				=> '1',
		],[
			'master_navigation_id' 	=> '2',
			'name'					=> 'configs',
			'menu' 					=> 'Configs',
			'route' 				=> 'admin_config',
			'image' 				=> 'fa-cogs',
			'order_id' 				=> '3',
			'menu_action' 			=> 'edit',
			'menu_default' 			=> '',
			'special_permission' 	=> '',
			'parent_id' 			=> '0',
			'publish' 				=> '1',
		]];

		foreach($data as $v) DB::table('navigation')->insert($v);
	}
}
