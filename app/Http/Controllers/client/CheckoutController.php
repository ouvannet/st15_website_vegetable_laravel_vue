<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethodModel;
use App\Models\SaleModel;
use App\Models\SaleItemModel;

class CheckoutController extends Controller
{
    public function index(){
        $client = session('client_data');

        if (!$client) {
            return redirect('/client/login');
        }

        return view('client.checkout.index', compact('client'));
    }
    public function list(){
        try {
            $list=PaymentMethodModel::get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submitCheckOut(Request $req){
        try {
            $all=$req->all();
            // dd($all);
            $ins=SaleModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submitCheckOutItems(Request $req){
        try {
            $all=$req->all();
            // dd($all);
            $ins=SaleItemModel::insert($all);
            return response()->json(['success' => true, 'inserted' => $ins], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }

}
