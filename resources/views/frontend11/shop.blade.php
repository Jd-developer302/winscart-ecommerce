@extends('frontend.layout.master')

@section('content')
    <section class="after-head top-block-page with-back white-curve-after section-white-text">
        <div class="overflow-back bg-orange" style="background-color: #ffffff!important;"></div>
        <div class="content-offs-stick my-5 container">
            <div class="section-solid with-back">
                <div class="full-block">
                    <div class="section-back-text">Shop</div>
                    <!--  <img class="d-none d-lg-block z-index-3" src="assets/images/content/x/mandarin.png" alt="" data-size="280px" data-at="10%;bottom 35%">
            <img class="d-none d-lg-block z-index-3" src="assets/images/content/x/kiwi-blur.png" alt="" data-size="137px" data-at="right 5%;35%"> -->

                </div>
                <div class="z-index-4 position-relative text-center">
                    <h1 class="section-title">&nbsp;</h1>
                    <div class="mt-3">
                        {{-- <div class="page-breadcrumbs">
                            <a class="content-link" href="">Home</a>
                            <span class="mx-2">\</span>
                            <a class="content-link" href="">Shop</a>
                            <span class="mx-2">\</span>
                            <span>Product</span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light-green white-curve-before curve-before-0 white-curve-after curve-after-40 section-solid">
        <div class="overflow-back bg-vegetables-pattern opacity-10"></div>
        <div class="full-block">
            <!--  <div class="container h-100 position-relative" data-size="50%"><img class="z-index-4 d-none d-xl-block mw-100" src="assets/images/content/x/section-lime.png" alt="" data-size="270px" data-at="115%;0"></div> -->
        </div>

        <div class="container">
            <div class="grid row">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-lg-4" style="height: 30rem">
                        <article class="entity-block entity-hover-shadow text-center entity-preview-show-up products" style="height: 30rem">
                            <div class="entity-preview">
                                <div class="embed-responsive embed-responsive-4by3"><img class="embed-responsive-item"
                                        src="/image/{{ $product->image }}" alt="{{ $product->name }}"></div>

                            </div>
                            <div class="pb-4 entity-content">
                                <h4 class="entity-title"><a class="content-link"
                                        href="{{ url('buy', $product->id) }}">{{ $product->name }}</a></h4>
                                <div class="mx-auto mt-auto mb-4 text-center"><a class="btn-wide mr-2 btn btn-theme"
                                        href="{{ url('buy', $product->id) }}">buy now</a></div>
                                <!--   <div class="entity-price"><span class="currency">$</span>1.80 <span class="price-unit">/ kg</span></div> -->
                            </div>
                        </article>
                    </div>
                @endforeach
                @foreach ($consumables as $consumable)
                    <div class="col-sm-6 col-lg-4"  style="height: 30rem">
                        <article class="entity-block entity-hover-shadow text-center entity-preview-show-up products" style="height: 30rem">
                            <div class="entity-preview">
                                <div class="embed-responsive embed-responsive-4by3"><img class="embed-responsive-item"
                                        src="/image/{{ $consumable->image }}" alt="{{ $consumable->name }}"></div>

                            </div>
                            <div class="pb-4 entity-content">
                                <h4 class="entity-title"><a class="content-link"
                                        href="{{ url('buy-consumable', $consumable->id) }}">{{ $consumable->name }}</a></h4>
                                <div class="mx-auto mt-auto mb-4 text-center"><a class="btn-wide mr-2 btn btn-theme"
                                        href="{{ url('buy-consumable', $consumable->id) }}">buy now</a></div>
                                <!--   <div class="entity-price"><span class="currency">$</span>1.80 <span class="price-unit">/ kg</span></div> -->
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection
