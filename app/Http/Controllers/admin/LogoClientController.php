<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogoClientModel;
use Yajra\DataTables\DataTables;

class LogoClientController extends Controller
{
    public function index(){
        return view('admin.logo_client.index');
    }
    public function list(Request $request){
        try {
            // $list=LogoClientModel::get();
            // return $list;
            if ($request->ajax()) {
                $list = LogoClientModel::get();
                return DataTables::of($list)->make(true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            if(isset($all['logo'])){
                $logo=$all['logo'][0];
                $logoname = time() . '_' . $logo->getClientOriginalName();
                $logo->move(public_path('admin/uploads/logo_client'), $logoname);
                $all['logo_url']=('admin/uploads/logo_client/' . $logoname);
            }
            unset($all['logo']);
            $ins=LogoClientModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=LogoClientModel::where('id',$all['logo_client_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            if(isset($data['logo'])){
                $logo=$data['logo'][0];
                $logoname = time() . '_' . $logo->getClientOriginalName();
                $logo->move(public_path('admin/uploads/logo_client'), $logoname);
                $data['logo_url']=('admin/uploads/logo_client/' . $logoname);
                if(isset($all['old_logo'])){
                    unlink(public_path($all['old_logo']));
                }
            }
            unset($data['logo']);
            $upd=LogoClientModel::where('id',$all['logo_client_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
