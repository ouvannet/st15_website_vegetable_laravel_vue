@extends('client.layouts.app')

@section('title', 'Cart Page')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div id="app">
        @include('client.cart.components.slide')
        @include('client.cart.components.items_list')
        @include('client.components.page.subscribe')
    </div>
    <script type="module">
        const { createApp, ref } = Vue;
        import { CacheManager } from "/client/js/cache.js";
        const cartManager = new CacheManager('cart');
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataCart=ref({});
                const subTotal=ref(0);
                const totalDelivery=ref(0);
                const totalDiscount=ref(0);
                const getCart=()=>{
                    dataCart.value=cartManager.getList();
                    subTotal.value=0;
                    Object.entries(dataCart.value).forEach(([key, ele]) => {
                        subTotal.value+=(ele.base_price*ele.qty);
                    });
                }
                console.log(dataCart);

                getCart();
                const removeCart=(index)=>{
                    cartManager.removeData(index);
                    getCart();
                }
                const updateQty=(index,qty)=>{
                    if(!cartManager.editQty(index,qty)){
                        Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "you can't add more",
                        showConfirmButton: false,
                        timer: 1500
                        });
                    }
                    getCart();

                }
                const increaseQty=(index)=>{
                    if(!cartManager.increaseQty(index)){
                        Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "you can't add more",
                        showConfirmButton: false,
                        timer: 1500
                        });
                    }
                    getCart();
                }
                const decreaseQty=(index)=>{
                    cartManager.decreaseQty(index);
                    getCart();
                }

                return {
                    baseUrl,
                    dataCart,
                    subTotal,
                    totalDelivery,
                    totalDiscount,
                    removeCart,
                    updateQty,
                    increaseQty,
                    decreaseQty
                };
            }
        }).mount('#app');
    </script>
@endsection
