<?php
namespace App\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class UserIsolationPropagation extends Model
{
    public $table = 'user_isolation_propagations';
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'email'
    ];
    public $timestamps = false;
}
