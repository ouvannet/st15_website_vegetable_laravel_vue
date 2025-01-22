@extends('client.layouts.app')

@section('title', 'Checkout Page')

@section('content')
    <div id="app">
        @include('client.checkout.components.slide')
        @include('client.checkout.components.billing')
        @include('client.checkout.components.subscribe')
    </div>
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataPaymentMethod=ref([]);
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
                    fetchData('/client/checkout/list').then(data => {dataPaymentMethod.value=data;});
                }
                getList();
                return {
                    baseUrl,
                    dataPaymentMethod
                };
            }
        }).mount('#app');
    </script>
@endsection
