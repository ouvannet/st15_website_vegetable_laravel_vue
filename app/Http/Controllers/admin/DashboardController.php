<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;

use App\Models\User;


class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard.index');
    }

    public function bestseller(){
        try {
            $list=ProductModel::with(['category', 'brand','baseUnit'])->limit(5)->get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
