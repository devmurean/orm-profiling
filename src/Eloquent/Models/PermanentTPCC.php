<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class PermanentTPCC extends Model
{
    protected $table = 'permanent_tpcc';
    protected $fillable = [
        'name',
        'address',
        'nik'
    ];
    public $timestamps = false;
}
