<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen_cooking_method extends Model
{
    protected $table = 'kitchen_cooking_method';

    protected $fillable = [
        'kitchen_id',
        'cooking_method_id'
    ];

    public function kitchen()
    {
        return $this->belongsToMany(Kitchen::class);
    }

    public function cooking_method()
    {
        return $this->belongsTo(CookingMethod::class);
    }
}
