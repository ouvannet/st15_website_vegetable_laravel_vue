@extends('client.layouts.app')

@section('title', 'Home Page')

@section('content')
    <div id="app">
        @include('client.auth.register.components.form')
    </div>
    <script type="module">
                const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        username:'',
                        email:'',
                        password:'',
                        full_name:'vannet',
                        gender:'male',
                        phone:'01234567',
                        address:'pp',
                        role_id:4,
                        image_url:''
                    }
                });
                const formAdd=ref(sampleData.value.formAdd)
                const handleSubmitAdd=async()=>{
                    const {data} = await axios.post('/client/register/submit',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    if(data){
                        window.location.replace("/client/login");
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

