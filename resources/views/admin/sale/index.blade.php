@extends('admin.layouts.app')

@section('title', 'Sale')

@push('js')
    <script src="/admin/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/admin/assets/js/demo/dashboard.demo.js"></script>
@endpush

@section('content')
    <div id="userTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <div style="display:flex;align-items: center;justify-content: space-between;">
                    <h5 class="mb-3 fw-bold">Sale List</h5>
                    {{-- <button type="button" class="btn btn-primary mb-3" id="btn_add_user">
                        Add Sale
                    </button> --}}
                </div>
                <table id="productsTable" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">INV</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Total</th>
                            <th scope="col">Paid by</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        const { createApp, ref, onMounted } = Vue;
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const initDataTable = () => {
                    const table = $('#productsTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/admin/sale/list',
                            type: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        },
                        columns: [
                            { data: 'id' },
                            { data: 'user.full_name' },
                            { data: 'total_amount' },
                            { data: 'payment_method.name' },
                            { data: 'payment_status' },
                            { data: 'order_status' },
                            { data: 'shipping_address' },
                        ],
                        dom: '<"row"<"col-md-4"l><"col-md-4"B><"col-md-4"f>>' +'<"row"<"col-md-12"tr>>' + '<"row"<"col-md-5"i><"col-md-7"p>>',
                        buttons: [
                            { extend: 'copy', className: 'btn btn-dark btn-sm' },
                            { extend: 'csv', className: 'btn btn-dark btn-sm' },
                            { extend: 'excel', className: 'btn btn-dark btn-sm' },
                            { extend: 'pdf', className: 'btn btn-dark btn-sm' },
                            { extend: 'print', className: 'btn btn-dark btn-sm' }
                        ]
                    });
                };
                onMounted(() => {
                    initDataTable();
                });
                return {
                    baseUrl,
                };
            }
        }).mount('#app');
    </script>
@endpush
