<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\RoleModel;

class UserAuth extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'email',
        'password',
    ];
    // protected $hidden = [
    //     'password',
    // ];

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id', 'id');
    }
    public function hasPermission()
    {
        return $this->role->permissions->pluck('name')->toArray();
    }
}
