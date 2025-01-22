<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogCommentModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_blog_comment';

    public function blog()
    {
        return $this->belongsTo(BlogModel::class, 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
