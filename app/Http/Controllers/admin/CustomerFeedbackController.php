<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerFeedbackModel;
use Yajra\DataTables\DataTables;

class CustomerFeedbackController extends Controller
{
    public function index(){
        return view('admin.customer_feedback.index');
    }
    public function list(Request $request){
        try {
            // $list=CustomerFeedbackModel::with(['user'])->get();
            // return $list;
            if ($request->ajax()) {
                $list = CustomerFeedbackModel::with(['user'])->get();
                return DataTables::of($list)->make(true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            $ins=CustomerFeedbackModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=CustomerFeedbackModel::where('id',$all['customer_feedback_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            $upd=CustomerFeedbackModel::where('id',$all['customer_feedback_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
