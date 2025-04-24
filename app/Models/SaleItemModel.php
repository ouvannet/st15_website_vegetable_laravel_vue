<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItemModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_sale_items';
    protected $fillable = [
        'sale_id',
        'varient_id',
        'quantity',
        'price_per_unit',
        'total_price'
    ];

    public function sale()
    {
        return $this->belongsTo(SaleModel::class, 'sale_id');
    }

    public function variant()
    {
        return $this->belongsTo(VariantModel::class, 'varient_id');
    }
}
