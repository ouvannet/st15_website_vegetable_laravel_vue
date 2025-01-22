<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethodModel;

class CheckoutController extends Controller
{
    public function index(){
        return view('client.checkout.index');
    }
    public function list(){
        try {
            $list=PaymentMethodModel::get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

}
