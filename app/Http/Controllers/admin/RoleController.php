<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;


class RoleController extends Controller
{
    public function index(){
        return view('admin.role.index');
    }
    public function list(){
        try {
            $list=RoleModel::get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            $ins=RoleModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=RoleModel::where('id',$all['role_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            $upd=RoleModel::where('id',$all['role_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }




    public function permission_role(Request $req){
        $all=$req->all();
        $role_id=$all['role_id'];
        $permission=PermissionModel::with(['roles' => function ($query) use ($role_id) {
            $query->where('id', $role_id);
        }])
        ->get();
        return $permission;
    }
    public function submit_set_permission_role(Request $req){
        $all=$req->all();
        $del_role_permission=PermissionRoleModel::find($all['role_id']);
        if($del_role_permission){
            $del_role_permission->delete();
        }
        $role_permission_data=[];
        foreach ($all['permission_id'] as $p_id) {
            $role_permission_data[]=[
                'role_id'=>$all['role_id'],
                'permission_id'=>$p_id
            ];
        }
        $ins=PermissionRoleModel::insert($role_permission_data);
        if ($ins) {
            $message=['status'=>1,'message'=>'Set Permission To Role Success'];
        }else{
            $message=['status'=>0,'message'=>'Set Permission To Role Failed'];
        }
        return ($message);

    }
}
