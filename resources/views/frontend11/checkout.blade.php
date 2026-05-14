@extends('frontend.layout.master')

@section('content')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="ho-breadcrumb">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="shop-rightsidebar.html">Shop</a></li>
                    <li>Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!--// Breadcrumb Area -->

    <!-- Page Conttent -->
    <main class="page-content">

        <!-- Checkout Area -->
        <div class="checkout-area bg-white ptb-30">
            <div class="container">

                {{-- <div class="checkout-info">
                    <i class="fa fa-window-maximize"></i>
                    Already a customer? <a class="checkout-info-login-trigger" href="#">Click here to login</a>
                </div>

                <div class="checkout-info-collapsebox">
                    <form action="{{ route('login.customer') }}" class="ho-form ho-form-boxed checkout-info-login">
                        <div class="ho-form-inner">
                            <div class="single-input">
                                <label for="login-form-email">Username or email address *</label>
                                <input type="text" name="login-form-email" id="login-form-email">
                            </div>
                            <div class="single-input">
                                <label for="login-form-password">Password *</label>
                                <input type="password" name="login-form-password" id="login-form-password">
                            </div>
                            <div class="single-input">
                                <button type="submit" class="ho-button ho-button-sm mr-3">
                                    <span>Login</span>
                                </button>
                                <div class="checkbox-input">
                                    <input type="checkbox" name="login-form-remember" id="login-form-remember">
                                    <label for="login-form-remember">Remember me</label>
                                </div>
                            </div>
                            <div class="single-input">
                                <a href="#">Lost your password?</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="checkout-info">
                    <i class="fa fa-window-maximize"></i>
                    Have a coupon? <a class="checkout-info-coupon-trigger" href="#">Click here to enter your code</a>
                </div> --}}

                {{-- <div class="checkout-info-collapsebox">
                    <form action="#" class="checkout-info-coupon">
                        <input type="text" placeholder="Coupon code">
                        <button class="ho-button">
                            <span>Apply Coupon</span>
                        </button>
                    </form>
                </div> --}}

                <form action="{{ route('checkout.submit') }}" class="billing-info" method="post">
                    @csrf
                    <div class="row">

                        <!-- Billing Details -->
                        <div class="col-lg-6">

                            <h3 class="small-title">CHECKOUT DETAILS</h3>
                            <div class="ho-form">
                                <div class="ho-form-inner">
                                    <div class="single-input single-input-half">
                                        <label for="customer-firstname">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="customer-firstname"
                                            placeholder="Full Name">
                                    </div>
                                    <div class="single-input single-input-half">
                                        <label for="customer-email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="customer-email" placeholder="Email">
                                    </div>
                                    <div class="single-input single-input-half">
                                        <label for="customer-phone">Phone <span class="text-danger">*</span></label>
                                        <input type="number" name="phone" id="customer-phone" placeholder="Phone">
                                    </div>
                                    <div class="single-input single-input-half">
                                        <label for="customer-phone">Whatsapp <span class="text-danger">*</span></label>
                                        <input type="number" name="whatsapp" id="customer-whatsapp" placeholder="whatsapp">
                                    </div>
                                    <div class="single-input">
                                        <label for="customer-country">City <span class="text-danger">*</span></label>
                                        <select name="city" id="customer-country">
                                            <option value="">select</option>
                                            <option value="DUBAI">DUBAI</option>
                                            <option value="ABU DHABI">ABU DHABI</option>
                                            <option value="SHARJAH">SHARJAH</option>
                                            <option value="AJMAN">AJMAN</option>
                                            <option value="RAK">RAK</option>
                                            <option value="FUJAIRAH">FUJAIRAH</option>
                                            <option value="UMM AL QUWAIN">UMM AL QUWAIN</option>
                                            <option value="AL AIN">AL AIN</option>
                                        </select>
                                    </div>
                                    <div class="single-input">
                                        <label for="customer-address">Address<span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="customer-address"
                                            placeholder="Street Address">
                                        <input type="text" placeholder="Apartment, suite, unit etc. (optional)"
                                            id="autocomplete">
                                    </div>
                                    {{-- <div class="single-input single-input-half">
                                        <label for="customer-email">Lattitude</label>
                                        <input type="text" name="latitude" id="latitude" >
                                    </div>
                                    <div class="single-input single-input-half">
                                        <label for="customer-email">Longitude</label>
                                        <input type="text" name="longitude" id="longitude" >
                                    </div> --}}
                                    {{-- <div class="single-input single-input-half">
                                            <label for="customer-state">State *</label>
                                            <input type="text" name="customer-state" id="customer-state">
                                        </div> 
                                        <div class="single-input single-input-half">
                                            <label for="customer-postalcode">Postcode / ZIP *</label>
                                            <input type="number" name="customer-postalcode" id="customer-postalcode" min="1">
                                        </div> --}}
                                </div>
                            </div>

                            {{-- <div class="different-address">

                                    <div class="different-address-form-trigger">
                                        <input type="checkbox" id="direrent-address-toggle" class="ho-checkbox">
                                        <label for="direrent-address-toggle">SHIP TO DIFFERENT ADDRESS</label>
                                    </div>

                                    <div class="different-address-form">
                                        <div class="ho-form">
                                            <div class="ho-form-inner">
                                                <div class="single-input single-input-half">
                                                    <label for="customer2-firstname">First Name *</label>
                                                    <input type="text" name="customer2-firstname" id="customer2-firstname">
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="customer2-lastname">Last Name *</label>
                                                    <input type="text" name="customer2-lastname" id="customer2-lastname">
                                                </div>
                                                <div class="single-input">
                                                    <label for="customer2-companyname">Company Name</label>
                                                    <input type="text" name="customer2-companyname" id="customer2-companyname">
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="customer2-email">Email *</label>
                                                    <input type="email" name="customer2-email" id="customer2-email">
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="customer2-phone">Phone *</label>
                                                    <input type="text" name="customer2-phone" id="customer2-phone">
                                                </div>
                                                <div class="single-input">
                                                    <label for="customer2-country">City *</label>
                                                    <select name="customer2-country" id="customer2-country">
                                                        <option value="">select</option>
                                                        <option value="DUBAI">DUBAI</option>
                                                        <option value="ABU DHABI">ABU DHABI</option>
                                                        <option value="SHARJAH">SHARJAH</option>
                                                        <option value="AJMAN">AJMAN</option>
                                                        <option value="RAK">RAK</option>
                                                        <option value="FUJAIRAH">FUJAIRAH</option>
                                                        <option value="UMM AL QUWAIN">UMM AL QUWAIN</option>
                                                        <option value="AL AIN">AL AIN</option>
                                                    </select>
                                                </div>
                                                <div class="single-input">
                                                    <label for="customer2-address">Address*</label>
                                                    <input type="text" name="customer2-address" id="customer2-address"
                                                        placeholder="Street Address">
                                                    <input type="text" placeholder="Apartment, suite, unit etc. (optional)">
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="customer2-state">State *</label>
                                                    <input type="text" name="customer2-state" id="customer2-state">
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="customer2-postalcode">Postcode / ZIP *</label>
                                                    <input type="number" name="customer2-postalcode" id="customer2-postalcode">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div> --}}

                        </div>
                        <!--// Billing Details -->


                        <!-- Place Order -->
                        <div class="col-lg-6">
                            <div class="order-infobox">
                                <h3 class="small-title">YOUR ORDER</h3>
                                <div class="checkout-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-start">PRODUCT</th>
                                                <th class="text-end">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($array as $item)
                                                <tr>
                                                    <td class="text-start">{{ $item['name'] }} <span>×
                                                            {{ $item['quantity'] }}</span></td>
                                                    <td class="text-end">AED {{ $item['price'] * $item['quantity'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-start">CART SUBTOTAL</th>
                                                <td class="text-end">AED {{ $total_price }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-start">SHIPPING</th>
                                                <td class="text-end">Flat Rate: AED 0 </td>
                                            </tr>
                                            <tr class="total-price">
                                                <th class="text-start">ORDER TOTAL</th>
                                                <td class="text-end">AED {{ $total_price }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                {{-- <div class="payment-method">

                                    <div class="check-payment">
                                        <input type="radio" name="payment-method" id="checkout-payment-method-1"
                                            class="ho-radio" checked="checked">
                                        <label for="checkout-payment-method-1">Cheque Payment</label>
                                        <p>Please send your cheque to Store Name, Store Street, Store Town, Store
                                            State / County, Store Postcode.</p>
                                    </div>

                                    <div class="paypal-payment">
                                        <input type="radio" name="payment-method" id="checkout-payment-method-2"
                                            class="ho-radio">
                                        <label for="checkout-payment-method-2">Paypal Payment</label>
                                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                            PayPal account.</p>
                                    </div>

                                </div> --}}
                                {{-- <button class="ho-button ho-button-fullwidth mt-30" type="submit">
                                    <span>Proceed</span>
                                </button> --}}
                                <button class="ho-button ho-button-fullwidth mt-30" type="submit">
                                    <span>Submit</span>
                                </button>
                            </div>
                        </div>
                        <!--// Place Order -->

                    </div>
                </form>

            </div>
        </div>
        <!--// Checkout Area -->
        {{-- javascript code --}}
        <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>
        <script>
            // -----Country Code Selection
            $("#customer-phone").intlTelInput({
                initialCountry: "ae",
                separateDialCode: true,
                // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
            });
            $("#customer-whatsapp").intlTelInput({
                initialCountry: "ae",
                separateDialCode: true,
                // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
            });
        </script>
        <style>
            .iti {
                width: 100%
            }
        </style>
    @endsection
