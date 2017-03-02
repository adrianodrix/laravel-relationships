<?php

namespace LaravelRelationships\Http\Controllers;

use Illuminate\Http\Request;
use LaravelRelationships\Models\City;
use LaravelRelationships\Models\Comment;
use LaravelRelationships\Models\Company;
use LaravelRelationships\Models\Country;
use LaravelRelationships\Models\State;

class PolymorphicController extends Controller
{
    public function polymorphic(Request $request)
    {
        echo '<br/>'. Company::all()->first()->comments()->first()->body;
        echo '<br/>'. City::all()->first()->comments()->first()->body;
        echo '<br/>'. State::all()->first()->comments()->first()->body;
        echo '<br/>'. Country::all()->first()->comments()->first()->body;
    }

    public function polymorphicInverse(Request $request)
    {
        foreach (Comment::all() as $comment)
        {
            echo sprintf('<strong>%s:</strong> %s<br/>', $comment->commentable->name, $comment->body);
        }
    }
}
