<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishes';

    protected $fillable = [
        'category_id',
        'food_id',
        'cooking_method_id',
        'additional_price',
        'note'
    ];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function CookingMethod()
    {
        return $this->belongsTo(CookingMethod::class);
    }

    public function billDetail()
    {
        return $this->hasMany(BillDetail::class);
    }
}
