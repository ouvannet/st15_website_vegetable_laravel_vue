<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerFeedbackModel;
use App\Models\LogoClientModel;

class GeneralController extends Controller
{
    public function list_customer_feedback(){
        try {
            $list=CustomerFeedbackModel::with(['user.role'])->get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function list_logo_client(){
        try {
            $list=LogoClientModel::get();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
