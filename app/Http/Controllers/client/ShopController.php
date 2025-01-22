<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        return view('client.shop.index');
    }

    public function single_product($id){
        return view('client.single_product.index',['product_id'=>$id]);
    }
}
