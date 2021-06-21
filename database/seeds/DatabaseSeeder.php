<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(NavigationSeeder::class);
         $this->call(MasterNavigationSeeder::class);
         $this->call(AdministratorSeeder::class);
         $this->call(AdminPermissionSeeder::class);
         $this->call(AdminPositionSeeder::class);
         $this->call(ConfigSetupSeeder::class);
    }
}
