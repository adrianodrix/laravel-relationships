<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


$this->get('/geo', function () {
    $geo = app('geocoder')->geocode('Brazil')->all();
    dd($geo[0]->getCoordinates());
});

$this->get('one-to-one', 'OneToOneController@oneToOne');
$this->get('one-to-one-inverse', 'OneToOneController@oneToOneInverse');

$this->get('one-to-many', 'OneToManyController@oneToMany');
$this->get('many-to-one', 'OneToManyController@manyToOne');

$this->get('many-through', 'OneToManyController@hasManyThrough');

$this->get('many-to-many', 'ManyToManyController@manyToMany');
$this->get('many-to-many-inverse', 'ManyToManyController@manyToManyInverse');
$this->get('many-to-many-insert', 'ManyToManyController@manyToManyInsert');

$this->get('polymorphic', 'PolymorphicController@polymorphic');
$this->get('polymorphic-inverse', 'PolymorphicController@polymorphicInverse');
