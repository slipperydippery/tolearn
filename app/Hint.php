<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hint extends Model
{
    protected $guarded = [];

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
}
