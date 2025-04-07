<?php
$client=[];
try {
    session_start();
    $client=session('client_data');
} catch (\Throwable $th) {}
// var_dump($client);
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="/client/home">Vegefoods</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav" style="visibility: visible;">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ Route::getCurrentRoute()->uri==('client/home') ? 'active' : '' }}">
                <a href="{{ url('/client/home') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item dropdown {{ Route::getCurrentRoute()->uri==('client/shop') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="{{ url('/client/shop') }}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item {{ Route::getCurrentRoute()->uri==('client/shop') ? 'active' : '' }}" href="{{ url('/client/shop') }}">Shop</a>
                    <a class="dropdown-item {{ Route::getCurrentRoute()->uri==('client/wishlist') ? 'active' : '' }}" href="{{ url('/client/wishlist') }}">Wishlist</a>
                    <a class="dropdown-item {{ Route::getCurrentRoute()->uri==('client/cart') ? 'active' : '' }}" href="{{ url('/client/cart') }}">Cart</a>
                    <a class="dropdown-item {{ Route::getCurrentRoute()->uri==('client/checkout') ? 'active' : '' }}" href="{{ url('/client/checkout') }}">Checkout</a>
                </div>
            </li>
            <li class="nav-item {{ Route::getCurrentRoute()->uri==('client/about') ? 'active' : '' }}">
                <a href="{{ url('/client/about') }}" class="nav-link">About</a>
            </li>
            <li class="nav-item {{ Route::getCurrentRoute()->uri==('client/blog') ? 'active' : '' }}">
                <a href="{{ url('/client/blog') }}" class="nav-link">Blog</a>
            </li>
            <li class="nav-item {{ Route::getCurrentRoute()->uri==('client/contact') ? 'active' : '' }}">
                <a href="{{ url('/client/contact') }}" class="nav-link">Contact</a>
            </li>
            <li id="app2" class="nav-item cta cta-colored {{ Route::getCurrentRoute()->uri==('client/cart') ? 'active' : '' }}">
                <a href="{{ url('/client/cart') }}" class="nav-link">
                    <span class="icon-shopping_cart"></span>
                    [@{{ countDataCart.length }}]
                </a>
            </li>
            <li id="app2" class="nav-item cta cta-colored">
                <a href="{{ $client?url('/client/cart'):url('/client/login') }}" class="nav-link">
                    <img src="https://cdn-icons-png.flaticon.com/128/1077/1077114.png" style="width:15px;">
                </a>
            </li>
        </ul>
      </div>
    </div>
</nav>
<script type="module">
    const { createApp, ref } = Vue;
    import { CacheManager } from "/client/js/cache.js";
    const cartManager = new CacheManager('cart');
    createApp({
        setup() {
            const baseUrl= "{{ asset('') }}";
            var countDataCart=ref([]);
            const getCart=()=>{
                countDataCart.value=Object.keys(cartManager.getList());
            }
            setInterval(() => {
                getCart();
            }, 500);
            return {
                countDataCart
            };
        }
    }).mount('#app2');
</script>
