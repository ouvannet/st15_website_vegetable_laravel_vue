<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_varient';
    protected $fillable = [
        'product_id',
        'unit_id',
        'price',
        'quantity_in_base_unit',
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    public function unit()
    {
        return $this->belongsTo(UnitModel::class, 'unit_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartModel::class, 'varient_id');
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItemModel::class, 'varient_id');
    }
}
