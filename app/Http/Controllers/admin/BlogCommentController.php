<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index(){
        return view('admin.blog_comment.index');
    }
}
