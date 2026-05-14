@extends('layouts.master')

@section('content')
    <script src="{{ asset('assetst/js/jquery.min.js') }}"></script>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Product Details</h1>
        <div>
            <ol class="breadcrumb">
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Back</a>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="card ml-2 mt-5 mb-5 mb-lg-10">
        <div class="card-body">
            <div class="p-3 mt-4">
                <div>
                    <h4>Name: </h4>{{ $product->name }}
                </div>
                <div>
                    <h4>Image: </h4><img src="{{ URL::asset('image/' . $product->image) }}" alt="product" width="200px">
                </div>
                <div>
                    <h4>Code: </h4>{{ $product->code }}
                </div>
                <div>
                    <h4>Brand: </h4>{{ $product->brand }}
                </div>
                <div>
                    <h4>Description: </h4>{{ $product->description }}
                </div>
                <br>
            </div>
            <div class="mt-4 mb-4">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Edit</a>
            </div>
        </div>
    </div>
@endsection
