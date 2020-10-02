<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    protected $table = 'fruits';

    protected $fillable = [
        'name',
        'size',
        'colour'
    ];
}
