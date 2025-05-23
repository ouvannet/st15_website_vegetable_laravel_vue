<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitModel;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    public function index(){
        return view('admin.unit.index');
    }
    public function list_data(Request $request){
        try {
            $list=UnitModel::get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function list(Request $request){
        try {
            // $list=UnitModel::get();
            // return $list;
            if ($request->ajax()) {
                $list = UnitModel::get();
                return DataTables::of($list)->make(true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            $ins=UnitModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=UnitModel::where('id',$all['unit_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            $upd=UnitModel::where('id',$all['unit_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
