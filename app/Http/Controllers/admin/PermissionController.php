<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermissionModel;
use Yajra\DataTables\DataTables;


class PermissionController extends Controller
{
    public function index(){
        return view('admin.permission.index');
    }
    public function list(Request $request){
        try {
            // $list=PermissionModel::get();
            // return $list;
            if ($request->ajax()) {
                $list = PermissionModel::get();
                return DataTables::of($list)->make(true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            $ins=PermissionModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=PermissionModel::where('id',$all['permission_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            $upd=PermissionModel::where('id',$all['permission_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
