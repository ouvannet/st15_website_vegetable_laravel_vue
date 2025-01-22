<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_contact';
    protected $fillable = [
        'address',
        'phone',
        'email',
        'website',
        'map_url',
    ];
}
