<?php

namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\Relation;

class ContractTPC extends Model
{
    protected $table = 'contract_tpc';
    protected $fillable = [
        'id',
        'contract_duration',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function employment(): MorphOne
    {
        Relation::morphMap([
            'permanent' => PermanentTPC::class,
            'contract' => ContractTPC::class,
        ]);
        return $this->morphOne(EmployeeTPC::class, 'employment', 'type', 'id', 'id');
    }
}
