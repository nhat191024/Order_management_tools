<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'branch_id',
        'username',
        'password',
        'role',
        'status',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function bill()
    {
        return $this->hasMany(Bill::class);
    }
}
