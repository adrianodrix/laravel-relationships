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
        $this->call(CountryTableSeeder::class);
        $this->call(StatesAndCitiesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
