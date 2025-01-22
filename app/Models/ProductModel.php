<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_products';
    protected $fillable = [
        'id',
        'name',
        'description',
        'category_id',
        'brand_id',
        'base_unit_id',
        'base_price',
        'stock_quantity',
        'image_url',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(BrandModel::class, 'brand_id');
    }

    public function baseUnit()
    {
        return $this->belongsTo(UnitModel::class, 'base_unit_id');
    }

    public function variants()
    {
        return $this->hasMany(VariantModel::class, 'product_id');
    }

    public function wishlist()
    {
        return $this->hasMany(WishlistModel::class, 'product_id');
    }
}
