@extends('client.layouts.app')

@section('title', 'Wishlist Page')

@section('content')
    <div id="app">
        @include('client.wishlist.components.slide')
        @include('client.wishlist.components.items_list')
        @include('client.components.page.subscribe')
    </div>
    <script type="module">
        const { createApp, ref } = Vue;
        import { CacheManager } from "/client/js/cache.js";
        const wishlistManager = new CacheManager('wishlist');
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataWishlist=ref({});
                const getWishlist=()=>{
                    dataWishlist.value=wishlistManager.getList();
                }
                getWishlist();
                const removeWishlist=(index)=>{
                    wishlistManager.removeData(index);
                    getWishlist();
                }
                const increaseQty=(index)=>{
                    wishlistManager.increaseQty(index);
                    getWishlist();
                }
                const decreaseQty=(index)=>{
                    wishlistManager.decreaseQty(index);
                    getWishlist();
                }

                return {
                    baseUrl,
                    dataWishlist,
                    removeWishlist,
                    increaseQty,
                    decreaseQty
                };
            }
        }).mount('#app');
    </script>
@endsection
