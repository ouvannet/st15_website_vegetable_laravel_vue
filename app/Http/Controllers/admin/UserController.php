<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UserModel;


class UserController extends Controller
{

    public function index(){

        return view('admin.user.index');
    }
    public function list(){
        try {
            $list=UserModel::with('role')->get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            if(isset($all['password'])){
                $all['password']=bcrypt($all['password']);
            }
            if(isset($all['image_url'])){
                $image_url=$all['image_url'][0];
                $imageName = time() . '_' . $image_url->getClientOriginalName();
                $image_url->move(public_path('admin/uploads/user'), $imageName);
                $all['image_url']=('admin/uploads/user/' . $imageName);
            }
            $ins=UserModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=UserModel::where('id',$all['user_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            if(isset($data['password'])){
                $data['password']=bcrypt($data['password']);
            }
            if(isset($data['image_url'])){
                $image_url=$data['image_url'][0];
                $imageName = time() . '_' . $image_url->getClientOriginalName();
                $image_url->move(public_path('admin/uploads/user'), $imageName);
                $data['image_url']=('admin/uploads/user/' . $imageName);
                if(isset($all['old_image_url'])){
                    unlink(public_path($all['old_image_url']));
                }
            }
            $upd=UserModel::where('id',$all['user_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }




}

