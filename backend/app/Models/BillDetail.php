<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class billDetail extends Model
{
    protected $table = 'bill_details';

    protected $fillable = [
        'bill_id',
        'dish_id',
        'quantity',
        'price',
        'status',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
