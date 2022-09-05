<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Models\contactModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function listContact() {
		$contact = contactModel::where('data_id',0)->get();
        return view('admin.modules.contact.contact', ['contact' => $contact]);
    }
	public function getDeleteContact(Request $request){
		$id = $request->id;
		DB::table('contact')->where('contact_id', $id)->delete();
		return redirect('dt-admin/contact', 301);
	}
}
