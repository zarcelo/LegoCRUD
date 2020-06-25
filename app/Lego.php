<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lego extends Model
{
    protected $fillable =
    [
        'name',
        'description',
        'type',
        'url'
    ];
}
