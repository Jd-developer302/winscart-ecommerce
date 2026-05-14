<?php

namespace App\Http\Controllers;

use App\Models\Rma;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $rmas = Rma::with('user', 'order', 'product')->latest()->paginate(50);
        $query = Rma::with('user', 'order', 'product')->latest();

        if ($request->has('order_id') && !empty($request->order_id)) {
            $query->where('order_id', $request->order_id);
        }

        // Filter by Contact Number
        if ($request->has('contact_number') && !empty($request->contact_number)) {
            $query->whereHas('order', function ($q) use ($request) {
                $q->where('phone', 'like', '%' . $request->contact_number . '%');
            });
        }

        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // Filter by End Date
        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // if ($request->has('sort_by')) {
        //     $sortColumn = $request->sort_by; 
        //     $sortDirection = $request->sort_direction ?? 'asc'; 

 
        //     if (in_array($sortColumn, ['order_id'])) {
        //         $query->orderBy($sortColumn, $sortDirection);
        //     }

        //     if ($request->sort_by === 'total_spend') {
        //         $query->orderBy(
        //             Order::selectRaw('total_price + delivery_charge')
        //                 ->whereColumn('orders.order_id', 'rmas.order_id'),
        //             $sortDirection
        //         );
        //     }
        // }
        $rmas = $query->paginate(50);
        $totalSpend = 0;
        $totalPriceSum = 0;

        foreach ($rmas as $item) {
            if ($item->order) {
                $totalSpend += $item->order->total_price + $item->order->delivery_charge;
                $totalPriceSum += $item->order->total_price;
            }
        }
        $totalOrders = Rma::count();
        $avgCostPerSale = $totalOrders > 0 ? $totalPriceSum / $totalOrders : 0;
        return view('rma.index', compact('rmas', 'totalOrders', 'totalSpend', 'avgCostPerSale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rma = Rma::with(['user', 'order', 'product'])->findOrFail($id);
        // dd($rma);
        return view('rma.show', compact('rma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'nullable|string|max:255',
            'status'  => 'required|in:RMA,INVOICE PRINTED,PACKED,ASSIGNED TO RIDER,PICKEDUP,DELIVERED',
        ]);

        $rma = Rma::findOrFail($id);
        $rma->comment = $request->comment;
        $rma->status = $request->status;
        $rma->save();

        return redirect()->route('rma.index')->with('success', 'RMA updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
