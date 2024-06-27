<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'image',
        'status',
        'note'
    ];

    public function dish()
    {
        return $this->hasMany(dish::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
