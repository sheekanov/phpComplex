<?php

namespace App\Http\Controllers;

use App\Events\OrderPostedEvent;
use App\Mail\newOrder;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Setting;


class CartController extends Controller
{

    public function index()
    {
        $orders = Auth::user()->orders()->where('status', '=', 0)->orderBy('created_at')->get();

        $data = ['page_title' => 'Корзина','content_title' => 'Мои заказы', 'orders' => $orders];

        return view('front.cart', $data);
    }

    public function add($product_id)
    {
        $user = Auth::user();
        if (empty(($user->orders()->where('status', '=', 0)->where('product_id', '=', $product_id)->get()->all()))) {
            $order = new Order();
            $order->product_id = $product_id;
            $order->status = 0;
            $user->orders()->save($order);
        }

        return redirect()->route('cart');
    }

    public function delete($order_id)
    {
        Auth::user()->orders()->find($order_id)->delete();
        return back();
    }

    public function send(Request $request)
    {

        $customerName = $request->all()['name'];
        $customerEmail = $request->all()['email'];

        $query = Auth::user()->orders()->where('status', '=', 0);
        $orders = $query->get()->all();
        $query->update(['status' => 1 , 'customer_name' => $customerName, 'customer_email' => $customerEmail]);

        event(new OrderPostedEvent($orders));

        $message = 'Спасибо за заказ. Наш менеджер свяжется с Вами в течение дня.';
        $success = 1;

        $response = json_encode(['message' => $message, 'success' => $success], JSON_UNESCAPED_UNICODE);

        return $response;
    }

}
