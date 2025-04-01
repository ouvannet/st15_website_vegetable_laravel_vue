<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandModel;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    public function index(){
        return view('admin.brand.index');
    }
    public function list(Request $request){
        try {
            // $list=BrandModel::get();
            // return $list;
            if ($request->ajax()) {
                $list = BrandModel::get();
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
                $logo->move(public_path('admin/uploads/brand'), $logoname);
                $all['logo_url']=('admin/uploads/brand/' . $logoname);
            }
            unset($all['logo']);
            $ins=BrandModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=BrandModel::where('id',$all['brand_id'])->delete();
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
                $logo->move(public_path('admin/uploads/brand'), $logoname);
                $data['logo_url']=('admin/uploads/brand/' . $logoname);
                if(isset($all['old_logo'])){
                    unlink(public_path($all['old_logo']));
                }
            }
            unset($data['logo']);
            $upd=BrandModel::where('id',$all['brand_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
