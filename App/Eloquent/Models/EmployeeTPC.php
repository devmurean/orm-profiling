<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;

class EmployeeTPC extends Model
{
    protected $table = 'employee_tpc';
    protected $fillable = [
        'name',
        'address',
        'type'
    ];
    public $timestamps = false;

    public function employment(): MorphTo
    {
        Relation::morphMap([
            'permanent' => PermanentTPC::class,
            'contract' => ContractTPC::class,
        ]);
        return $this->morphTo('employment', 'type', 'id', 'id');
    }
}
