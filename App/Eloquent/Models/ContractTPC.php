<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ContractTPC extends Model
{
    protected $table = 'eloquent_contract_tpc';
    protected $fillable = [
        'employee_tpc_id',
        'contract_duration',
    ];
    public $timestamps = false;
    protected $primaryKey = 'employee_tpc_id';
    public $incrementing = false;

    public function employment(): MorphOne
    {
        return $this->morphOne(EmployeeTPC::class, 'employment', 'type', 'id', 'employee_tpc_id');
    }
}