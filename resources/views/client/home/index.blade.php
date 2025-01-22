@extends('client.layouts.app')

@section('title', 'Home Page')

@section('content')
    <div id="app">
        @include('client.home.components.slide')
        @include('client.components.page.service')
        @include('client.home.components.category')
        @include('client.home.components.products')
        @include('client.home.components.best_price')
        @include('client.components.page.feedback_customer')
        @include('client.home.components.logo_client')
        @include('client.components.page.subscribe')
    </div>
    <script type="module">
        const { createApp, ref } = Vue;
        import { CacheManager } from "/client/js/cache.js";
        const wishlistManager = new CacheManager('wishlist');
        const cartManager = new CacheManager('cart');
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataCategory=ref([]);
                const dataCategory2=ref([]);
                const dataProducts=ref([]);
                const dataCustomerFeedback=ref([]);
                const dataLogoClient=ref([]);
                const fetchData = async (url) => {
                    try {
                        const { data } = await axios.post(url, {}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        return data;
                    } catch (error) {
                        console.error(error);
                        return [];
                    }
                };
                const getList=async()=>{
                    fetchData('/client/category/list').then(data => {dataCategory.value = data.slice(0,2);dataCategory2.value = data.slice(2);});

                    fetchData('/client/general/list_customer_feedback').then(data => dataCustomerFeedback.value = data);
                    fetchData('/client/general/list_logo_client').then(data => dataLogoClient.value = data);
                }
                getList();
                const getProductList=async()=>{
                    fetchData('/client/products/list').then(data => dataProducts.value = data);
                }
                getProductList();
                const clickWishlist=(data)=>{
                    wishlistManager.addData(data);
                    getProductList();
                }
                const checkExistWishlist=(data)=>{
                    return wishlistManager.checkExist(data);
                }
                const clickCart=(data)=>{
                    cartManager.addData(data);
                    getProductList();
                }
                const checkExistCart=(data)=>{
                    return cartManager.checkExist(data);
                }
                return {
                    baseUrl,
                    dataCategory,
                    dataCategory2,
                    dataProducts,
                    dataCustomerFeedback,
                    dataLogoClient,
                    clickWishlist,
                    checkExistWishlist,
                    clickCart,
                    checkExistCart
                };
            }
        }).mount('#app');
    </script>
@endsection
