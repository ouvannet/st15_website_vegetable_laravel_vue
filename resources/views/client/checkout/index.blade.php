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
                    firstName:"{{$client['full_name']}}",
                    lastName:"{{$client['full_name']}}",
                    country:'',
                    street:"{{$client['address']}}",
                    city:"{{$client['address']}}",
                    postCode:'',
                    phone:"{{$client['phone']}}",
                    email:"{{$client['email']}}"
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

                const placeAndPayment=async()=>{
                    var bill=billingDetails.value;
                    var dataInv={
                        user_id:"{{$client['id']}}"*1,
                        total_amount:subTotal.value,
                        payment_method_id:"1",
                        shipping_address:`${bill.country} ${bill.street} ${bill.city}`
                    }
                    console.log(dataInv);
                    const {data} = await axios.post('/client/checkout/submitcheckout',dataInv, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    if(data?.id){
                        var saleItem=Object.values(dataCart.value).map((items,index)=>{
                            return {
                                sale_id:data?.id,
                                varient_id:3,
                                quantity:items.qty,
                                price_per_unit:items.base_price*1,
                                total_price:items.qty*items.base_price
                            }
                        })
                        console.log(saleItem);
                        const dataItems = await axios.post('/client/checkout/submitcheckoutitems',saleItem, { headers: { 'Content-Type': 'multipart/form-data' } });
                        console.log(dataItems);
                        if(dataItems){
                            cartManager.removeAllData();
                        }
                    }
                }
                return {
                    baseUrl,
                    getFormattedDate,
                    dataContact,
                    dataCart,
                    dataPaymentMethod,
                    subTotal,
                    totalDelivery,
                    totalDiscount,
                    billingDetails,
                    placeAndPayment
                };
            }
        }).mount('#app');
    </script>
@endsection
