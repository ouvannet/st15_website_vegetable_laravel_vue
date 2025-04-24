@extends('client.layouts.app')

@section('title', 'Cart Page')

@section('content')
    <div id="app">
        @include('client.profile.components.items_list')
    </div>
    <script type="module">
        const { createApp, ref } = Vue;
        import { CacheManager } from "/client/js/cache.js";
        const cartManager = new CacheManager('cart');
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataSale=ref({});
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
                    fetchData('/client/checkout/list').then(data => {dataSale.value=data;});
                }
                getList();
                return {
                    baseUrl,
                    dataSale
                };
            }
        }).mount('#app');
    </script>
@endsection
