<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class ContractTPC extends Model
{
    protected $table = 'tpc_contract';
    protected $fillable = [
        'tpc_employee_id',
        'contract_duration',
    ];
    public $timestamps = false;
}
