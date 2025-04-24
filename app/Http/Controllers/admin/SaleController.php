<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleModel;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
{
    public function index(){
        return view('admin.sale.index');
    }

    public function list(Request $request){
        try {
            if ($request->ajax()) {
                $list = SaleModel::with(['user','paymentMethod'])->get();
                return DataTables::of($list)->make(true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
