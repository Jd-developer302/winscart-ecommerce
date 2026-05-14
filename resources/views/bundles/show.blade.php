@extends('layouts.master')

@section('content')
    <script src="{{ asset('assetst/js/jquery.min.js') }}"></script>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Bundle Details</h1>
        <div>
            <ol class="breadcrumb">
                <a href="{{ route('bundles.index') }}" class="btn btn-sm btn-primary">Back</a>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="card ml-2 mt-5 mb-5 mb-lg-10">
        <div class="card-body">
            <div class="p-3 mt-4">
                <div>
                    <h4>Name: </h4>{{ $bundle->name }}
                </div>
                <div>
                    <h4>Image: </h4><img src="{{ URL::asset('image/' . $bundle->image) }}" alt="bundle" width="200px">
                </div>
                <div>
                    <h4>Price: </h4>{{ $bundle->price }}
                </div>
                <div>
                    <h4>Description: </h4>{{ $bundle->description }}
                </div>
                <div class="table-responsive">
                    <h4>Products: </h4>
                    <!--begin::Table-->
                    <table class="table table-flush align-middle table-bordered table-row-solid gy-4 gs-9">
                        <!--begin::Thead-->
                        <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                            <tr style="background-color: #E4A11B;">
                                <th class="thClass">No</th>
                                <th class="thClass">Product</th>
                                <th class="thClass">Image</th>
                                <th class="thClass">Quantity</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="fw-6 fw-semibold text-gray-600">
                            @foreach ($lines as $key => $item)
                                <tr>
                                    <th scope="row" class="tdClass">{{ $key + 1 }}</th>
                                    <td class="tdClass">{{ $item->name }}</td>
                                    <td class="tdClass"><img src="{{ URL::asset('image/' . $item->image) }}" alt="product"
                                            width="100px">
                                    </td>
                                    <td class="tdClass">{{ $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Tbody-->
                    </table>
                </div>
                <br>
            </div>
            <div class="mt-4 mb-4">
                <a href="{{ route('bundles.edit', $bundle->id) }}" class="btn btn-info">Edit</a>
            </div>
        </div>
    </div>
@endsection
