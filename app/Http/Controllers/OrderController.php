<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            $text = 'You\'re not authorized to see orders';

            return view('404', compact('text'));
        }
        $status = null;
        if ($request->query('status')) {
            $status = $request->query('status');
            Cookie::queue('status', $status, 5); // 60 minutes
        } else if (Cookie::get('status')) {
            $status = Cookie::get('status');
        }
        if ($status == 'all') {
            cookie()->queue(cookie()->forget('status'));
        }

        $model = new Order();
        $orders = $model->getOrders($status); // Fetch 20 products per page
        $data = [
            'orders' => $orders,
            'status' => $status,
        ];

        return view('orders.index', compact('data'));
    }

    public function getOrderForUpdate(Request $request, $orderId) {
        if (!Auth::check()) {
            $text = 'You\'re not authorized to edit orders';

            return view('404', compact('text'));
        }
        $model = new Order();
        $order = $model->getOrderById($orderId);
        if ($order->isEmpty()) {
            $text = 'Can\'t find order with ID '.$orderId;

            return view('404', compact('text'));

        } else {
            $order = $order->first();

            if ((!$request->user()->is_admin) && ($order->user_id != $request->user()->id)) {
                $text = 'You have no rights to edit this order';

                return view('404', compact('text'));
            }

            $productModel = new Product();
            $product = $productModel->getProductById($order->product_id);
            $product = $product->first();
            $data = [
                'order' => $order,
                'product' => $product,
            ];
        }

        return view('orders.edit', compact('data'));
    }

    public function processOrder(Request $request) {
        if ($request->has('product')) {
            $productId = $request->input('product');

            $model = new Product();
            $product = $model->getProductById($productId);
            if ($product->isEmpty()) {
                $text = 'Can\'t to create an order for a non-existent product';

                return view('404', compact('text'));

            } else {
                $product = $product->first();
            }

            return view('orders.create', compact('product'));

        } elseif ($request->has('id')) {
            $orderId = $request->input('id');

            $model = new Order();
            $order = $model->getOrderById($orderId);
            if ($order->isEmpty()) {
                $text = 'Can\'t find order with ID. UserId='.$request->user()->id;

                return view('404', compact('text'));

            } else {
                $order = $order->first();

                if ((!$request->user()->is_admin) && ($order->user_id != $request->user()->id)) {
                    $text = 'You have no rights to view this order. Please log in to see your orders';

                    return view('404', compact('text'));
                }

                $productModel = new Product();
                $product = $productModel->getProductById($order->product_id);
                $product = $product->first();
                $data = [
                    'order' => $order,
                    'product' => $product,
                ];
            }

            return view('orders.view', compact('data'));
        } else {
            $text = 'No product ID or order ID specified';

            return view('404', compact('text'));
        }
    }

    public function create(CreateOrderRequest $request)
    {
        $data = [
            'product_id' => $request->validated('product_id'),
            'price' => $request->validated('price'),
            'user_name' => $request->validated('name'),
            'user_email' => $request->validated('email'),
            'user_phone' => $request->validated('phone'),
            'customer_comment' => $request->validated('customer_comment'),
            'user_id' => $request->validated('user_id'),
        ];

        $newOrder = Order::create($data);
        $orderId = $newOrder->id;

        return redirect()->route('orders.created')->with('orderId', $orderId);
    }

    public function created() {
        return view('orders.created');
    }

    public function updateOrder(Request $request)
    {
        $model = Order::where('id', $request->get('id'));
        $order = [
            'user_email' => $request->get('email'),
            'user_phone' => $request->get('phone'),
            'customer_comment' => $request->get('customer_comment'),
            'comment' => $request->get('comment'),
            'status' => $request->get('status'),
            ];
        $model->update($order);

        return redirect()->route('home');
    }
}
