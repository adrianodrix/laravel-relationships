<?php

namespace LaravelRelationships\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'ibge_code'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
