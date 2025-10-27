<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Ramsey\Uuid\Uuid;

/**
 * @property string $id
 * @property string $table_number
 * @property string|null $note
 * @property int $status
 * @property int $is_deleted
 * @property int $branch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bill|null $bill
 * @property-read \App\Models\Branch $branch
 * @method static \Illuminate\Database\Eloquent\Builder|Table newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Table newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Table query()
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereTableNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Table extends Model
{
    protected $table = 'tables';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'table_number',
        'status',
        'note',
        'branch_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
}
