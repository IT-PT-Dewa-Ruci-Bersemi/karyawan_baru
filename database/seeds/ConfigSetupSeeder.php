<?php

use Illuminate\Database\Seeder;

class ConfigSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data	= [[
			'name' 					=> 'no_reply_name',
			'value' 				=> getenv('APP_NAME'),
			'config_type'			=> 'both',
		],[
			'name' 					=> 'no_reply_email',
			'value' 				=> '',
			'config_type'			=> 'both',
		],[
			'name' 					=> 'favicon',
			'value' 				=> '',
			'config_type'			=> 'both',
		],[
			'name' 					=> 'meta_title',
			'value' 				=> '',
			'config_type'			=> 'back',
		],[
			'name' 					=> 'logo',
			'value' 				=> '',
			'config_type'			=> 'back',
		],[
			'name' 					=> 'asset_path',
			'value' 				=> 'components/admin/assets/',
			'config_type'			=> 'back',
		],[
			'name' 					=> 'maintenance_mode',
			'value' 				=> '0',
			'config_type'			=> 'front',
		],[
			'name' 					=> 'backend_version',
			'value' 				=> '1.0.1',
			'config_type'			=> 'both',
		],[
			'name' 					=> 'whitelist_ip',
			'value' 				=> '1.0.1',
			'config_type'			=> 'both',
		],];

		foreach($data as $v) DB::table('config')->insert($v);
    }
}
