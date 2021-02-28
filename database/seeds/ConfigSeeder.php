<?php

use Illuminate\Database\Seeder;
use App\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //default need to run webside
        Config::create(['name' => 'price_per_day','value' => 10000]);
        Config::create(['name' => 'merchant_id','value' => '50511']);
        Config::create(['name' => 'api_user','value' => '5a8fb84a3cefe']);
        Config::create(['name' => 'api_password','value' => 'f4d836dd40780f1e941ae2ff66a0869d']);
    }
}
