<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    public function index(){
        return view('client.contact.index');
    }
    public function list(){
        try {
            $list=ContactModel::first();
            return $list;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
