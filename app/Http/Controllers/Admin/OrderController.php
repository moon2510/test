<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\orderRequest;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Book;
use App\User;
use App\OrderDetail;

class OrderController extends Controller
{
    public function index($status){
        $status = ($status < 1 || $status > 5) ? 1 : $status;
    	$orders = Order::where('status', '=', $status)->orderBy('id', 'DESC')->paginate(50);
        $dayBefore = (new \DateTime(now()))->modify('-1 day')->format('Y-m-d h:i:s');
        $orders_expired = Order::where('status', 2)->where('updated_at', '<', $dayBefore)->get();
    	return view('admin.orders.index', compact('orders', 'status', 'orders_expired'));
    }

    public function create(){
        return view('admin.orders.create');
    }

    public function store(orderRequest $request){
        foreach ($request->book as $key => $value) {
            $data[$value['id']] = $value['quantity'];
        }
        DB::beginTransaction();
        try {
            $order = Order::create(['user_id' => $request->readers]);
            foreach($data as $book_id => $quantity){
                if($book = Book::find($book_id)){
                    OrderDetail::create(['order_id' => $order->id,'book_id' => $book_id, 'quantity' => $quantity]);
                    $price = $book->price * $quantity;
                    $order->price += $price;
                    $order->save();
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        return redirect()->route('Order.List', 1)->with(['class' => 'success', 'message' => 'Thêm đơn hàng thành công']);
        
    }

    public function show(request $request){
        if($order = Order::find($request->id)){
            return response()->json([
                'readers' => $order->user->firstname.' '.$order->user->lastname,
                'contact' => $order->user->phone,
                'created_time' => date($order->created_at),
                'total' => number_format($order->price),
                'count' => $order->orderdetail->count(),
                'status' => $order->status,
                'date_borrow' => $order->date_borrow,
                'date_give_back' => $order->date_give_back,
                'note' => $order->note,
                'book' => $order->orderdetail->map(function($item){
                    $data = [
                        'id' => $item->id,
                        'name' => $item->book->name,
                        'quantity' => $item->quantity,
                        'bquantity' => $item->book->quantity,
                        'price' => number_format($item->book->price),
                        'total' => number_format($item->book->price*$item->quantity)
                    ];
                    return $data;
                })
            ]);
        }
    }

    public function update(request $request){
    	$data = $request->only('id', 'status');
    	if($order = Order::find($data['id'])){
            switch ($data['status']) {
                case 2:
                    // ẩn đi số lượng sách được phép thuê
                    $this->hiddenBook($order->orderdetail);
                    break;
                case 3:
                    if($order->status == 2){
                        // nếu đang chờ lấy nhưng bị hủy sẽ trã số lượng sách bị ẩn lại
                        $this->returnBook($order->orderdetail);
                    }
                    $order->note = $request->note;
                    break;
                case 4:
                    $order->date_borrow = now();
                    break;
                case 5:
                    // trã lại số sách bị ẩn
                    $this->returnBook($order->orderdetail);
                    $order->date_give_back = now();
                    break;
            }
            $order->status = $data['status'];
            if($order->save($data)){
                return response()->json(['error' => 0, 'message' => '']);
            }

    	}
    	return response()->json(['error' => 1, 'message' => 'Không tìm thấy đơn hàng']);
    }

    public function hiddenBook($book){
        $book->map(function($item){
            $book = Book::find($item->book->id);
            $book->quantity -= ($item->quantity > $book->quantity) ? $book->quantity : $item->quantity;
            return $book->save();
        });
    }

    public function returnBook($book){
        $book->map(function($item){
            $book = Book::find($item->book->id);
            $book->quantity += ($item->quantity - $item->lostbook->count() < 0) ? 0 : $item->quantity - $item->lostbook->count();
            return $book->save();
        });
    }

    public function destroy(request $request){
        $data = $request->only('id');
        if($order = Order::find($data['id'])){
            if($order->delete()){
                return response()->json(['error' => 0, 'message' => '']);
            }
        }
        return response()->json(['error' => 1, 'message' => 'Không tìm thấy đơn hàng']);
    }

    public function search(request $request, $status){
        $status = ($status < 1 || $status > 5) ? 1 : $status;
        $orders = Order::whereHas('user', function ($query) use ($request){
            return $query->WhereRaw("concat(firstname, ' ', lastname) like '%$request->key%' ");
        })->Where('status', $status)->orWhere('id', 'like', "%$request->key%")->Where('status', $status)->orderBy('status', 'ASC')->paginate(50);
        $dayBefore = (new \DateTime(date('Y-m-d h:i:s')))->modify('-1 day')->format('Y-m-d h:i:s');
        $orders_expired = Order::where('status', 2)->where('updated_at', '<', $dayBefore)->get();
        return view('admin.orders.index', compact('orders', 'status', 'orders_expired'));
    }

    public function OrderByBook($id){
        if($book = Book::find($id)){
            $details = OrderDetail::where('book_id', $id)->orderBy('id', 'ASC')->paginate(50);
            return view('admin.orders.orderbybook', compact(['details', 'book']));
        }
        return redirect()->Route('Book.List');
    }

    public function OrderByUser($id){
        if($user = User::find($id)){
            $orders = Order::where('user_id', $id)->orderBy('id', 'ASC')->paginate(50);
            return view('admin.orders.orderbyuser', compact(['orders', 'user']));
        }
        return redirect()->Route('Book.List');
    }

    public function report($id){
        $books = OrderDetail::where('order_id', $id)->orderBy('id', 'ASC')->paginate(50);
        return view('admin.orders.report', compact(['books']));
    }
}
