<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Order;
use Illuminate\Support\Facades\DB;
use Auth;

class Cartcontroller extends controller
{
	public function cart(){
		return view('cart');
	}

	public function addtocart($book_id){
		$book = book::find($book_id);
		if(!$book){
			return -1;
		}
		$cart = session()->get('cart');
		$total = session()->get('total');
		if(isset($cart[$book_id])) return -2;
		if (is_array($cart) && count($cart) == 5) {
			return -3;
		}
		if(!$cart){
			$cart = [];
		}
		if(!$total){
			$total = 0;
		}
		$cart[$book_id] = [
			"name" => $book->name,
			"price" => $book->price,
			"photo" => $book->img,
			"id" => $book_id,
			"category_id" => $book->category->id,
			"category" => $book->category->name,
			"des" => $book->describes
		];
		$total += $book->price;
		session()->put("cart",$cart);
		session()->put("total",$total);
		return 1;
	}

	public function remove(request $request){
		$book_id = $request->id;
		if($book_id){
			$cart = session()->get('cart');
			$total = session()->get('total');
			if(isset($cart[$book_id])){
				$total -= $cart[$book_id]['price'];
				unset($cart[$book_id]);
				session()->put('cart',$cart);
				session()->put('total',$total);
				return redirect()->back()->with(['class' => 'success', 'message' => 'Delete success.']);
			}
		}
		return redirect()->back()->with(['class' => 'danger', 'message' => 'Something wrong.']);
	}

	public function submit_cart(){
		$cart = session()->get('cart');
		$total = session()->get('total');
		if(!($cart || $total)) return redirect()->back()->with(['class' => 'danger', 'message' => 'Something wrong.']);
		//Dang muon sach theo mot don hang khac
		$ordering = Order::where('user_id','=',\Auth::user()->id)->wherein('status', [1,2,4])->get();
		if (count($ordering) >= 1) {
			switch ($ordering[0]->status) {
				case 1:
				$message = "You are watting admin submit orther cart !";
				break;
				case 2:
				$message = "You are have orther cart, please go to library to receive book !";
				break;
				case 4:
				$message = "You are borrowing books, go to library give book back to order orther cart";
				break;
				default:
				$message = "Something when wrong ,contact admin to support !";
				break;
			}
			return redirect()->back()->with(['class' => 'warning', 'message' => $message]);
		}
		if(Auth::user()->account_expiry_date < now()){
			return redirect()->back()->with(['class' => 'danger', 'message' => "Can't submit cart because your account has been expiry"]);
		}
		DB::beginTransaction();
		try {
			$order = DB::table('order')->insertGetId(['status' => 1,'price' => $total,'user_id' => \Auth::user()->id,'created_at' => now(),'updated_at' => now()]);
			foreach($cart as $c){
				DB::table('detail_order')->insert(['order_id' => $order,'book_id' => $c["id"],'created_at' => now(),'updated_at' => now()]);
			}
			DB::commit();
		} catch (Exception $e) {
			DB::rollBack();
			throw new Exception($e->getMessage());
		}
		session()->forget('cart');
		session()->forget('total');
		return redirect()->back()->with(['class' => 'success', 'message' => 'Your cart is submited, wait for admin check and go to library to get book !']);
	}
}
