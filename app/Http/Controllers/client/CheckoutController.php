<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethodModel;

class CheckoutController extends Controller
{
    public function index(){
        $client = session('client_data');

        if (!$client) {
            return redirect()->route('client.login'); // or: return redirect('/client/login');
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

}
