<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoClientModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_logo_client';
    protected $fillable = [
        'name',
        'logo_url',
        'website_url',
    ];
}
