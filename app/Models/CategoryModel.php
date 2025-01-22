<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_categorys';
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'is_active',
    ];
    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category_id');
    }
}
