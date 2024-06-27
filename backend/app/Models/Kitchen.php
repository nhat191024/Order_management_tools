<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;

    protected $table = 'kitchens';

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
        return $this->hasMany(Kitchen_cooking_method::class);
    }


}
