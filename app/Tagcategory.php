<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagcategory extends Model
{
    public function tags()
    {
    	return $this->hasMany(Tag::class);
    }
}
