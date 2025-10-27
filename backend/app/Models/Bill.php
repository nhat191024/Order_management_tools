<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $table_id
 * @property int $branch_id
 * @property int|null $user_id
 * @property string $time_in
 * @property string|null $time_out
 * @property int $input_discount_amount
 * @property string $payment_method
 * @property int $total
 * @property int $pay_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillDetail> $billDetail
 * @property-read int|null $bill_detail_count
 * @property-read \App\Models\Table $table
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereInputDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTimeIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTimeOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUserId($value)
 * @mixin \Eloquent
 */
class Bill extends Model
{
    protected $fillable = [
        'table_id',
        'branch_id',
        'user_id',
        'time_in',
        'time_out',
        'total',
        'pay_status',
        'input_discount_amount',
        'payment_method'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billDetail()
    {
        return $this->hasMany(BillDetail::class);
    }
}
