<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_blog';
    protected $fillable = [
        'id',
        'title',
        'content',
        'create_by',
        'featured_image',
        'published_at'
    ];

    public function author()
    {
        return $this->belongsTo(UserModel::class, 'create_by');
    }

    public function comments()
    {
        return $this->hasMany(BlogCommentModel::class, 'blog_id');
    }
}
