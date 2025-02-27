@extends('client.layouts.app')

@section('title', 'Checkout Page')

@section('content')
    <div id="app">
        <script ssrc="https://unpkg.com/@tailwindcss/browser@4"></script>
        @include('client.checkout.components.slide')
        @include('client.checkout.components.billing')
        @include('client.checkout.components.subscribe')
        @include('client.checkout.components.receipt')
    </div>
    <script type="module">
        const { createApp, ref } = Vue;
        import { CacheManager } from "/client/js/cache.js";
        const cartManager = new CacheManager('cart');
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const billingDetails=ref({
                    firstName:'',
                    lastName:'',
                    country:'',
                    street:'',
                    city:'',
                    postCode:'',
                    phone:'',
                    email:''
                });
                const dataCart=ref({});
                const subTotal=ref(0);
                const totalDelivery=ref(0);
                const totalDiscount=ref(0);
                const dataPaymentMethod=ref([]);
                const dataContact=ref({});
                const getFormattedDate=()=> {
                    const now = new Date();
                    const day = String(now.getDate()).padStart(2, '0');
                    const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                    const year = now.getFullYear();
                    return `${day}/${month}/${year}`;
                }
                const getCart=()=>{
                    dataCart.value=cartManager.getList();
                    console.log(dataCart.value);

                    Object.entries(dataCart.value).forEach(([key, ele]) => {
                        subTotal.value+=(ele.base_price*ele.qty);
                    });
                }
                getCart();
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
                    fetchData('/client/contact/list').then(data => {
                        dataContact.value = data;
                    })
                }
                getList();
                return {
                    baseUrl,
                    getFormattedDate,
                    dataContact,
                    dataCart,
                    dataPaymentMethod,
                    subTotal,
                    totalDelivery,
                    totalDiscount,
                    billingDetails
                };
            }
        }).mount('#app');
    </script>
@endsection
