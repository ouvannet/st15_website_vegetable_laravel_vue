<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_sale';
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method_id',
        'shipping_address'
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethodModel::class, 'payment_method_id');
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItemModel::class, 'sale_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentModel::class, 'sale_id');
    }
}
