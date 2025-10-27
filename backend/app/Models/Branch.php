<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kitchen> $kitchen
 * @property-read int|null $kitchen_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Table> $table
 * @property-read int|null $table_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = [
        'name',
        'image'
    ];

    public function kitchen()
    {
        return $this->hasMany(Kitchen::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function table()
    {
        return $this->hasMany(Table::class);
    }
}
