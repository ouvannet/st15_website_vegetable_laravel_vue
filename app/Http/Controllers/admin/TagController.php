<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TagModel;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{
    public function index(){
        return view('admin.tag.index');
    }
    public function list(Request $request){
        try {
            // $list=TagModel::get();
            // return $list;
            if ($request->ajax()) {
                $list = TagModel::get();
                return DataTables::of($list)->make(true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            $ins=TagModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=TagModel::where('id',$all['tag_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            $upd=TagModel::where('id',$all['tag_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
