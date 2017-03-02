<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        \LaravelRelationships\Models\Company::all()->first()->comments()->create([
            'body' => 'Company Comment I '. date('YmdHis')
        ]);

        \LaravelRelationships\Models\City::all()->first()->comments()->create([
            'body' => 'City Comment II '. date('YmdHis')
        ]);

        \LaravelRelationships\Models\State::all()->first()->comments()->create([
            'body' => 'State Comment III '. date('YmdHis')
        ]);

        \LaravelRelationships\Models\Country::all()->first()->comments()->create([
            'body' => 'Country Comment IV '. date('YmdHis')
        ]);
    }
}
