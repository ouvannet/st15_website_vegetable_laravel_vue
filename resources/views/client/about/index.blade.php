@extends('client.layouts.app')

@section('title', 'About Page')

@section('content')
    <div id="app">
        @include('client.about.components.slide')
        @include('client.about.components.video')
        @include('client.components.page.subscribe')
        @include('client.about.components.small_report')
        @include('client.components.page.feedback_customer')
        @include('client.components.page.service')
    </div>
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataCustomerFeedback=ref([]);
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
                    fetchData('/client/general/list_customer_feedback').then(data => dataCustomerFeedback.value = data);
                }
                getList();
                return {
                    baseUrl,
                    dataCustomerFeedback,
                };
            }
        }).mount('#app');
    </script>
@endsection
