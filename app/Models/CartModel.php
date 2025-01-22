<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_cart';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function variant()
    {
        return $this->belongsTo(VariantModel::class, 'varient_id');
    }
}
