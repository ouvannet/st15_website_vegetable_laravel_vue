<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleModel;

class ProfileController extends Controller
{
    public function index(){
        return view('client.profile.index');
    }

    public function list(Request $request){
        try {
                $list = SaleModel::with(['user','paymentMethod','saleItems'])->get();
                return $list;
        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
