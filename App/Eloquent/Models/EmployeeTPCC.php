<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTPCC extends Model
{
    protected $table = 'employee_tpcc';
    protected $fillable = [
        'name',
        'address',
    ];
    public $timestamps = false;
}
