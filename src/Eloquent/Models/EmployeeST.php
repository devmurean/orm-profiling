<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeST extends Model
{
    protected $table = 'st_employee';
    protected $fillable = [
        'name',
        'address',
        'nik',
        'contract_duration',
    ];
    public $timestamps = false;
}
