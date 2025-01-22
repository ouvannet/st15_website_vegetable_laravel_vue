<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogModel;

class BlogController extends Controller
{
    public function index(){
        return view('admin.blog.index');
    }
    public function list(){
        try {
            $list=BlogModel::with(['author'])->get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            $user=$_SESSION["user_data"];
            if(isset($user['id'])){
                $all['create_by']=$user['id'];
            }
            $all['published_at']=date('Y-m-d H:i:s');
            if(isset($all['featured_image'])){
                $featured_image=$all['featured_image'][0];
                $imageName = time() . '_' . $featured_image->getClientOriginalName();
                $featured_image->move(public_path('admin/uploads/blog'), $imageName);
                $all['featured_image']=('admin/uploads/blog/' . $imageName);
            }
            $ins=BlogModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=BlogModel::where('id',$all['blog_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            if(isset($data['featured_image'])){
                $featured_image=$data['featured_image'][0];
                $logoname = time() . '_' . $featured_image->getClientOriginalName();
                $featured_image->move(public_path('admin/uploads/blog'), $logoname);
                $data['featured_image']=('admin/uploads/blog/' . $logoname);
                if(isset($all['old_featured_image'])){
                    unlink(public_path($all['old_featured_image']));
                }
            }
            $upd=BlogModel::where('id',$all['blog_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
