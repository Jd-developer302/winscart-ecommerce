<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Consumable;
use App\Models\Missing;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cartList()
    {
        $count = $this->cartCount();
        $setting = Setting::first();
        $cartItems = session()->get('cart');
        $total_price = 0;
        $courier = 0;
        $delCharge = null;
        if ($cartItems != null) {
            foreach ($cartItems as $item) {
                $total_price = $total_price + ($item['price'] * $item['quantity']);
                if ($delCharge == null || $item['delivery_charge'] < $delCharge) {
                    $delCharge = $item['delivery_charge'];
                }
            }
            $courier = $delCharge;
        }
        return view('frontend.cart', compact('cartItems', 'total_price', 'count', 'courier', 'setting'));
    }

    public function buyNow(Request $request)
    {
        $cart = session()->get('order_id');
        $quantity = isset($request->qty) ? $request->qty : 1;
        // if cart is empty then this the first product
        $product = Product::find($request->id);

        $latestOrder = Order::latest()->first();
        $orderId = $latestOrder->id + 1;

        $input = $request->all();
        $payment_gateway = @$input['payment_method'];

        $order_id = session()->get('order_id');
        if ($order_id == null) {

            $input['order_id'] = "UAE1000" . $orderId;
            $input['total_qty'] = $quantity;
            if (!isset($input['email'])) {
                $input['email'] = $request->phone . '@gmail.com';
            }
            $input['delivery_charge'] = $product->delivery_charge;
            $input['total_vat'] = $product->price * $quantity * 0.05;
            $input['total_price'] = $product->price * $quantity + $input['total_vat'] + $input['delivery_charge'];
            $input['status'] = 'ORDER PLACED';
            $input['source'] = 'Online Order';
            $input['created_by'] = 'Online Order';
            // $input['delivery_charge'] = 14;
            $order = Order::create($input);
            OrderLine::insert([
                'order_id' => $order->order_id,
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "vat" => ($product->is_vat) ? ($product->price * $quantity * .05) : 0,
                "sub_price" => ($product->is_vat) ? (($product->price * .05 * $quantity) + ($product->price * $quantity)) : ($product->price * $quantity),
                "delivery_charge" => ($quantity > 1) ? 0 : $product->delivery_charge,
                // "image" => $product->image,
                // "variant" => ''
            ]);
            session()->put('order_id', $order->id);
        } else {
            $order = Order::find($order_id);
            $input['total_qty'] = $order->total_qty + $quantity;
            $input['email'] = $request->phone . '@gmail.com';
            $input['total_price'] = $order->total_price + $product->price * $quantity;
            $order->update($input);
            $line = OrderLine::where('order_id', $order->order_id)->where('product_id', $product->id)->first();
            if (is_null($line)) {
                OrderLine::insert([
                    'order_id' => $order->order_id,
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "vat" => ($product->is_vat) ? ($product->price * .05 * $quantity) : 0,
                    "sub_price" => ($product->is_vat) ? (($product->price * .05 * $quantity) + ($product->price  * $quantity)) : ($product->price * $quantity),
                    "delivery_charge" => $product->delivery_charge,
                ]);
            } else {
                $lineupdate['quantity'] = $quantity + $line->quantity;
                $Qtyprice = $product->price * $lineupdate['quantity'];
                $lineupdate['price'] = $product->price;
                $lineupdate['vat'] =  ($product->is_vat) ? ($Qtyprice * .05) : 0;
                $lineupdate['sub_price'] = ($product->is_vat) ? ($lineupdate['vat'] + $Qtyprice) : $Qtyprice;
                $line->update($lineupdate);
            }
        }
        $lines = OrderLine::where('order_id', $order->order_id)->get();
        $delivery_charge = $lines->first()->delivery_charge;
        $total_qty = 0;
        $vat = 0;
        $total_price = 0;
        foreach ($lines as $line) {
            $delivery_charge = ($line->delivery_charge > $delivery_charge) ? $line->delivery_charge : $delivery_charge;
            $total_qty += $line->quantity;
            $vat += $line->vat;
            $total_price += $line->sub_price;
        }
        if ($total_price >= 200) {
            $total_price = $total_price;
            $delivery_charge = 0;
        } else if ($total_qty > 1) {
            $total_price = $total_price;
            $delivery_charge = 0;
        } else {
            $total_price = $delivery_charge + $total_price;
        }
        if ($payment_gateway == 'gateway') {
            return view('checkout');
        }
        Order::where('id', $order_id)->update(['status' => 'ORDER CONFIRMED', 'total_price' => $total_price, 'total_qty' => $total_qty, 'total_vat' => $vat, 'delivery_charge' => $delivery_charge]);

        $miss_id = session()->get('missing_id');
        if (!is_null($miss_id)) {
            $miss = Missing::find($miss_id);
            $miss->order_id = session()->get('order_id');
            $miss->save();
            session()->forget('missing_id');
            $miss->delete();
        }


        return redirect()->route('order.success', compact('order', 'lines'));
    }

    public function orderSuccess()
    {
        $setting = Setting::first();
        $order_id = session()->get('order_id');
        if (is_null($order_id)) {
            return redirect()->route('home');
        }
        $order = Order::find($order_id);
        $lines = OrderLine::where('order_id', $order->order_id)->get();
        return view('frontend.order_success', compact('order', 'lines', 'setting'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('tempcart');
        $quantity = isset($request->qty) ? $request->qty : 1;
        // if cart is empty then this the first product
        if (!$cart) {

            $id = $request->product_id;
            $product = Product::find($id);

            $cart = [
                $id => [
                    "product_id" => $id,
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "image" => $product->image,
                    "delivery_charge" => $product->delivery_charge,
                ]
            ];
            session()->put('tempcart', $cart);
            return redirect()->route('checkout');

            //return redirect()->route('cart.list');
        }
        // if cart not empty then check if this product exist then increment quantity
        $id = $request->product_id;
        $product = Product::find($id);
        if (isset($cart[$id])) {
            $cart[$id] = [
                "product_id" => $id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "delivery_charge" => $product->delivery_charge,
            ];
            session()->put('tempcart', $cart);
            return redirect()->route('checkout');

            //return redirect()->route('cart.list');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "product_id" => $id,
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $product->price,
            "image" => $product->image,
            "delivery_charge" => $product->delivery_charge,
        ];
        session()->put('tempcart', $cart);
        return redirect()->route('checkout');
    }


    public function addToCart1(Request $request)
    {

        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if (!$cart) {

            $id = $request->id;
            $product = Product::find($id);
            $cart = [
                $id => [
                    "product_id" => $id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "image" => $product->image,
                    "delivery_charge" => $product->delivery_charge,
                ]
            ];
            session()->put('cart', $cart);
            session()->flash('success', 'Product is Added to Cart Successfully !');

            //return redirect()->route('cart.list');
        }
        // if cart not empty then check if this product exist then increment quantity
        $id = $request->id;
        $product = Product::find($id);
        if (isset($cart[$id])) {
            $cart[$id] = [
                "product_id" => $id,
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image,
                "delivery_charge" => $product->delivery_charge,
            ];
            session()->put('cart', $cart);
            session()->flash('success', 'Product is Added to Cart Successfully !');

            //return redirect()->route('cart.list');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "product_id" => $id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image,
            "delivery_charge" => $product->delivery_charge,
        ];
        session()->put('cart', $cart);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        //return redirect()->route('cart.list');
    }


    public function updateCart(Request $request)
    {
        $id = $request->id;
        if (str_contains($id, 'i')) {
            $Nid = str_replace('i', '', $id);
            $product = Consumable::find($Nid);
        } else {
            $product = Product::find($id);
        }

        $cartItems = session()->get('cart');
        $quantity = $cartItems[$id]['quantity'] + 1;
        if ($product['quantity'] >= $cartItems[$id]['quantity'] + 1) {
            $cartItems[$id] = [
                "product_id" => $id,
                "name" => $cartItems[$id]['name'],
                "quantity" => $quantity,
                "price" => $cartItems[$id]['price'],
                "image" => $cartItems[$id]['image'],
                "variant" => $cartItems[$id]['variant']
            ];
            session()->put('cart', $cartItems);
            session()->flash('success', 'Item Cart is Updated Successfully !');
        } else {
            $cartItems[$id] = [
                "product_id" => $id,
                "name" => $cartItems[$id]['name'],
                "quantity" => $product['quantity'],
                "price" => $cartItems[$id]['price'],
                "image" => $cartItems[$id]['image'],
                "variant" => $cartItems[$id]['variant']
            ];
            session()->put('cart', $cartItems);
            session()->flash('error' . $id . '', 'Only ' . $product['quantity'] . ' quantities available ');
        }


        return redirect()->route('cart.list');
    }
    public function updateCartAjax(Request $request)
    {
        $id = $request->product_id;
        if (str_contains($id, 'i')) {
            $Nid = str_replace('i', '', $id);
            $product = Bundle::find($Nid);
        } else {
            $product = Product::find($id);
        }
        $quantity = $request->quantity;
        $cartItems = session()->get('cart');
        if ($product['stock'] >= $quantity) {
            $cartItems[$id] = [
                "product_id" => $id,
                "name" => $cartItems[$id]['name'],
                "quantity" => $quantity,
                "price" => $cartItems[$id]['price'],
                "image" => $cartItems[$id]['image'],
                "delivery_charge" => $cartItems[$id]['delivery_charge']
            ];
            session()->put('cart', $cartItems);
            session()->flash('success', 'Item Cart is Updated Successfully !');
        } else {
            $cartItems[$id] = [
                "product_id" => $id,
                "name" => $cartItems[$id]['name'],
                "quantity" => $product['stock'],
                "price" => $cartItems[$id]['price'],
                "image" => $cartItems[$id]['image'],
                "delivery_charge" => $cartItems[$id]['delivery_charge']
            ];
            session()->put('cart', $cartItems);
            session()->flash('error' . $id . '', 'Only ' . $product['quantity'] . ' quantities available ');
        }

        return redirect()->route('cart.list');
    }
    public function updateSubCart(Request $request)
    {
        $id = $request->id;
        if (str_contains($id, 'i')) {
            $Nid = str_replace('i', '', $id);
            $product = Consumable::find($Nid);
        } else {
            $product = Product::find($id);
        }
        $cart = session()->get('cart');
        $quantity = $cart[$id]['quantity'] - 1;
        if ($product['quantity'] >= $cart[$id]['quantity'] - 1) {
            if ($quantity > 0) {
                $cart[$id] = [
                    "product_id" => $id,
                    "name" => $cart[$id]['name'],
                    "quantity" => $quantity,
                    "price" => $cart[$id]['price'],
                    "image" => $cart[$id]['image'],
                    "variant" => $cart[$id]['variant']
                ];
            } else {
                $cart = session()->get('cart');
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
            session()->flash('success', 'Item Cart is Updated Successfully !');
        }

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        session()->flash('success', 'Item Cart Remove Successfully !');

        // return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        $cart = session()->get('cart');
        unset($cart);

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    public function cartCount()
    {
        $cartItems = session()->get('cart');
        $count = 0;
        if ($cartItems != "") {
            $count = count($cartItems);
        } else {
            $count = 0;
        }
        return $count;
    }
}
