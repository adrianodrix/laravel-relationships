<?php

namespace LaravelRelationships\Http\Controllers;

use Illuminate\Http\Request;
use LaravelRelationships\Models\City;
use LaravelRelationships\Models\Company;

class ManyToManyController extends Controller
{
    public function manyToMany(Request $request)
    {
        $city = City::where('name', 'LIKE', "{$request->input('s')}%")
            ->with(['state', 'companies'])
            ->get()
            ->first();

        echo "{$city->name}/{$city->state->initials}<br/>";
        if ($city->companies->count() > 0) {
            echo sprintf('Total de Empresas: %d', $city->companies->count());
            echo "<ul>";
            foreach ($city->companies as $company) {
                echo "<li>{$company->name}</li>";
            }
            echo "</ul>";
        }
    }

    public function manyToManyInverse(Request $request)
    {
        $company = Company::where('name', 'LIKE', "{$request->input('s')}%")
            ->get()
            ->first();

        echo "{$company->name}<br/>";
        echo "<ul>";
        foreach ($company->cities as $city) {
            echo "<li>{$city->name}</li>";
        }
        echo "</ul>";
    }

    public function manyToManyInsert(Request $request)
    {
        $company = Company::where('name', 'LIKE', "{$request->input('s')}%")
            ->get()
            ->first();

        $company->cities()->sync([3,4,5,6]);

        echo "{$company->name}<br/>";
        echo "<ul>";
        foreach ($company->cities as $city) {
            echo "<li>{$city->name}</li>";
        }
        echo "</ul>";
    }
}
