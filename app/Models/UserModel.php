<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\RoleModel;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'gender',
        'phone',
        'address',
        'role_id',
        'image_url'
    ];
    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }

    public function customerFeedback()
    {
        return $this->hasMany(CustomerFeedbackModel::class, 'user_id');
    }

    public function blogs()
    {
        return $this->hasMany(BlogModel::class, 'create_by');
    }

    public function blogComments()
    {
        return $this->hasMany(BlogCommentModel::class, 'user_id');
    }

    public function wishlist()
    {
        return $this->hasMany(WishlistModel::class, 'user_id');
    }

    public function cart()
    {
        return $this->hasMany(CartModel::class, 'user_id');
    }

    public function sales()
    {
        return $this->hasMany(SaleModel::class, 'user_id');
    }

    public function hasPermission($permissionName)
    {
        return $this->role->permissions->contains('name', $permissionName);
    }
}
