<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';

    protected $fillable = [
        'table_id',
        'branch_id',
        'user_id',
        'time_in',
        'time_out',
        'total',
        'pay_status',
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
