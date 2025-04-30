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
                            {
                                data: 'payment_status',
                                render: function(data, type, row) {
                                    const statuses = ['Pending', 'Completed', 'Failed']; // adjust these as per your app
                                    let select = `<select class="form-select form-select-sm payment-status" data-id="${row.id}">`;
                                    statuses.forEach(status => {
                                        select += `<option value="${status.toLowerCase()}" ${data === status.toLowerCase() ? 'selected' : ''}>${status.toLowerCase()}</option>`;
                                    });
                                    select += `</select>`;
                                    return select;
                                }
                            },
                            {
                                data: 'order_status',
                                render: function(data, type, row) {
                                    const statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
                                    let select = `<select class="form-select form-select-sm order-status" data-id="${row.id}">`;
                                    statuses.forEach(status => {
                                        select += `<option value="${status.toLowerCase()}" ${data === status.toLowerCase() ? 'selected' : ''}>${status.toLowerCase()}</option>`;
                                    });
                                    select += `</select>`;
                                    return select;
                                }
                            },
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
                    $('#productsTable tbody').on('change', '.order-status', function () {
                        const orderId = $(this).data('id');
                        const newStatus = $(this).val();
                        $.ajax({
                            url: `/admin/sale/updatestatus`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                status: newStatus,
                                id:orderId
                            },
                            success: function (res) {
                                // alert('Order status updated!');
                            },
                            error: function (err) {
                                // alert('Failed to update status.');
                            }
                        });
                    });
                    $('#productsTable tbody').on('change', '.payment-status', function () {
                        const orderId = $(this).data('id');
                        const newStatus = $(this).val();
                        $.ajax({
                            url: `/admin/sale/updatepaymentstatus`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                payment_status: newStatus,
                                id: orderId
                            },
                            success: function (res) {
                                // alert('Payment status updated!');
                            },
                            error: function (err) {
                                // alert('Failed to update payment status.');
                            }
                        });
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
