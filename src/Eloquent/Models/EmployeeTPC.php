<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EmployeeTPC extends Model
{
    protected $table = 'eloquent_employee_tpc';
    protected $fillable = [
        'name',
        'address',
        'type'
    ];
    public $timestamps = false;

    public function employment(): MorphTo
    {
        return $this->morphTo('employment', 'type', 'id', 'employee_tpc_id');
    }
}
