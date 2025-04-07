<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;

class RegisterController extends Controller
{
    public function index(){
        return view('client.auth.register.register');
    }

    public function submit(Request $req){
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
}
