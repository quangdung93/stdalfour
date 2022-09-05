<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Constants\ConfigApp;
use App\Http\Models\orderModel;
use App\Http\Models\productModel;
use Session;
use DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
	public function getList(Request $request){
		$keysearch = $request->keysearch ? $request->keysearch : '';
		$keysearchpro = $request->keysearchpro ? $request->keysearchpro : '';
		$trangthai = $request->trangthai ? $request->trangthai : 0;
		$order = orderModel::where('ID','!=',0);
		if(!empty($keysearchpro)){
			$keysearchpro = str_replace('+', ' ', $keysearchpro);
			$checklist = DB::table('order_detail');
			$checklist->where('NAME', 'LIKE', '%'.$keysearchpro.'%');
			$checklist->orderBy('ID','DESC');
			$checklist = $checklist->get();
			$proListClone = [];
			foreach ($checklist as $key => $item) {
				array_push($proListClone, $item->ORDERID);
			}
			if($proListClone){
				$order->whereIn('ID', $proListClone);
			}
		}
		if(!empty($keysearch)){
			$keysearch = str_replace('+', ' ', $keysearch);
			$order->where(function ($query) use ($keysearch) {
				$query->where('BUYER', 'LIKE', '%'.$keysearch.'%')
					->orWhere('EMAIL', 'LIKE', '%'.$keysearch.'%')
					->orWhere('PHONE', 'LIKE', '%'.$keysearch.'%');
			});
		}
		if($trangthai != 0){
			$order->where('order_status_id', $trangthai);
		}
		$order->orderBy('ID','DESC');
		$order = $order->paginate(20);
		$total = $order->total();
		return view('admin.modules.order.list',['order'=>$order, 'total'=>$total, 'trangthai' => $trangthai, 'keysearch' => $keysearch, 'keysearchpro' => $keysearchpro]);
	}
	public function getAddOrder(){
		return view('admin.modules.order.add');
	}
	public function postAddOrder(Request $request){
		$this->validate($request, [
			'order_buyer'  => 'required'
		]);
		$insert_data[] = array(
			'BUYER'  => $request->order_buyer,
			'EMAIL' => $request->order_email,
			'ADDRESS' => $request->order_address,
			'province_id' => $request->province_id,
			'district_id'  => $request->district_id,
			'PHONE'  => $request->order_phone,
			'PAYMENTTERMS'  => $request->order_pay,
			'shipping_method'  => $request->order_method,
			'NOTE'  => $request->order_note ? $request->order_note : '',
			'DATECREATE' => date('Y-m-d H:i'),
			'IP_ADDRESS' => getIp() ? getIp() : '127.0.0.1'
		);
		if(!empty($insert_data)){
			DB::table('order')->insert($insert_data);
			$order_id = DB::getPdo()->lastInsertId();
			if($order_id){
				//Danh muc san pham
				$newPro = $request->pro_list ? $request->pro_list : [];
				if($newPro){
					$insert_data_pro = array();
					foreach($newPro as $idpro){
						$product = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('ID',$idpro)->first();
						if($product){
							DB::table('order_detail')->insert([
								'ORDERID' => $order_id,
								'PRODUCTID' => $idpro,
								'NAME' => $product->NAME,
								'QUANTITY' => 1,
								'PRICE' => $product->PRICE,
								'DISCOUNT' => $product->DISCOUNT
							]);
						}
					}
				}
				return redirect('dt-admin/order/sua/'.$order_id, 301)->with('success', 'Bạn đã thêm đơn hàng thành công');
			}
		}
	}
	public function getEditOrder(Request $request){
		$id = $request->id;
		$order = orderModel::where('ID',$id)->first();
		return view('admin.modules.order.edit', ['order' => $order]);
	}
	public function postEditOrder (Request $request){
		$this->validate($request, [
			'order_buyer'  => 'required'
		]);
		$id = $request->route('id');
		$order = orderModel::find($id);
		$order->BUYER = $request->order_buyer;
		$order->EMAIL = $request->order_email;
		$order->ADDRESS = $request->order_address;
		$order->province_id = $request->province_id;
		$order->district_id = $request->district_id;
		$order->PHONE = $request->order_phone;
		$order->PAYMENTTERMS = $request->order_pay;
		$order->shipping_method = $request->order_method;
		$order->NOTE = $request->order_note ? $request->order_note : '';
		$order->save();
		return redirect('dt-admin/order', 301)->with('sucsses', 'Bạn đã cập nhật đơn hàng thành công');
	}
	public function getDeleteServices(Request $request){
		$id = $request->id;
		DB::table('services')->where('services_id', $id)->delete();
		return redirect('dt-admin/services', 301)->with('sucsses', 'Bạn đã xóa services thành công');
	}
	public function addOrderPro(Request $request){
		$id = $request->idorder;
		$idpro = $request->idpro;
		$quantity = $request->quantity;
		$response = [
            'err' => 1,
            'msg' => ''
        ];
		if($id){
			$checkevent = DB::table('order_detail')->where('ORDERID',$id)->where('PRODUCTID',$idpro)->first();
			if($checkevent){
				DB::table('order_detail')->where('ID',$checkevent->ID)->update(['QUANTITY' => $quantity]);
			}else{
				$product = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('ID',$idpro)->first();
				if($product){
					DB::table('order_detail')->insert([
						'ORDERID' => $id,
						'PRODUCTID' => $idpro,
						'NAME' => $product->NAME,
						'QUANTITY' => $quantity,
						'PRICE' => $product->PRICE,
						'DISCOUNT' => $product->DISCOUNT
					]);
				}
			}
			$response = [
				'err' => 0,
				'msg' => ''
			];
		}
		echo json_encode($response);
        return;
	}
	public function delProOrder(Request $request){
		$response = [
            'err' => 1,
            'msg' => ''
        ];
		$id = $request->idorder;
		if($id){
			DB::table('order_detail')->where('ID', $id)->delete();
			$response = [
				'err' => 0,
				'msg' => ''
			];
		}
		echo json_encode($response);
        return;
	}
	public function addNoteOrderPro(Request $request){
		$id = $request->idorder;
		$idtinhtrang = $request->idtinhtrang;
		$note = $request->note ? $request->note : '';
		$response = [
            'err' => 1,
            'msg' => ''
        ];
		if($id){
			DB::table('order')->where('ID',$id)->update(['order_status_id' => $idtinhtrang]);
			DB::table('order_history')->insert([
				'order_id' => $id,
				'order_status_id' => $idtinhtrang,
				'comment' => $note,
				'date_added' => date('Y-m-d H:i')
			]);
			$response = [
				'err' => 0,
				'msg' => ''
			];
		}
		echo json_encode($response);
        return;
	}
	public function getDeleteOrder(Request $request){
		$id = $request->id;
		DB::table('order_detail')->where('ID', $id)->delete();
		DB::table('order')->where('ID', $id)->delete();
		return back()->with('success', 'Bạn đã xóa đơn hàng thành công');
	}
	public function deleteAll(Request $request){
		$ids = $request->ids;
		$listOrId = explode(",", $ids);
        foreach ($listOrId as $orId) {
			if ($orId) {
				DB::table('order_detail')->where('ID', $orId)->delete();
				DB::table('order')->where('ID', $orId)->delete();
            }
		}
		return response()->json(['success' => 'Đã xóa thành công']);
	}
	public function districtCart(Request $request){
		$id = $request->id;
		$html = '';
		if($id){
			$getquan = DB::table('district')->where('provinceid',$id)->orderBy('name','ASC')->get();
			if($getquan){
				foreach($getquan as $quan){
					$html .= '<option value="'.$quan->districtid.'">'.$quan->type.' '.$quan->name.'</option>';
				}
			}
		}
		return $html;
	}
}