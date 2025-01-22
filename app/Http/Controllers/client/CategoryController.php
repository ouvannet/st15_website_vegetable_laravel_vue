<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function list(){
        try {
            $list=CategoryModel::get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
