<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $food_id
 * @property int $cooking_method_id
 * @property int $additional_price
 * @property int $status
 * @property string $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillDetail> $billDetail
 * @property-read int|null $bill_detail_count
 * @property-read \App\Models\CookingMethod $cookingMethod
 * @property-read \App\Models\Food $food
 * @method static \Illuminate\Database\Eloquent\Builder|Dish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereAdditionalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereCookingMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function cookingMethod()
    {
        return $this->belongsTo(CookingMethod::class);
    }

    public function billDetail()
    {
        return $this->hasMany(BillDetail::class);
    }
}
