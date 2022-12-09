<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class PermanentTPC extends Model
{
    protected $table = 'tpc_permanent';
    protected $fillable = [
        'tpc_employee_id',
        'nik',
    ];
    public $timestamps = false;
}
