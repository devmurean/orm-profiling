<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EmployeeTPC extends Model
{
    protected $table = 'employee_tpc';
    protected $fillable = [
        'name',
        'address',
        'type'
    ];
    public $timestamps = false;

    public function employment(): HasOne
    {
        return $this->type === PermanentTPC::class
            ? $this->hasOne(PermanentTPC::class, 'tpc_employee_id')
            : $this->hasOne(ContractTPC::class, 'tpc_employee_id');
    }
}
