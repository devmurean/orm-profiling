<?php

namespace App\Eloquent\Models;

use Doctrine\ORM\Mapping\ManyToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    public $timestamps = false;

    public function desk(): HasOne
    {
        return $this->hasOne(Desk::class, 'user_id');
    }

    public function task(): HasMany
    {
        return $this->hasMany(Task::class, 'user_id');
    }

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}
