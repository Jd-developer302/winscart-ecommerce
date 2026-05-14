<!-----------Arrow Area --------->
<a href="#"><i class="fi fi-rr-caret-up" id="up"></i></a>
<!-----------Arrow Area --------->
<!-- WhatsApp -->
<div class="whatsapp">
    <a href="https://wa.me/+971586583113">
        <img src="{{ URL::asset('front/img/whatsapp.png') }}" alt="">
    </a>
</div>
<!-- Whatsapp -->

<!-----------Top Banner --------->
<!-- {{-- <section class="topbanner" id="topbanner">
    <img src="{{ URL::asset('front/img/top-banner.jpg') }}" alt="">
</section> --}} -->
<!-----------Top Banner --------->

<!-----------Top Heading--------->
{{-- <section class="head" id="head">
    <i class="fi fi-rr-circle-xmark" id="close"></i>
    <div class="left">
        <h1>free shipping<br>
            only on app</h1>
        <p>for new customer only</p>
    </div>
    <div class="btn-blk hide-mobile"><a href="#">shop now</a></div>
    <div class="btn-blk desk-hide"><a href="#">shop now!<i class="fi fi-sr-triangle-right"></i></a></div>

</section> --}}

<!-----------Top Heading--------->
{{-- <section class="desk-head" id="desk-head">

    <div class="left">
        <h1 id="text-uppercase">free shipping<br>
            only on app</h1>
        <p id="text-uppercase">for new customer only</p>
    </div>
    <button>shop now</button>
</section> --}}

<div class="scrolling-offer" id="special-offer">
    <span>Special Offer: Buy Any Two Items and Get FREE Delivery on Your Order! Don't Miss Out! 🚚✨ | Special Offer: Buy
        Any Two Items and Get FREE Delivery on Your Order! Don't Miss Out! 🚚✨ | Special Offer: Buy Any Two Items and
        Get FREE Delivery on Your Order! Don't Miss Out! 🚚✨</span>
    <button class="close-btn" onclick="closeOffer()">×</button>
</div>

<div class="content-head">

</div>

<!-----------Header Area--------->
<section class="header" id="header">
    <div class="container">
        <div class="logo">
            <a href="/"><img src="{{ URL::asset('front/img/logo.jpg') }}" alt="logo" class="logoimg"></a>
        </div>
        <div class="navbar">
            <div class="data">
                <a href="/" id="text-uppercase">home</a>
                <a href="/about-us" id="text-uppercase">about us</a>
                <a href="#" id="text-uppercase">shop</a>
                <a href="/contact" id="text-uppercase">contact us</a>
                <div class="dropdown">
                    <a href="#" id="text-uppercase" class="dropbtn">Category <img
                            src="{{ URL::asset('front/img/dropdown.png') }}" alt=""></a>
                    <div class="dropdown-content">
                        <a href="#">Best Deals</a>
                        <a href="#">Eye Wear</a>
                        <a href="#">Mobiles</a>
                        <a href="#">Watches</a>
                        <a href="#">Laptop</a>
                        <a href="#">Women's Fashion</a>
                        <a href="#">Beauty</a>
                        <a href="#">Entertainment</a>
                        <a href="#">Health</a>
                        <a href="#">Accessories</a>
                        <a href="#">Kitchen</a>
                        <a href="#">Men's Fashion</a>
                        <a href="#">Kids</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="icon">
            <div class="log">
                <!-- <i class="fi fi-rs-circle-user"></i> -->
                <img src="{{ URL::asset('front/img/user.png') }}" alt="" width="30px">
                <h4 class="login-text" style="font-weight: 400; color: grey; font-size: 16px">Sign in</h4>
                <div class="cart">
                    <!-- <i class="fi fi-rs-shopping-cart" id="cart"></i> -->
                    <img src="{{ URL::asset('front/img/trolly.png') }}" alt="" width="30px">

                    <h5>0</h5>
                </div>
                <div class="log hide-mobile">
                    <!-- <i class="fi fi-sr-heart"></i> -->
                    <img src="{{ URL::asset('front/img/heart.png') }}" alt="" width="30px">
                </div>
                <i class="fi fi-sr-menu-burger" id="menu"></i>
            </div>
            <!-- <div class="log hide-mobile">
                <div class="cart">
                    <i class="fi fi-rs-shopping-cart" id="cart"></i>
                    <h5>0</h5>
                </div>
                <i class="fi fi-rs-circle-user"></i>
                <h4 class="login-text" style="font-weight: 400; color: grey; font-size: 16px">LOG IN</h4>
                <div class="log hide-mobile heart">
                    <i class="fi fi-sr-heart"></i>
                </div>
                <i class="fi fi-sr-menu-burger" id="menu"></i>
            </div> -->
        </div>
</section>
<!-----------Header Area--------->

<!-----------Search Area--------->
<section class="search padding-search contact-search" id="search">
    <div class="container">
        <!-- <i class="fi fi-br-search" id="search-i"></i> -->
        <i class="fi fi-br-search" style="margin-left: 13px;"></i>
        <input type="Search" id="search" name="product" class="search-style"
            placeholder="Search entire store here..">
        <a href="javascript:void()" id="search-i">SEARCH</a>
    </div>
</section>
<!-----------Search Area--------->
<section class="search mobile_lock" id="search" style="padding: 20px 20px;">
    <div class="container" data-aos="flip-up">
        <!-- <i class="fi fi-br-search" id="search-i"></i> -->
        <input type="Search" id="search" name="product" class="search-style"
            placeholder="SEARCH A PRODUCT....">
        <a href="javascript:void()"><i class="fi fi-br-search" id="search-i"></i></a>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const dropbtn = document.querySelector('.dropbtn');
        const dropdownContent = document.querySelector('.dropdown-content');

        dropbtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (dropdownContent.style.display === 'flex') {
                dropdownContent.style.display = 'none';
            } else {
                dropdownContent.style.display = 'flex';
            }
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', (e) => {
            if (!e.target.matches('.dropbtn')) {
                if (dropdownContent.style.display === 'flex') {
                    dropdownContent.style.display = 'none';
                }
            }
        });
    });

    function closeOffer() {
        document.getElementById("special-offer").style.display = "none";
        document.querySelector(".content-head").style.marginTop = "0";
    }
</script>
<style>
    /* Container styling */
    .scrolling-offer {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #FABA36;
        color: #a80606;
        overflow: hidden;
        /* Hides overflow outside the container */
        white-space: nowrap;
        text-align: center;
        padding: 15px 0;
        z-index: 1000;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Text animation */
    .scrolling-offer span {
        display: inline-block;
        padding-left: 100%;
        /* Start from the right side */
        animation: scroll-text 30s linear infinite;
        /* Adjust duration as needed */
    }

    /* Keyframes for scrolling effect */
    @keyframes scroll-text {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* Prevent content overlap */

    /* Close button styling */
    .close-btn {
        position: absolute;
        right: 10px;
        top: 25%;
        transform: translateY(-50%);
        background: none;
        border: none;
        font-size: 20px;
        color: #333;
        cursor: pointer;
        font-weight: bold;
    }

    .close-btn:hover {
        color: #000;
    }

    .content-head {
        margin-top: 50px;
        /* Match the height of the .scrolling-offer banner */
    }
</style>
