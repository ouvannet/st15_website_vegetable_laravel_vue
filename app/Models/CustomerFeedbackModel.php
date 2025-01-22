<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedbackModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_customer_feedback';
    protected $fillable = [
        'user_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
