<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTPCC extends Model
{
    protected $table = 'tpcc_employee';
    protected $fillable = [
        'name',
        'address',
    ];
    public $timestamps = false;
}
