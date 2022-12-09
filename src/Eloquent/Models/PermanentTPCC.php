<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class PermanentTPCC extends Model
{
    protected $table = 'tpcc_permanent';
    protected $fillable = [
        'name',
        'address',
        'nik'
    ];
    public $timestamps = false;
}
