<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property int $price
 * @property string $image
 * @property int $status
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dish
 * @property-read int|null $dish_count
 * @method static \Illuminate\Database\Eloquent\Builder|Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food query()
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        return $this->hasMany(Dish::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
