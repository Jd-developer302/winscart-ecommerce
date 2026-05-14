@extends('frontend.layout.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <div class="card-wrapper">
        <div class="card">
            <!-- card left -->
            <div class="product-imgs">
                <div class="img-display">
                    <div class="img-showcase">
                        <img src="{{ asset('image/' . @$product->image) }}" alt="">
                        @foreach ($images as $img)
                            <img src="{{ asset('images/' . @$img->image) }}" alt="">
                        @endforeach
                    </div>
                </div>
                <div class="img-select">
                    <div class="swiper gallery-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="img-item">
                                    <a href="#" data-id="1">
                                        <img src="{{ asset('image/' . @$product->image) }}" alt="image">
                                    </a>
                                </div>
                            </div>
                            @foreach ($images as $key => $img)
                                <div class="swiper-slide">
                                    <div class="img-item">
                                        <a href="#" data-id="{{ $key + 2 }}">
                                            <img src="{{ asset('images/' . @$img->image) }}" alt="shoe image">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="gallery-swiper-pagination"></div>
                    </div>
                </div>
                <script>
                    var swiper = new Swiper(".gallery-slider", {
                        slidesPerView: 4,
                        spaceBetween: 0,
                        autoplay: {
                            delay: 7000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.gallery-swiper-pagination',
                            clickable: true,
                        },
                    });
                </script>
            </div>
            <!-- card right -->
            <div class="contact-form">
                <a style="font-size: 21px; font-weight: 600;">{{ $product->name }}</a>
                <div class="price" style="padding: 6px 0px">
                    <span style="font-size: 25px; font-weight: 700; color: var(---yellow);">{{ $product->price }} AED</span>
                    @if ($product->old_price < $product->price)
                        <span style="text-decoration: line-through;">{{ $product->old_price }} AED</span>
                    @endif
                    @if ($product->delivery_charge == 0)
                        <span class="delivery">Free shipping</span>
                    @endif
                </div>
                <div class="info-row" style="margin-bottom: 10px">
                    <div class="info-column sku">SKU: <span>{{ $product->sku }}</span></div>
                    <div class="info-column brands">Brand: <span>{{ $product->brand }}</span></div>
                </div>
                <form action="{{ route('buy.now') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}" id="product_id">
                    @if (!is_null(session()->get('order_id')))
                        <div class="form-group">
                            <label for="quantity" class="required"><img src="{{ URL::asset('front/img/quantity-y.png') }}"
                                    alt="">Quantity:</label>
                            <select name="qty" id="">
                                <option value="1">1 -
                                    {{ $product->price }} AED</option>
                                <option value="2">2 - {{ 2 * $product->price }} AED</option>
                                <option value="3">3 - {{ 3 * $product->price }} AED</option>
                                <option value="4">4 - {{ 4 * $product->price }} AED</option>
                                <option value="5">5 - {{ 5 * $product->puaerice }} AED</option>
                                <option value="6">6 - {{ 6 * $product->price }} AED</option>
                                <option value="7">7 - {{ 7 * $product->price }} AED</option>
                                <option value="8">8 - {{ 8 * $product->price }} AED</option>
                            </select>
                        </div>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="gateway" name="payment_method" value="gateway">
                                <label for="gateway">Online Payment</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="cod" name="payment_method" value="cod" checked>
                                <label for="cod">Cash on Delivery</label>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="number" class="required"> Mobile Number:</label>
                            <div class="country-code">
                                <div class="input-icon"><img src="{{ URL::asset('front/img/mobile-y.png') }}"
                                        alt="">
                                    <div class="code-container">
                                        <img class="flag"
                                            src="https://upload.wikimedia.org/wikipedia/commons/c/cb/Flag_of_the_United_Arab_Emirates.svg"
                                            alt="UAE Flag">
                                        <span>+971</span>
                                    </div>
                                    <input type="text" id="phone" name="phone" required>
                                </div>
                            </div>
                            <span id="error-message" style="color: red; display: none;">Please give your valid mobile number
                                '512345678' without the '0' in front is not valid.</span>
                        </div>
                        <div class="form-group">
                            <label for="name" class="required">
                                Full Name:</label>
                            <div class="input-icon">
                                <img src="{{ URL::asset('front/img/fullname-y.png') }}" alt="">
                                <input type="text" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="number" class="">
                                WhatsApp Number:</label>
                            <div class="country-code">
                                <div class="input-icon">
                                    <img src="{{ URL::asset('front/img/whatsapp-number-y.png') }}" alt="">
                                    <div class="code-container">
                                        <img class="flag"
                                            src="https://upload.wikimedia.org/wikipedia/commons/c/cb/Flag_of_the_United_Arab_Emirates.svg"
                                            alt="UAE Flag">
                                        <span>+
                                            <select name="country-code-select" id="country-code-select">
                                                <option value="+1">1</option> <!-- United States, Canada -->
                                                <option value="+7">7</option> <!-- Russia, Kazakhstan -->
                                                <option value="+20">20</option> <!-- Egypt -->
                                                <option value="+27">27</option> <!-- South Africa -->
                                                <option value="+30">30</option> <!-- Greece -->
                                                <option value="+31">31</option> <!-- Netherlands -->
                                                <option value="+32">32</option> <!-- Belgium -->
                                                <option value="+33">33</option> <!-- France -->
                                                <option value="+34">34</option> <!-- Spain -->
                                                <option value="+36">36</option> <!-- Hungary -->
                                                <option value="+39">39</option> <!-- Italy -->
                                                <option value="+40">40</option> <!-- Romania -->
                                                <option value="+41">41</option> <!-- Switzerland -->
                                                <option value="+43">43</option> <!-- Austria -->
                                                <option value="+44">44</option> <!-- United Kingdom -->
                                                <option value="+45">45</option> <!-- Denmark -->
                                                <option value="+46">46</option> <!-- Sweden -->
                                                <option value="+47">47</option> <!-- Norway -->
                                                <option value="+48">48</option> <!-- Poland -->
                                                <option value="+49">49</option> <!-- Germany -->
                                                <option value="+51">51</option> <!-- Peru -->
                                                <option value="+52">52</option> <!-- Mexico -->
                                                <option value="+53">53</option> <!-- Cuba -->
                                                <option value="+54">54</option> <!-- Argentina -->
                                                <option value="+55">55</option> <!-- Brazil -->
                                                <option value="+56">56</option> <!-- Chile -->
                                                <option value="+57">57</option> <!-- Colombia -->
                                                <option value="+58">58</option> <!-- Venezuela -->
                                                <option value="+60">60</option> <!-- Malaysia -->
                                                <option value="+61">61</option> <!-- Australia -->
                                                <option value="+62">62</option> <!-- Indonesia -->
                                                <option value="+63">63</option> <!-- Philippines -->
                                                <option value="+64">64</option> <!-- New Zealand -->
                                                <option value="+65">65</option> <!-- Singapore -->
                                                <option value="+66">66</option> <!-- Thailand -->
                                                <option value="+81">81</option> <!-- Japan -->
                                                <option value="+82">82</option> <!-- South Korea -->
                                                <option value="+84">84</option> <!-- Vietnam -->
                                                <option value="+86">86</option> <!-- China -->
                                                <option value="+90">90</option> <!-- Turkey -->
                                                <option value="+91">91</option> <!-- India -->
                                                <option value="+92">92</option> <!-- Pakistan -->
                                                <option value="+93">93</option> <!-- Afghanistan -->
                                                <option value="+94">94</option> <!-- Sri Lanka -->
                                                <option value="+95">95</option> <!-- Myanmar -->
                                                <option value="+98">98</option> <!-- Iran -->
                                                <option value="+211">211</option> <!-- South Sudan -->
                                                <option value="+212">212</option> <!-- Morocco -->
                                                <option value="+213">213</option> <!-- Algeria -->
                                                <option value="+216">216</option> <!-- Tunisia -->
                                                <option value="+218">218</option> <!-- Libya -->
                                                <option value="+220">220</option> <!-- Gambia -->
                                                <option value="+221">221</option> <!-- Senegal -->
                                                <option value="+222">222</option> <!-- Mauritania -->
                                                <option value="+223">223</option> <!-- Mali -->
                                                <option value="+224">224</option> <!-- Guinea -->
                                                <option value="+225">225</option> <!-- Ivory Coast -->
                                                <option value="+226">226</option> <!-- Burkina Faso -->
                                                <option value="+227">227</option> <!-- Niger -->
                                                <option value="+228">228</option> <!-- Togo -->
                                                <option value="+229">229</option> <!-- Benin -->
                                                <option value="+230">230</option> <!-- Mauritius -->
                                                <option value="+231">231</option> <!-- Liberia -->
                                                <option value="+232">232</option> <!-- Sierra Leone -->
                                                <option value="+233">233</option> <!-- Ghana -->
                                                <option value="+234">234</option> <!-- Nigeria -->
                                                <option value="+235">235</option> <!-- Chad -->
                                                <option value="+236">236</option> <!-- Central African Republic -->
                                                <option value="+237">237</option> <!-- Cameroon -->
                                                <option value="+238">238</option> <!-- Cape Verde -->
                                                <option value="+239">239</option> <!-- Sao Tome and Principe -->
                                                <option value="+240">240</option> <!-- Equatorial Guinea -->
                                                <option value="+241">241</option> <!-- Gabon -->
                                                <option value="+242">242</option> <!-- Republic of the Congo -->
                                                <option value="+243">243</option>
                                                <!-- Democratic Republic of the Congo -->
                                                <option value="+244">244</option> <!-- Angola -->
                                                <option value="+245">245</option> <!-- Guinea-Bissau -->
                                                <option value="+246">246</option> <!-- British Indian Ocean Territory -->
                                                <option value="+248">248</option> <!-- Seychelles -->
                                                <option value="+249">249</option> <!-- Sudan -->
                                                <option value="+250">250</option> <!-- Rwanda -->
                                                <option value="+251">251</option> <!-- Ethiopia -->
                                                <option value="+252">252</option> <!-- Somalia -->
                                                <option value="+253">253</option> <!-- Djibouti -->
                                                <option value="+254">254</option> <!-- Kenya -->
                                                <option value="+255">255</option> <!-- Tanzania -->
                                                <option value="+256">256</option> <!-- Uganda -->
                                                <option value="+257">257</option> <!-- Burundi -->
                                                <option value="+258">258</option> <!-- Mozambique -->
                                                <option value="+260">260</option> <!-- Zambia -->
                                                <option value="+261">261</option> <!-- Madagascar -->
                                                <option value="+262">262</option> <!-- Reunion -->
                                                <option value="+263">263</option> <!-- Zimbabwe -->
                                                <option value="+264">264</option> <!-- Namibia -->
                                                <option value="+265">265</option> <!-- Malawi -->
                                                <option value="+266">266</option> <!-- Lesotho -->
                                                <option value="+267">267</option> <!-- Botswana -->
                                                <option value="+268">268</option> <!-- Eswatini (Swaziland) -->
                                                <option value="+269">269</option> <!-- Comoros -->
                                                <option value="+290">290</option> <!-- Saint Helena -->
                                                <option value="+291">291</option> <!-- Eritrea -->
                                                <option value="+297">297</option> <!-- Aruba -->
                                                <option value="+298">298</option> <!-- Faroe Islands -->
                                                <option value="+299">299</option> <!-- Greenland -->
                                                <option value="+350">350</option> <!-- Gibraltar -->
                                                <option value="+351">351</option> <!-- Portugal -->
                                                <option value="+352">352</option> <!-- Luxembourg -->
                                                <option value="+353">353</option> <!-- Ireland -->
                                                <option value="+354">354</option> <!-- Iceland -->
                                                <option value="+355">355</option> <!-- Albania -->
                                                <option value="+356">356</option> <!-- Malta -->
                                                <option value="+357">357</option> <!-- Cyprus -->
                                                <option value="+358">358</option> <!-- Finland -->
                                                <option value="+359">359</option> <!-- Bulgaria -->
                                                <option value="+370">370</option> <!-- Lithuania -->
                                                <option value="+371">371</option> <!-- Latvia -->
                                                <option value="+372">372</option> <!-- Estonia -->
                                                <option value="+373">373</option> <!-- Moldova -->
                                                <option value="+374">374</option> <!-- Armenia -->
                                                <option value="+375">375</option> <!-- Belarus -->
                                                <option value="+376">376</option> <!-- Andorra -->
                                                <option value="+377">377</option> <!-- Monaco -->
                                                <option value="+378">378</option> <!-- San Marino -->
                                                <option value="+379">379</option> <!-- Vatican City -->
                                                <option value="+380">380</option> <!-- Ukraine -->
                                                <option value="+381">381</option> <!-- Serbia -->
                                                <option value="+382">382</option> <!-- Montenegro -->
                                                <option value="+383">383</option> <!-- Kosovo -->
                                                <option value="+385">385</option> <!-- Croatia -->
                                                <option value="+386">386</option> <!-- Slovenia -->
                                                <option value="+387">387</option> <!-- Bosnia and Herzegovina -->
                                                <option value="+389">389</option> <!-- North Macedonia -->
                                                <option value="+420">420</option> <!-- Czech Republic -->
                                                <option value="+421">421</option> <!-- Slovakia -->
                                                <option value="+423">423</option> <!-- Liechtenstein -->
                                                <option value="+500">500</option> <!-- Falkland Islands -->
                                                <option value="+501">501</option> <!-- Belize -->
                                                <option value="+502">502</option> <!-- Guatemala -->
                                                <option value="+503">503</option> <!-- El Salvador -->
                                                <option value="+504">504</option> <!-- Honduras -->
                                                <option value="+505">505</option> <!-- Nicaragua -->
                                                <option value="+506">506</option> <!-- Costa Rica -->
                                                <option value="+507">507</option> <!-- Panama -->
                                                <option value="+508">508</option> <!-- Saint Pierre and Miquelon -->
                                                <option value="+509">509</option> <!-- Haiti -->
                                                <option value="+590">590</option> <!-- Guadeloupe -->
                                                <option value="+591">591</option> <!-- Bolivia -->
                                                <option value="+592">592</option> <!-- Guyana -->
                                                <option value="+593">593</option> <!-- Ecuador -->
                                                <option value="+594">594</option> <!-- French Guiana -->
                                                <option value="+595">595</option> <!-- Paraguay -->
                                                <option value="+596">596</option> <!-- Martinique -->
                                                <option value="+597">597</option> <!-- Suriname -->
                                                <option value="+598">598</option> <!-- Uruguay -->
                                                <option value="+599">599</option> <!-- Curaçao, Caribbean Netherlands -->
                                                <option value="+670">670</option> <!-- East Timor -->
                                                <option value="+672">672</option>
                                                <!-- Antarctica, Australian External Territories -->
                                                <option value="+673">673</option> <!-- Brunei -->
                                                <option value="+674">674</option> <!-- Nauru -->
                                                <option value="+675">675</option> <!-- Papua New Guinea -->
                                                <option value="+676">676</option> <!-- Tonga -->
                                                <option value="+677">677</option> <!-- Solomon Islands -->
                                                <option value="+678">678</option> <!-- Vanuatu -->
                                                <option value="+679">679</option> <!-- Fiji -->
                                                <option value="+680">680</option> <!-- Palau -->
                                                <option value="+681">681</option> <!-- Wallis and Futuna -->
                                                <option value="+682">682</option> <!-- Cook Islands -->
                                                <option value="+683">683</option> <!-- Niue -->
                                                <option value="+685">685</option> <!-- Samoa -->
                                                <option value="+686">686</option> <!-- Kiribati -->
                                                <option value="+687">687</option> <!-- New Caledonia -->
                                                <option value="+688">688</option> <!-- Tuvalu -->
                                                <option value="+689">689</option> <!-- French Polynesia -->
                                                <option value="+690">690</option> <!-- Tokelau -->
                                                <option value="+691">691</option> <!-- Micronesia -->
                                                <option value="+692">692</option> <!-- Marshall Islands -->
                                                <option value="+850">850</option> <!-- North Korea -->
                                                <option value="+852">852</option> <!-- Hong Kong -->
                                                <option value="+853">853</option> <!-- Macau -->
                                                <option value="+855">855</option> <!-- Cambodia -->
                                                <option value="+856">856</option> <!-- Laos -->
                                                <option value="+880">880</option> <!-- Bangladesh -->
                                                <option value="+886">886</option> <!-- Taiwan -->
                                                <option value="+960">960</option> <!-- Maldives -->
                                                <option value="+961">961</option> <!-- Lebanon -->
                                                <option value="+962">962</option> <!-- Jordan -->
                                                <option value="+963">963</option> <!-- Syria -->
                                                <option value="+964">964</option> <!-- Iraq -->
                                                <option value="+965">965</option> <!-- Kuwait -->
                                                <option value="+966">966</option> <!-- Saudi Arabia -->
                                                <option value="+967">967</option> <!-- Yemen -->
                                                <option value="+968">968</option> <!-- Oman -->
                                                <option value="+970">970</option> <!-- Palestine -->
                                                <option value="+971" selected>971</option> <!-- United Arab Emirates -->
                                                <option value="+972">972</option> <!-- Israel -->
                                                <option value="+973">973</option> <!-- Bahrain -->
                                                <option value="+974">974</option> <!-- Qatar -->
                                                <option value="+975">975</option> <!-- Bhutan -->
                                                <option value="+976">976</option> <!-- Mongolia -->
                                                <option value="+977">977</option> <!-- Nepal -->
                                                <option value="+992">992</option> <!-- Tajikistan -->
                                                <option value="+993">993</option> <!-- Turkmenistan -->
                                                <option value="+994">994</option> <!-- Azerbaijan -->
                                                <option value="+995">995</option> <!-- Georgia -->
                                                <option value="+996">996</option> <!-- Kyrgyzstan -->
                                                <option value="+998">998</option> <!-- Uzbekistan -->
                                            </select>
                                        </span>
                                    </div>
                                    <input type="tel" id="whatsapp" name="whatsapp" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">
                                Email:</label>
                            <div class="input-icon">
                                <img src="{{ URL::asset('front/img/email-id-y.png') }}" alt="">
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group dropdown-container">
                            <label for="quantity" class="required">Quantity:</label>
                            <div class="input-icon">
                                <img src="{{ URL::asset('front/img/quantity-y.png') }}" alt="">
                                <select name="qty" id="">
                                    <option value="1">1 - {{ $product->price }} AED</option>
                                    <option value="2">2 - {{ 2 * $product->price }} AED</option>
                                    <option value="3">3 - {{ 3 * $product->price }} AED</option>
                                    <option value="4">4 - {{ 4 * $product->price }} AED</option>
                                    <option value="5">5 - {{ 5 * $product->price }} AED</option>
                                    <option value="6">6 - {{ 6 * $product->price }} AED</option>
                                    <option value="7">7 - {{ 7 * $product->price }} AED</option>
                                    <option value="8">8 - {{ 8 * $product->price }} AED</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group dropdown-container">
                            <label for="region" class="required">Emirates:</label>
                            <div class="input-icon">
                                <img src="{{ URL::asset('front/img/emirate-location-y.png') }}" alt="">
                                <select name="city" id="city" onchange="saveMissingData()">
                                    <option value="">-- Select Emirate --</option>
                                    <option value="DUBAI">DUBAI
                                    </option>
                                    <option value="ABU DHABI">ABU DHABI
                                    </option>
                                    <option value="SHARJAH">SHARJAH
                                    </option>
                                    <option value="AJMAN">AJMAN
                                    </option>
                                    <option value="RAK">RAK
                                    </option>
                                    <option value="FUJAIRAH">FUJAIRAH
                                    </option>
                                    <option value="UMM AL QUWAIN">UMM AL QUWAIN
                                    </option>
                                    <option value="AL AIN">AL AIN
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="maped-label"><span class="required">Delivery
                                    Address:</span>
                                <div class="deliverto">
                                    <div class="deliver-trigger">
                                        <svg class="location-icon" class="w-6 h-6 text-gray-800 dark:text-white"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                        </svg>

                                        <p>Deliver to <span>Dubai</span> <img class="down" src="img/dropdown.png" alt>
                                        </p>
                                    </div>
                                </div>
                            </label>
                            <div class="delivery_map_container">
                                <div class="close">
                                    <h5>Select Delivery Address</h5><Button class="deliver-close"><svg
                                            class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                    </Button>
                                </div>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3605.80663850776!2d55.38899557611973!3d25.34426872572677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5d61f759fefb%3A0x3dda6f86e7d1f82e!2sWinsCart-UAE!5e0!3m2!1sen!2s!4v1702382451269!5m2!1sen!2s"
                                    width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <div class="bottom-button">
                                    <button>Confirm Location</button>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const deliverTrigger = document.querySelector('.deliver-trigger');
                                    const deliveryMapContainer = document.querySelector('.delivery_map_container');
                                    const deliverClose = document.querySelector('.deliver-close');

                                    deliverTrigger.addEventListener('click', function() {
                                        deliveryMapContainer.classList.add('show');
                                    });

                                    deliverClose.addEventListener('click', function() {
                                        deliveryMapContainer.classList.remove('show');
                                    });
                                });
                            </script>
                            <textarea id="address" name="address" rows="4" required
                                placeholder="Flat No, Building Name, Street, Landmark etc.."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="">Comment:</label>
                            <input type="text" id="comment" name="comment" rows="1"
                                placeholder="Mention if anything specific">
                        </div>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="gateway" name="payment_method" value="gateway">
                                <label for="gateway">Online Payment</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="cod" name="payment_method" value="cod" checked>
                                <label for="cod">Cash on Delivery</label>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <button type="submit">Purchase</button>
                    </div>
                    <div class="form-group">
                        <a href="https://wa.me/971586583113?text=I%20want%20to%20buy%20this%20product%20https://uae.winscart.com/product/{{ encryptNumber($product->id) }}"
                            class="whatsapp-btn" target="_blank">
                            <img src="https://uae.winscart.com/front/img/whatsapp.png" alt=""
                                style="width :30px">
                            Order On
                            Whatsapp
                        </a>
                    </div>

                    <div class="pad-top-50">
                        <h4>In stock</h4>
                    </div>
                </form>
                <div id="successMessage" style="display: none; background-color: #fdb916; padding: 10px">Purchase
                    successful!</div>
            </div>

        </div>
    </div>


    <section>
        <div class="card-wrapper desc-style">
            <div class="row">
                <div class="col-12">
                    <div class="tab">
                        <button class="tablinks active" onclick="openTab(event, 'description')">Description</button>
                        <button class="tablinks" onclick="openTab(event, 'review')">Review</button>
                    </div>
                    <div id="description" class="tabcontent" style="display: block;">
                        {!! $product->description !!}
                    </div>
                    {{-- <div id="review" class="tabcontent">
                    <p>"\m ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!----------Product 1   -------->
    <section class="bun " id="bun">
        <h2 style="text-align: center">RELATED PRODUCTS</h2>

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
    <style>
        .dropdown-container {
            margin: 20px 0;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            font-size: 16px;
            color: #333;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="%23333" d="M14.348 8.348a.5.5 0 0 1 .043.707l-4 4.5a.5.5 0 0 1-.742 0l-4-4.5a.5.5 0 1 1 .742-.707L10 12.293l3.557-3.965a.5.5 0 0 1 .707-.04l.084.06z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            background-size: 16px 16px;
        }

        select:focus {
            border-color: #66afe9;
            outline: none;
            box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
        }

        .radio-group {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .radio-item {
            display: flex;
            align-items: center;
            margin: 0 10px;
        }

        .radio-item input[type="radio"] {
            display: none;
        }

        .radio-item label {
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            user-select: none;
            color: #333;
        }

        .radio-item label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 50%;
            background: #fff;
            transition: all 0.3s ease;
        }

        .radio-item input[type="radio"]:checked+label::before {
            border-color: #F9AF3B;
            background-color: #F9AF3B;
        }

        .radio-item label::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 50%;
            transform: translateY(-50%) scale(0);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #fff;
            transition: transform 0.3s ease;
        }

        .radio-item input[type="radio"]:checked+label::after {
            transform: translateY(-50%) scale(1);
        }

        .whatsapp-btn {
            background-color: #25D366;
            color: white;
            border-radius: 25px;
            padding: 12px;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            width: auto;
            /* Default width for larger screens */
        }

        .whatsapp-btn i {
            margin-right: 8px;
        }

        /* Media query for mobile devices */
        @media (max-width: 768px) {
            .whatsapp-btn {
                width: 100%;
                /* Full width on mobile devices */
                padding: 8px;
                margin-left: 5px
                    /* Adjust padding for mobile */
            }
        }
    </style>
    <script>
        document.getElementById("phone").addEventListener("input", function() {
            const phoneInput = this.value;
            const errorMessage = document.getElementById("error-message");

            // Regex to match numbers without a leading '0' and exactly 9 digits
            const validPhonePattern = /^[1-9]\d{8}$/;

            if (!validPhonePattern.test(phoneInput)) {
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

        function saveMissingData() {
            const nameInput = document.getElementById("name");
            const phoneInput = document.getElementById("phone");
            const whatsappInput = document.getElementById("whatsapp");
            const cityInput = document.getElementById("city");
            const product = document.getElementById("product_id");


            if (!nameInput || !phoneInput || !cityInput || !product) {
                console.log(nameInput, phoneInput, cityInput);
                console.error("One or more form fields are missing.");
                return;
            }

            const name = nameInput.value;
            const phone = phoneInput.value;
            const city = cityInput.value;
            const whatsapp = whatsappInput.value;
            const product_id = product.value;

            axios.post('/add_missing_order', {
                    name,
                    phone,
                    city,
                    product_id,
                    whatsapp
                })
                .then(response => console.log("Data saved successfully:", response.data))
                .catch(error => console.error("There was an error saving the data:", error));
        }
    </script>
    <!----------Product 1   -------->
@endsection
