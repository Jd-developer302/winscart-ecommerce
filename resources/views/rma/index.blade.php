@extends('layouts.master')

@section('content')
    <script src="{{ asset('assetst/js/jquery.min.js') }}"></script>

    <style>
        /* Define button colors */
        .delivered {
            background-color: green !important;
            color: white !important;
        }

        .pickedup {
            background-color: teal !important;
            color: white !important;
        }

        .packed {
            background-color: purple !important;
            color: white !important;
        }

        .invoice_printed {
            background-color: gray !important;
            color: white !important;
        }

        .assigned_to_rider {
            background-color: lightseagreen !important;
            color: white !important;
        }

        .default_status {
            background-color: lightgray !important;
            color: black !important;
        }
    </style>

    <div class="page-header">
        <h1 class="page-title">RMAs</h1>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Spend</h5>
                    <p class="card-text">${{ number_format($totalSpend, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Avg. Cost per Sale</h5>
                    <p class="card-text">${{ number_format($avgCostPerSale, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card ml-2 mt-5 mb-5 mb-lg-10">
        <div class="m-5">
            <!-- Search Form -->
            <form action="{{ route('rma.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 mt-5">
                        <input type="text" name="order_id" class="form-control" placeholder="Search by Order ID"
                            value="{{ request()->order_id }}">
                    </div>
                    <div class="col-md-3 mt-5">
                        <input type="text" name="contact_number" class="form-control"
                            placeholder="Search by Contact Number" value="{{ request()->contact_number }}">
                    </div>
                    <div class="col-md-3 mt-5">
                        <input type="date" name="start_date" class="form-control" value="{{ request()->start_date }}">
                    </div>
                    <div class="col-md-3 mt-5">
                        <input type="date" name="end_date" class="form-control" value="{{ request()->end_date }}">
                    </div>
                    {{-- <div class="col-md-3 mt-5">
                        <select name="sort_by" class="form-select">
                            <option value="order_id" {{ request('sort_by') == 'order_id' ? 'selected' : '' }}>Order ID</option>
                            <option value="total_spend" {{ request('sort_by') == 'total_spend' ? 'selected' : '' }}>Spend</option>
                            <option value="cost_per_sale" {{ request('sort_by') == 'cost_per_sale' ? 'selected' : '' }}>Cost per Sale</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-5">
                        <select name="sort_direction" class="form-select">
                            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div> --}}
                    <div class="col-md-12 mt-5 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('rma.index') }}" class="btn btn-dark ms-2">Refresh</a>
                    </div>
                </div>
            </form>

        </div>
        <div class="card-body">
            <div class="mt-2">
                @include('layouts.partials.messages')
            </div>
            <div class="table-responsive">
                <table class="table table-flush align-middle table-bordered table-row-solid gy-4 gs-9">
                    <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                        <tr style="background-color: #E4A11B;">
                            <th>No</th>
                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Total Price</th>
                            <th>Delivery Charge</th>
                            <th>Total Spend</th>
                            <th>Comment</th>
                            <th>Total Quantity</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="fw-6 fw-semibold text-gray-600">
                        @foreach ($rmas as $item)
                            @php
                                $status = $item->status ?? $item->order?->status;
                                $statusClass = match ($status) {
                                    'DELIVERED' => 'delivered',
                                    'PICKEDUP' => 'pickedup',
                                    'PACKED' => 'packed',
                                    'INVOICE PRINTED' => 'invoice_printed',
                                    'ASSIGNED TO RIDER' => 'assigned_to_rider',
                                    default => 'default_status',
                                };
                            @endphp
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->order_id }}</td>
                                <td>{{ $item->order?->name }}</td>
                                <td>
                                    {{ $item->name }}<br>
                                    <img src="{{ URL::asset('image/' . $item?->product?->image) }}" alt="item"
                                        width="100px">
                                </td>
                                <td>{{ $item->order?->phone }}</td>
                                <td>
                                    <button class="btn {{ $statusClass }}">
                                        {{ $status }}
                                    </button>
                                </td>
                                <td>{{ number_format($item->order?->total_price, 2) }}</td>
                                <td>{{ number_format($item->order?->delivery_charge, 2) }}</td>
                                <td>{{ number_format(($item->order?->total_price ?? 0) + ($item->order?->delivery_charge ?? 0), 2) }}</td>
                                <td>{{ $item->comment }}</td>
                                <td>{{ $item->order?->total_qty }}</td>
                                <td class="tdClass" >
                                    <label for="">Created ON:</label> {{$item->created_at }}<br>
                                    <label for="">Shipped ON:</label> {{ $item->shipped_date }}<br>
                                    @if ($item->status == 'DELIVERED')
                                    <label for="">Delivered ON:</label> {{ $item->updated_at }}<br>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('rma.show', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $rmas->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>
@endsection
