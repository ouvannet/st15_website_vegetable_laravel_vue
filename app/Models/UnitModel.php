<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_unit';
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(ProductModel::class, 'base_unit_id');
    }

    public function variants()
    {
        return $this->hasMany(VariantModel::class, 'unit_id');
    }
}
