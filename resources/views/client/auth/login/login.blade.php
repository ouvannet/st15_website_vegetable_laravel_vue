@extends('client.layouts.app')

@section('title', 'Home Page')

@section('content')
    <div id="app">
        @include('client.auth.login.components.form')
    </div>
    <script type="module">
                const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        email:'client@gmail.com',
                        password:'123'
                    }
                });
                const formAdd=ref(sampleData.value.formAdd)
                const handleSubmitAdd=async()=>{
                    const {data} = await axios.post('/client/login/login',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    if(data){
                        window.location.replace("/client/profile");
                    }
                    formAdd.value=sampleData.value.formAdd;
                }
                return {
                    formAdd,
                    handleSubmitAdd
                };
            }
        }).mount('#app');
    </script>
@endsection

