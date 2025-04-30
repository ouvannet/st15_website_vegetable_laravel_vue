@extends('client.layouts.app')

@section('title', 'Cart Page')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    fetchData('/client/profile/list').then(data => {dataSale.value=data;});
                }
                getList();
                const viewINV=(dataInv)=>{
                    const isoDate = dataInv.user.created_at;
                    const date = new Date(isoDate);

                    const formattedDate = date.toLocaleString("en-US", {
                    year: "numeric",
                    month: "long",
                    day: "2-digit",
                    });
                    Swal.fire({
                        position:'top',
                        width: 700,
                        html: `
                            <div id="inv_data" class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm my-6" id="invoice" style="">
                                <div class="grid grid-cols-2 items-center">
                                    <div>
                                        <a class="navbar-brand">Vegefoods</a>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-500 text-sm">
                                            ${dataInv.user.email}
                                        </p>
                                        <p class="text-gray-500 text-sm mt-1">
                                        ${dataInv.user.phone}
                                        </p>
                                    </div>
                                </div>
                                <!-- Client info -->
                                <div class="grid grid-cols-2 items-center mt-8">
                                    <div style="text-align: left;">
                                        <p class="font-bold text-gray-800 m-0">
                                            <span style="font-weight: bold;">Bill to :</span> ${dataInv.user.full_name} ${dataInv.user.full_name}
                                        </p>
                                        <p class="text-gray-500 m-0">
                                            <span style="font-weight: bold;">Address :</span> ${dataInv.user.address}
                                        </p>
                                        <p class="text-gray-500">
                                            <span style="font-weight: bold;">Email :</span> ${dataInv.user.email}
                                            <br>
                                            <span style="font-weight: bold;">Phone :</span> ${dataInv.user.phone}
                                        </p>
                                    </div>

                                    <div class="text-right">
                                        <p class="">
                                            <span style="font-weight: bold;">Invoice number :</span> <span class="text-gray-500">INV-2023786123</span>
                                        </p>
                                        <p>
                                            <span style="font-weight: bold;">Invoice date :</span> <span class="text-gray-500">${formattedDate}</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Invoice Items -->
                                <div class="-mx-4 mt-8 flow-root sm:mx-0">
                                    <table class="w-full" style="width:100%;" >
                                        <tfoot>
                                        <tr>
                                            <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Subtotal</th>
                                            <th scope="row" class="pl-6 pr-3 pt-6 text-left text-sm font-normal text-gray-500 sm:hidden">Subtotal</th>
                                            <td class="pl-3 pr-6 pt-6 text-right text-sm text-gray-500 sm:pr-0">${dataInv.total_amount}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Delivery</th>
                                            <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">Delivery</th>
                                            <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">$0.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Discount</th>
                                            <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">Discount</th>
                                            <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">$0.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:table-cell sm:pl-0">Total</th>
                                            <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-semibold text-gray-900 sm:hidden">Total</th>
                                            <td class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">$${dataInv.total_amount}</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        `,
                        showConfirmButton: false,
                    });
                }
                return {
                    baseUrl,
                    dataSale,
                    viewINV
                };
            }
        }).mount('#app');
    </script>
@endsection
