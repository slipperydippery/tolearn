<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }

    public function resources()
    {
    	return $this->hasMany(Resource::class);
    }

    public function hints()
    {
    	return $this->hasMany(Hint::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function scorecards()
    {
        return $this->hasMany(Scorecard::class);
    }

    public function followup()
    {
        return $this->hasOne(Question::class);
    }

    public function parent()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
