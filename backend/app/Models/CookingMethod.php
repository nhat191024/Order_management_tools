<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookingMethod extends Model
{
    protected $table = 'cooking_methods';

    protected $fillable = [
        'name',
        'status',
        'note'
    ];

    public function dish()
    {
        return $this->hasMany(Dish::class);
    }

    public function kitchen()
    {
        return $this->hasMany(Kitchen_cooking_method::class);
    }
}
