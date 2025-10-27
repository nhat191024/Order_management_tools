<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $branch_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Branch $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\KitchenCookingMethod> $cookingMethod
 * @property-read int|null $cooking_method_count
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitchen whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kitchen extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function cookingMethod()
    {
        return $this->hasMany(KitchenCookingMethod::class);
    }
}