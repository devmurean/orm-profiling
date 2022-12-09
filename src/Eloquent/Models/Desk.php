<?php

namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Desk extends Model
{
    protected $table = 'desk';
    protected $fillable = [
        'location', 'user_id'
    ];
    public $timestamps = false;
}
