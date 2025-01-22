@extends('admin.layouts.app')

@section('title', 'Cart')

@push('js')
    <script src="/admin/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/admin/assets/js/demo/dashboard.demo.js"></script>
@endpush

@section('content')
    <div id="userTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <div style="display:flex;align-items: center;justify-content: space-between;">
                    <h5 class="mb-3 fw-bold">Cart List</h5>
                    <button type="button" class="btn btn-primary mb-3" id="btn_add_user">
                        Add Cart
                    </button>
                </div>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Dob</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
    </script>
@endpush
