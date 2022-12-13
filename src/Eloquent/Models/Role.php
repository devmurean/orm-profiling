<?php

namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
}
