<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dish extends Model
{
    protected $table = 'dishes';

    protected $fillable = [
        'category_id',
        'food_id',
        'id_cooking_method',
        'price',
        'additional_price',
        'image'
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
