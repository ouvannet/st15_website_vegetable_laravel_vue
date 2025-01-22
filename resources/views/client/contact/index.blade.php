@extends('client.layouts.app')

@section('title', 'Contact Page')

@section('content')
    <div id="app">
        @include('client.contact.components.slide')
        @include('client.contact.components.info')
    </div>
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataContact=ref({});
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
                    fetchData('/client/contact/list').then(data => {
                        dataContact.value = data;
                    })
                }
                getList();
                return {
                    baseUrl,
                    dataContact
                };
            }
        }).mount('#app');
    </script>
@endsection
