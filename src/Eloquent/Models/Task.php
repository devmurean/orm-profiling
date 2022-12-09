<?php

namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';
    protected $fillable = [
        'description', 'user_id'
    ];
    public $timestamps = false;
}
