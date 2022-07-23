<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specification extends Model
{

    protected $fillable = ['name'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
