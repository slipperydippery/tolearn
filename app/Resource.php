<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $guarded = [];

    public function questions()
    {
    	return $this->belongsTo(Question::class);
    }
}
