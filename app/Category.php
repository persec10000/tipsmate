<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'q_a_s';
    protected $fillable = [
        'id','category'
    ];
}
