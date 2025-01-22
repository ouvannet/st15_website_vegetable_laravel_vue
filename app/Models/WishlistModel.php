<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_wishlist';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
