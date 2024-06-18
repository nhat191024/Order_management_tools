<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';

    protected $fillable = [
        'table_number',
        'status',
        'note',
        'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
}
