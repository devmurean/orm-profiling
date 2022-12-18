<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class ContractTPCC extends Model
{
    protected $table = 'contract_tpcc';
    protected $fillable = [
        'name',
        'address',
        'contract_duration'
    ];
    public $timestamps = false;
}
