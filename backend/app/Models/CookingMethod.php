<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string|null $note
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dish
 * @property-read int|null $dish_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\KitchenCookingMethod> $kitchen
 * @property-read int|null $kitchen_count
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CookingMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        return $this->hasMany(KitchenCookingMethod::class);
    }
}
