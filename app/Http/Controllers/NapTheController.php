<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;
use App\User;
use App\log_nap_the;
use Auth;

class NapTheController extends Controller
{
	public function index(){
		return view('user.napthe');
	}

	public function napthe(Request $request){
		//get config
		$price_per_day = Config::where('name', 'price_per_day')->first()->value;
		$merchant_id = Config::where('name','=','merchant_id')->first()->value;
		$api_user = Config::where('name','=','api_user')->first()->value;
		$api_password = Config::where('name','=','api_password')->first()->value;
		$pin = $request->pin;
		$seri = $request->seri;
		$card_type = $request->name_card;
		$price_guest = $request->price;
		$note = "";

		$result =  file_get_contents("http://sv.gamebank.vn/api/card2?merchant_id=".$merchant_id."&api_user=".trim($api_user)."&api_password=".trim($api_password)."&pin=".trim($pin)."&seri=".trim($seri)."&card_type=".intval($card_type)."&price_guest=".$price_guest."&note=".urlencode($note)."");   
		$result = str_replace("\xEF\xBB\xBF",'',$result);
		$result = json_decode($result);

		if ($result->code == 0 && $result->info_card >= 10000) {
			$days = $price_guest/$price_per_day;
			$user = User::find(Auth::user()->id);
			$user->account_expiry_date = date("Y-m-d H:i:s", strtotime('+'.$days.' day', strtotime($user->account_expiry_date)));
			$data = [
				'pin' => $pin,
				'seri' => $seri,
				'status' => 0,
				'price' => $price_guest,
				'user_id' => Auth::user()->id
			];
			if($user->save()){
				$data['message'] = "Nạp thẻ thành công mệnh giá " .  $result->info_card. " tài khoản gia hạn thành công !";
			}else{
				$data['message'] = "Nạp thẻ thành công mệnh giá " .  $result->info_card. " ,nhưng lỗi database chưa cộng ngày được , vui lòng liên hệ admin để được hỗ trợ !";
			}
		}else{
			$data = [
				'pin' => $pin,
				'seri' => $seri,
				'status' => 1,
				'price' => $price_guest,
				'message' => $result->msg,
				'user_id' => Auth::user()->id
			];
		}
		log_nap_the::create($data);
		return  response()->json($data);
	}

	public function napthe_log(){
		$result = log_nap_the::where('user_id','=',Auth::user()->id)->get();
		return view('user.lognapthe',['datas' => $result]);
	}
}
