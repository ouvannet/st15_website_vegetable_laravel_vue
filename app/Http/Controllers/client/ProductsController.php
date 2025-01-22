<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductsController extends Controller
{
    public function list(){
        try {
            $list=ProductModel::limit(8)->get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function byId(Request $req){
        $all=$req->all();
        try {
            $list=ProductModel::with(['variants.unit'])->where('id','=',$all['product_id'])->first();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function byCategory(Request $req){
        $all=$req->all();
        try {
            $list=ProductModel::where('category_id','=',$all['category_id'])->limit(4)->get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function dataTable(Request $request){
        $all=$request->all();

        if($all['category']>0){
            $data = ProductModel::where('category_id',$all['category'])->paginate(8);
        }else{
            $data = ProductModel::paginate(8);
        }
        return response()->json($data);
    }
}
