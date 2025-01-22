@extends('client.layouts.app')

@section('title', 'Shop Page')

@section('content')
    <div id="app">
        @include('client.shop.components.slide')
        @include('client.shop.components.list_product')
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
                const currentCategory=ref(0);
                const dataProducts=ref([]);
                const currentPage=ref(1);
                const lastPage=ref(1);
                const dataPagenation=ref([]);
                const dataCategory=ref([]);
                const fetchData = async (url,param={}) => {
                    try {
                        const { data } = await axios.post(url, param, { headers: { 'Content-Type': 'multipart/form-data' } });
                        return data;
                    } catch (error) {
                        console.error(error);
                        return [];
                    }
                };
                const getList=async()=>{
                    fetchData('/client/category/list').then(data => {dataCategory.value = data;});
                }
                function isNumber(value) {
                    return typeof value === 'number' && !isNaN(value);
                }
                const getProductList=async(page = 1,category=0)=>{
                    try {
                        const response = await axios.get(isNumber(page)?`/client/products/datatable?page=${page}&category=${category}`:page+`&category=${category}`);
                        dataProducts.value = response.data.data;
                        currentPage.value = response.data.current_page;
                        currentCategory.value=category;
                        lastPage.value = response.data.last_page;
                        dataPagenation.value=response.data.links;
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                }
                getList();
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
                    currentPage,
                    currentCategory,
                    dataProducts,
                    dataPagenation,
                    getProductList,
                    dataCategory,
                    clickWishlist,
                    checkExistWishlist,
                    clickCart,
                    checkExistCart
                };
            }
        }).mount('#app');
    </script>
@endsection
