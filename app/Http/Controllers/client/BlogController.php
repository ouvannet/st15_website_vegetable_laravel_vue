<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\TagModel;

class BlogController extends Controller
{
    public function index(){
        return view('client.blog.index');
    }
    public function byId(Request $req){
        try {
            $all=$req->all();
            $list=BlogModel::with(['author','comments.user'])->where('id','=',$all['blog_id'])->first();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function list(){
        try {
            $list=BlogModel::with(['author','comments'])->get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function tagCloude(){
        try {
            $list=TagModel::get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function readblog($blog_id=''){
        return view('client.blog.single_blog.index',['blog_id'=>$blog_id]);
    }
}
