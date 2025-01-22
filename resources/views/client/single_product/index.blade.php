@extends('client.layouts.app')

@section('title', 'Single Item Page')

@section('content')
    <div id="app">
        @include('client.single_product.components.slide')
        @include('client.single_product.components.item_info')
        @include('client.single_product.components.related_products')
        @include('client.components.page.subscribe')
    </div>
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataProduct=ref({});
                const dataProducts=ref([]);
                const stockAvailable=ref(0);
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
                        stockAvailable.value=data.variants[0].quantity_in_base_unit;
                        fetchData('/client/products/bycategory',{'category_id':data.category_id}).then(data => dataProducts.value = data);
                    })
                    // fetchData('/client/general/list_customer_feedback').then(data => dataCustomerFeedback.value = data);
                    // fetchData('/client/general/list_logo_client').then(data => dataLogoClient.value = data);
                }
                getList();
                return {
                    baseUrl,
                    dataProduct,
                    dataProducts,
                    stockAvailable
                };
            }
        }).mount('#app');
    </script>
@endsection
