<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    public function generateInvoicePDF($order_id)
    {
        $order['details'] = Order::where('order_id', $order_id)->first();
        // $order['lines'] = OrderLine::
        $order['lines'] = DB::table('order_lines')
            ->leftjoin('products', 'order_lines.product_id', '=', 'products.id')
            ->select('order_lines.*', 'products.sku')
            ->where('order_lines.order_id', $order_id)
            ->get();
        $order['image_url'] = url('front/logo.jpg');
        $pdf = PDF::loadView('orders.invoice', $order)->setPaper('a6', 'portrait');

        Order::where('order_id', $order_id)
            ->update([
                'status' => 'INVOICE PRINTED',
            ]);
        OrderStatus::create([
            'order_id' => $order_id,
            'status' => 'INVOICE PRINTED',
            'changed_by' =>  auth()->user()->name,
            'user_id' => auth()->user()->id
        ]);

        //return view('orders.invoice', $order);
        return $pdf->download('invoice.pdf');
    }
    public function barcodeInvoice(Request $request)
    {
        $orders = explode(",", $request->ids);
        $pdf = PDF::loadView('orders.barcode', ['orders' => $orders])->setPaper('a4', 'portrait');


        //return view('orders.barcode', ['orders' => $orders]);
        return $pdf->download('barcode.pdf');
    }
    public function generateBulkInvoicePDF(Request $request)
    {
        $order_id_arr = explode(",", $request->ids);
        $i = 0;
        $changedArray = array();
        foreach ($order_id_arr as $item) {
            $orderStatus =  Order::where('order_id', $item)->value('status');
            if ($orderStatus == 'ORDER CONFIRMED') {
                $changedArray[$i] = $item;
                $order['details'][$i] = Order::where('order_id', $item)->first();
                // if (isset($item['product_id'])) {
                //     $product = Product::find($item['product_id']);->where('status', 'ORDER CONFIRMED')->
                //     $orderlineArray[$k]['bundle_id'] = null;
                //     $orderlineArray[$k]['product_id'] = $item['product_id'];
                //     $orderlineArray[$k]['delivery_charge'] = $product['delivery_charge'];
                //     Product::where('id', $item['product_id'])->decrement('stock', $item['quantity']);
                // } else {
                //     $product = Bundle::find($item['bundle_id']);
                //     $orderlineArray[$k]['product_id'] = null;
                //     $orderlineArray[$k]['bundle_id'] = $item['bundle_id'];
                //     $orderlineArray[$k]['delivery_charge'] = $product['delivery_charge'];
                //     $bundleLines = BundleLine::where('bundle_id', $item['bundle_id'])->get();
                //     foreach ($bundleLines as $line) {
                //         Product::where('id', $line['product_id'])->decrement('stock', $item['quantity'] * $line['quantity']);
                //     }
                // }
                $order['details'][$i]['lines'] = DB::table('order_lines')
                    ->leftjoin('products', 'order_lines.product_id', '=', 'products.id')
                    ->select('order_lines.*', 'products.sku')
                    ->where('order_lines.order_id', $item)
                    ->get();
                $j = 0;
                foreach ($order['details'][$i]['lines'] as $thing) {
                    if ($thing->product_id == null) {
                        $order['details'][$i]['lines'][$j]->product_name = Bundle::where('id', $thing->bundle_id)->value('name');
                    } else {
                        $order['details'][$i]['lines'][$j]->product_name = Product::where('id', $thing->product_id)->value('name');
                    }
                    $j++;
                }
                // Order::where('order_id', $item)
                //     ->update([
                //         'status' => 'INVOICE PRINTED',
                //     ]);
                $i++;
                OrderStatus::create([
                    'order_id' => $item,
                    'status' => 'INVOICE PRINTED',
                    'changed_by' =>  auth()->user()->name,
                    'user_id' => auth()->user()->id
                ]);
            }
        }
        //dd(isset($order));
        // $order['lines'] = OrderLine::
        if (isset($order)) {
            $pdf = PDF::loadView('orders.invoicetest', $order)->setPaper('a6', 'portrait');

            Order::whereIn('order_id', $changedArray)
                ->update([
                    'status' => 'INVOICE PRINTED',
                ]);

            //return view('orders.invoiceBulk', $order);
            return $pdf->download('invoice.pdf');
        } else {
            return redirect()->route('orders.index');
        }
    }
}
