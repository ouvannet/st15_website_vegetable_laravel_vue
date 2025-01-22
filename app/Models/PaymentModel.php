<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_payment';

    public function sale()
    {
        return $this->belongsTo(SaleModel::class, 'sale_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethodModel::class, 'payment_method_id');
    }
}
