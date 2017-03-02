<?php

use Illuminate\Database\Seeder;
use LaravelRelationships\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('countries')->truncate();
        DB::table('states')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $brasil = $this->addCountry('Brasil');
        $china  = $this->addCountry('China');
        $franca = $this->addCountry('França');

        $china->states()->create(['name' => 'Beijing', 'initials' => 'BJ']);
        $china->states()->create(['name' => 'Tianjin', 'initials' => 'TJ']);
        $china->states()->create(['name' => 'Shanghai', 'initials' => 'SH']);


        $franca->states()->create(['name' => 'Bourgogne', 'initials' => 'BO']);
        $franca->states()->create(['name' => 'Aquitaine', 'initials' => 'AQ']);
        $franca->states()->create(['name' => 'Normandy', 'initials' => 'NO']);
    }

    public function addCountry($country)
    {
        $geo = app('geocoder')->geocode($country)->all();

        $country =  Country::create([
            'name' => $country,
        ]);

        $country->location()->create([
            'latitude' => $geo[0]->getCoordinates()->getLatitude(),
            'longitude' => $geo[0]->getCoordinates()->getLongitude(),
        ]);

        return $country;
    }
}
