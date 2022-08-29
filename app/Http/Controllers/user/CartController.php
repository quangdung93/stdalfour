<?php

namespace App\Http\Controllers\user;

use DB;
use Custom;
use Auth;
use SEO;
use SEOMeta;
use OpenGraph;
use Twitter;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Http\Models\productModel;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
	public function checkGiohang(){
		SEO::setTitle('Stdalfour.com.vn: Giỏ hàng');
		$sid = Session::get('session_id');
		$sid = Session::get('session_id');
		$getcart = DB::table('order_term')->where('tinhtrang',0)->where('session_id',$sid)->get();
		$blockTpl = 'user.modules.cart.check';
		return view($blockTpl, array(
			'getcart' => $getcart
		));
	}
	
	public function addCart(Request $request) {
		$response = [
            'err' => 0,
            'msg' => ''
        ];
		
		// validate input
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,ID'
        ]);

        if ($validate->fails()) {
            $response['err'] = 1;
            $response['msg'] = 'Input parameters error!!!';
            echo json_encode($response);
            return;
        }
		
		$sid = Session::get('session_id');
		$pid = $request->product_id;
		$num = $request->product_quantity;
		$num = !$num ? 1 : $num;
		
		$checkpro = DB::table('product')->select('ID','PRICE')->where('ID',$pid)->first();
		if($checkpro){
			$gia = $checkpro->PRICE;
			$checkcart = DB::table('order_term')->where('pro_id',$pid)->where('tinhtrang',0)->where('session_id',$sid)->first();
			if($checkcart){
				$sl = $checkcart->num_of + $num;
				DB::table('order_term')->where('pro_id',$pid)->where('session_id',$sid)->update(['num_of' => $sl, 'total_price' => $sl * $gia, 'product_price' => $gia]);
			}else{
				DB::table('order_term')->insert([
					'pro_id' => $pid,
					'session_id' => $sid,
					'num_of' => $num,
					'total_price' => $num * $gia,
					'product_price' => $gia
				]);
			}
		}
		$getproduct = DB::table('order_term')->where('tinhtrang',0)->where('session_id',$sid)->count();
		
		echo json_encode(array('data' => $getproduct));
        return;
	}
	public function checkoutCart(Request $request){
		$sid = Session::get('session_id');
		$fname   = $request->fname;
		$phone   = $request->phone;
		$address = $request->address;
		$note = $request->note;
		$total = $request->total;
		$response = [
            'err' => 1,
            'msg' => 'Bạn chưa mua sản phẩm nào'
        ];
		$checkOrderTerm = DB::table('order_term')->where('session_id',$sid)->first();
		if($total && !empty($checkOrderTerm)){
			$getgiohang = DB::table('order')->where('session_id',$sid)->first();
			if($getgiohang){
				$response = [
					'err' => 1,
					'msg' => 'Đơn hàng này bạn đã thanh toán'
				];
			}else{
				DB::table('order')->insert([
					'BUYER' => $fname,
					'ADDRESS' => $address,
					'PHONE' => $phone,
					'EMAIL' => '',
					'DATECREATE' => date('Y-m-d H:i'),
					'STATUS' => 1,
					'PAYMENTTERMS' => 1,
					'NOTE' => $note,
					'order_status_id' => 1,
					'cart_total' => $total,
					'session_id' => $sid,
					'IP_ADDRESS' => Custom::getIp() ? Custom::getIp() : '113.161.41.164'
				]);
				$order_id = DB::getPdo()->lastInsertId();
				if($order_id){
					$getallpro = DB::table('order_term')->join('product', 'order_term.pro_id', '=', 'product.ID')->join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('order_term.session_id',$sid)->get();
					if($getallpro){
						foreach($getallpro as $pro){
							DB::table('order_detail')->insert([
								'ORDERID' => $order_id,
								'PRODUCTID' => $pro->pro_id,
								'NAME' => $pro->NAME,
								'QUANTITY' => $pro->num_of,
								'PRICE' => $pro->product_price,
								'DISCOUNT' => 0,
								'DISCOUNT_VAL' => 0
							]);
						}
					}
				}
				DB::table('order_term')->where('session_id',$sid)->update(['tinhtrang' => 1]);
				Session::forget('session_id');
				Session::forget('session_ma_id');
				$response = [
					'err' => 0,
					'sid' => $sid,
					'msg' => 'Bạn đã mua hàng thành công. Nhân viên sẽ gọi hỗ trợ bạn trong thời gian sớm nhất'
				];
			}
		}
		echo json_encode($response);
		return;
	}
	public function cartReturn(Request $request){
		SEO::setTitle('Stdalfour.com.vn: Thông báo thanh toán');
		$checksid = $request->sid;
		Session::forget('session_id');
		Session::forget('session_ma_id');
		$blockTpl = 'user.modules.cart.thongbao';
		return view($blockTpl);
	}
}