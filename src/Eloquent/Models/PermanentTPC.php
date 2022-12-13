<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class PermanentTPC extends Model
{
    protected $table = 'permanent_tpc';
    protected $fillable = [
        'tpc_employee_id',
        'nik',
    ];
    public $timestamps = false;
}
