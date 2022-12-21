<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\Relation;

class PermanentTPC extends Model
{
    protected $table = 'permanent_tpc';
    protected $fillable = [
        'id',
        'nik',
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
