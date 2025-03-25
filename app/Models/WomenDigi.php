<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WomenDigi extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location_id'
    ];
}
