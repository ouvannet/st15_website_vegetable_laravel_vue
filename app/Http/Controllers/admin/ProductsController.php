<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Yajra\DataTables\DataTables;

class ProductsController extends Controller
{
    public function index(){
        return view('admin.products.index');
    }
    public function list_data(){
        try {
            $list=ProductModel::with(['category', 'brand','baseUnit'])->get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $products = ProductModel::with(['category', 'brand', 'baseUnit'])->get();
            return DataTables::of($products)->make(true);
        }
        return view('admin.products.index');
    }
    public function submit_add(Request $req){
        try {
            $all=$req->all();
            if(isset($all['image_url'])){
                $image_url=$all['image_url'][0];
                $imageName = time() . '_' . $image_url->getClientOriginalName();
                $image_url->move(public_path('admin/uploads/product'), $imageName);
                $all['image_url']=('admin/uploads/product/' . $imageName);
            }
            $ins=ProductModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete(Request $req){
        try {
            $all=$req->all();
            $del=ProductModel::where('id',$all['product_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit(Request $req){
        try {
            $all=$req->all();
            $data=$all['data'];
            if(isset($data['image_url'])){
                $image_url=$data['image_url'][0];
                $ImageName = time() . '_' . $image_url->getClientOriginalName();
                $image_url->move(public_path('uploads/product'), $ImageName);
                $data['image_url']=('uploads/product/' . $ImageName);
                if(isset($all['old_image_url'])){
                    unlink(public_path($all['old_image_url']));
                }
            }
            $upd=ProductModel::where('id',$all['product_id'])->update($data);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

}
