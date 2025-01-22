<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_brand';
    protected $fillable = [
        'name',
        'description',
        'logo_url',
    ];

    public function products()
    {
        return $this->hasMany(ProductModel::class, 'brand_id');
    }
}
