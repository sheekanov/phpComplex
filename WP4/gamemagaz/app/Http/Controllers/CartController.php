<?php

namespace App\Http\Controllers;

use App\Events\OrderPostedEvent;
use App\Mail\newOrder;
use App\Order;
use App\OrderPosition;
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
        $order = Auth::user()->orders()->where('status', '=', 0)->first();
        $orderPositions=[];

        if (!is_null($order)) {
            $orderPositions = $order->orderPositions()->orderBy('created_at')->get()->all();
        }
        $data = ['page_title' => 'Корзина','content_title' => 'Мои заказы', 'orderPositions' => $orderPositions];

        return view('front.cart', $data);
    }

    public function add($product_id)
    {
        $user = Auth::user();
        $order = $user->orders()->where('status', '=', 0)->first();

        if (is_null($order)) {
            $order = new Order();
            $user->orders()->save($order);
        }

        $orderPosition = new OrderPosition();
        $orderPosition->product_id = $product_id;

        $order->orderPositions()->save($orderPosition);

        return redirect()->route('cart');
    }

    public function delete($orderPosition_id)
    {
        $user = Auth::user();
        OrderPosition::find($orderPosition_id)->delete();

        $order = $user->orders()->where('status', '=', 0)->first();

        if ($order->orderPositions()->count() == 0) {
            $order->delete();
        }

        return back();
    }

    public function send(Request $request)
    {

        $customerName = $request->all()['name'];
        $customerEmail = $request->all()['email'];

        $query = Auth::user()->orders()->where('status', '=', 0);
        $order = $query->first();
        $query->update(['status' => 1 , 'customer_name' => $customerName, 'customer_email' => $customerEmail]);

        event(new OrderPostedEvent($order));

        $message = 'Спасибо за заказ. Наш менеджер свяжется с Вами в течение дня.';
        $success = 1;

        $response = json_encode(['message' => $message, 'success' => $success], JSON_UNESCAPED_UNICODE);

        return $response;
    }

}
