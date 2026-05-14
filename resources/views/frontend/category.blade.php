@extends('frontend.layout.master')

@section('content')
    <!-----------Categories Area----->
    <section class="cat" id="cat">
        <style>
            @media only screen and (max-width:480px){
                .bun .big-slider1{
                    margin-top:-20px !important;
                }
                .cat-slider .swiper-wrapper {
                    padding-top:0px !important;
                    padding-bottom: 10px !important;
                }
            }
        </style>
        {{-- <h1 id="" style="text-align: center;margin:0">Shop by categories</h1> --}}
        <div class="swiper cat-slider">
            <div class="swiper-wrapper">
                @foreach ($categories as $catitem)
                    <a href="{{ route('cat.view', encryptNumber($catitem->id)) }}">
                        <div class="swiper-slide bigbox">
                            <div class="box">
                                <img src="{{ asset('image/' . $catitem->image) }}" alt="">
                            </div>
                            <a href="{{ route('cat.view', encryptNumber($catitem->id)) }}">{{ $catitem->name }}</a>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="swiper-button-prev hide-mobile"></div>
            <div class="swiper-button-next hide-mobile"></div>
    </section>
    <!-----------Categories Area----->

    <!-----------For You Area ------->

    <!----------Product 1   -------->
    <section class="bun " id="bun">
        {{-- <p style="font-size: 17px;text-align: center">{{ $cat->name }}</p> --}}

        <div class="big-slider1">
            @foreach ($products as $item)
                <div class="swiper-slide1 box">
                    @if ($item->delivery_charge == 0)
                        <p>free shipping</p>
                    @endif
                    <div class="image">
                        <img src="{{ asset('image/' . $item->image) }}" alt="">
                    </div>
                    <div class="text">
                        <h3 class="product_name">{{ $item->name }}</h3>
                        <div class="price">
                            @if ($item->old_price != $item->price)
                                <span class="cut">{{ $item->old_price }} <strong class="cuts">AED</strong></span>
                            @endif
                            <span class="pri">{{ $item->price }} <strong class="red">AED</strong></span>
                        </div>
                        <div class="star">
                            <i class="fi fi-ss-star"></i>
                            <i class="fi fi-ss-star"></i>
                            <i class="fi fi-ss-star"></i>
                            <i class="fi fi-ss-star"></i>
                            <i class="fi fi-ss-star"></i>
                        </div>
                        <div class="button">
                            <a href="{{ route('products.buy', encryptNumber($item->id)) }}" class="buy-now-btn-4">Shop
                                Now</a>
                            <a href="{{ route('products.buy', encryptNumber($item->id)) }}" class="add-to-cart-2">Add to
                                Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
    <!----------Product 1   -------->
@endsection
