@extends('client.layouts.app')

@section('title', 'Single Item Page')

@section('content')
    <div id="app">
        @include('client.single_product.components.slide')
        @include('client.single_product.components.item_info')
        @include('client.single_product.components.related_products')
        @include('client.components.page.subscribe')
    </div>
    <script type="module">
        const { createApp, ref } = Vue;
        import { CacheManager } from "/client/js/cache.js";
        const cartManager = new CacheManager('cart');
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataProduct=ref({});
                const dataProducts=ref([]);
                const stockAvailable=ref(0);
                let is_inCart=ref(false);
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
                    fetchData('/client/products/byid',{'product_id':"{{$product_id}}"}).then(data => {
                        dataProduct.value = data;
                        checkExistCart(data);
                        stockAvailable.value=data.stock_quantity;
                        fetchData('/client/products/bycategory',{'category_id':data.category_id}).then(data => dataProducts.value = data);
                    })
                }
                getList();
                const clickCart=(data)=>{
                    cartManager.addData(data);
                    checkExistCart(data);
                }
                const checkExistCart=(data)=>{
                    is_inCart.value=cartManager.checkExist(data);
                }

                return {
                    baseUrl,
                    dataProduct,
                    dataProducts,
                    stockAvailable,
                    clickCart,
                    is_inCart
                };
            }
        }).mount('#app');
    </script>
@endsection
