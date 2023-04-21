<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_branch');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'branch_product');
    }
}
