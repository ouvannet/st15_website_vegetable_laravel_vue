<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }
    public function list(){
        try {
            $list=CategoryModel::get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            if(isset($all['image'])){
                $image=$all['image'][0];
                $imagename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('admin/uploads/category'), $imagename);
                $all['image_url']=('admin/uploads/category/' . $imagename);
            }
            unset($all['image']);
            $ins=CategoryModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=CategoryModel::where('id',$all['category_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            if(isset($data['image'])){
                $image=$data['image'][0];
                $imagename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('admin/uploads/category'), $imagename);
                $data['image_url']=('admin/uploads/category/' . $imagename);
                if(isset($all['old_image'])){
                    unlink(public_path($all['old_image']));
                }
            }
            unset($data['image']);
            $upd=CategoryModel::where('id',$all['category_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
