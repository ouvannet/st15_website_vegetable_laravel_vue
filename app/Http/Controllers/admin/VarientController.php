<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VariantModel;
use Yajra\DataTables\DataTables;

class VarientController extends Controller
{
    public function index(){
        return view('admin.varient.index');
    }
    public function list(Request $request){
        try {
            // $list=VariantModel::with(['product','unit'])->get();
            // return $list;
            if ($request->ajax()) {
                $list = VariantModel::with(['product','unit'])->get();
                return DataTables::of($list)->make(true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            $ins=VariantModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=VariantModel::where('id',$all['varient_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            $upd=VariantModel::where('id',$all['varient_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
