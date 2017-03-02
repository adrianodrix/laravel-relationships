<?php

namespace LaravelRelationships\Http\Controllers;

use Illuminate\Http\Request;
use LaravelRelationships\Models\Country;
use LaravelRelationships\Models\State;

class OneToManyController extends Controller
{
    public function oneToMany(Request $request)
    {
        $countries = Country::where('name', 'LIKE', "%{$request->input('s')}%")
            ->with('states')
            ->get();

        foreach ($countries as $country) {
            echo "<hr/>{$country->name}";
            echo "<br/>Location: <a target='_blank' href=\"https://www.google.com.br/maps/search/{$country->location->latitude}, {$country->location->longitude}\">{$country->location->latitude}, {$country->location->longitude}</a>";

            if ($country->states->count() > 0) {
                echo "<br/><strong>Estados:</strong>";
                echo "<ul>";
                foreach ($country->states as $state) {
                    echo "<li>{$state->name} / {$state->initials}</li>";
                }
                echo "</ul>";
            }
        }
        echo "<hr/>";
    }

    public function manyToOne(Request $request)
    {
        $state = State::where('initials', $request->input('s'))
            ->with('cities')
            ->get()
            ->first();

        echo "{$state->name}/{$state->initials} ({$state->country->name})<br/>";

        if ($state->cities->count() > 0) {
            echo "<ul>";
            foreach ($state->cities as $city) {
                echo "<li>{$city->name} / {$city->state->initials}</li>";
            }
            echo "</ul>";
        }
    }

    public function hasManyThrough(Request $request)
    {
        $country = Country::where('name', 'LIKE', "%{$request->input('s')}%")
            ->with('cities')
            ->get()
            ->first();

        echo "{$country->name}<br/>";
        if ($country->cities->count() > 0) {
            echo sprintf('Total de Cidades: %d', $country->cities->count());
            echo "<ul>";
            foreach ($country->cities as $city) {
                echo "<li>{$city->name} / {$city->state->initials}</li>";
            }
            echo "</ul>";
        }
    }
}
