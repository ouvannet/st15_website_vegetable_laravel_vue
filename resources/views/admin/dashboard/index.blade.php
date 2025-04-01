@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('js')
	<script src="/admin/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
	<script src="/admin/assets/js/demo/dashboard.demo.js"></script>
@endpush

@section('content')

    @include('admin.dashboard.components.section1')
	<!-- BEGIN row -->
	<div class="row">
		@include('admin.dashboard.components.bestseller')
		@include('admin.dashboard.components.transaction')
	</div>
	<!-- END row -->
@endsection

@push('js')
    <script>
        const { createApp, ref, onMounted } = Vue;
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataTable=ref([]);
                const getList=async()=>{
                    const {data} = await axios.post('/admin/dashboard/bestseller',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    dataTable.value=data;
                }
                getList();
                return {
                    baseUrl,
                    dataTable
                };
            }
        }).mount('#app');
    </script>
@endpush
