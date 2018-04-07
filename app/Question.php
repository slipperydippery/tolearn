<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }

    public function resources()
    {
    	return $this->hasMany(Resource::class);
    }
}
