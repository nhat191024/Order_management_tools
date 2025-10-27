<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $bill_id
 * @property int $dish_id
 * @property int $quantity
 * @property int $price
 * @property string|null $note
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bill $bill
 * @property-read \App\Models\Dish $dish
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail whereBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail whereDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BillDetail extends Model
{
    protected $table = 'bill_details';

    protected $fillable = [
        'bill_id',
        'dish_id',
        'quantity',
        'price',
        'status',
        'note',
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
