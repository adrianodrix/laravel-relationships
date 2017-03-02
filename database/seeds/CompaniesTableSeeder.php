<?php

use Illuminate\Database\Seeder;
use LaravelRelationships\Models\City;
use LaravelRelationships\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->delete();

        $city = City::where('name', 'LIKE', "Maringá%")
            ->with(['state', 'companies'])
            ->get()
            ->first();

        $city->companies()->save(Company::create(['name' => 'ACME']));
        $city->companies()->save(Company::create(['name' => 'ACME II']));
        $city->companies()->save(Company::create(['name' => 'New Company']));
    }
}
