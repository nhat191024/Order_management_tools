<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = [
        'name',
        'image'
    ];

    public function kitchen()
    {
        return $this->hasMany(Kitchen::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function table()
    {
        return $this->hasMany(Table::class);
    }
}
