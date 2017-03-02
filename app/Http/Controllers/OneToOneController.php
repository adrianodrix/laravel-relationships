<?php

namespace LaravelRelationships\Http\Controllers;

use Illuminate\Http\Request;
use LaravelRelationships\Models\Country;
use LaravelRelationships\Models\Location;

class OneToOneController extends Controller
{
    public function oneToOne(Request $request)
    {
        $countries = Country::where('name', 'LIKE', "%{$request->input('s')}%")->get();
        foreach ($countries as $country) {
            echo "<hr/>{$country->name}";
            echo "<br/>Location: <a target='_blank' href=\"https://www.google.com.br/maps/search/{$country->location->latitude}, {$country->location->longitude}\">{$country->location->latitude}, {$country->location->longitude}</a>";
        }
        echo "<hr/>";
    }

    public function oneToOneInverse(Request $request)
    {
        $location = Location::where('latitude', $request->input('latitude'))
            ->where('longitude', $request->input('longitude'))
            ->get()
            ->first();

        echo "{$location->country->name}";
    }
}
