<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function branches()
    {
        return $this->belongsToMany(BranchProduct::class, 'branch_product');
    }
}
