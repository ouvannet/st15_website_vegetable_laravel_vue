<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethodModel;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{
    public function index(){
        return view('admin.payment_method.index');
    }
    public function list(Request $request){
        try {
            // $list=PaymentMethodModel::get();
            // return $list;
            if ($request->ajax()) {
                $list = PaymentMethodModel::get();
                return DataTables::of($list)->make(true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }

    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            $ins=PaymentMethodModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=PaymentMethodModel::where('id',$all['payment_method_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            $upd=PaymentMethodModel::where('id',$all['payment_method_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
