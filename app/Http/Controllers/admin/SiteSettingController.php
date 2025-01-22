<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactModel;

class SiteSettingController extends Controller
{
    public function site_contact(){
        return view('admin.site_setting.contact.index');
    }
    public function list_contact(){
        try {
            $list_contract=ContactModel::get();
            return $list_contract;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_add_site_contact(Request $req){
        try {
            $all=$req->all();
            $ins=ContactModel::create($all);
            return $ins;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_delete_contact(Request $req){
        try {
            $all=$req->all();
            $del=ContactModel::where('id',$all['contact_id'])->delete();
            return $del;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function submit_edit_contact(Request $req){
        try {
            $all=$req->all();
            $upd=ContactModel::where('id',$all['contact_id'])->update($all['data']);
            return $upd;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
