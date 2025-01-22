<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_payment_method';
    protected $fillable = [
        'name'
    ];

    public function sales()
    {
        return $this->hasMany(SaleModel::class, 'payment_method_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentModel::class, 'payment_method_id');
    }
}
