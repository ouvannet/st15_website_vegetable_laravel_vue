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

    public function updatestatus(Request $req){
        // dd($req);
        $sale = SaleModel::findOrFail($req->id);
        $sale->order_status = $req->status;
        $sale->save();

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'data' => $sale
        ]);
    }

    public function updatepaymentstatus(Request $req){
        // dd($req);
        $sale = SaleModel::findOrFail($req->id);
        $sale->payment_status = $req->payment_status;
        $sale->save();

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'data' => $sale
        ]);
    }
}
