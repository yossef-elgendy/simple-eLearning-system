<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'courses';
    protected $fillable = [
        'name','specification_id','user_id','duration','content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specification()
    {
        return $this->belongsTo(Specification::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('id','feedBack')
            ->withTimestamps();
    }

}
