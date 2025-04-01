@extends('admin.layouts.app')

@section('title', 'Role')


@section('content')
    <div class="mb-5">
        <div class="card" >
            <div class="card-body">
                <div style="display:flex;align-items: center;justify-content: space-between;">
                    <h5 class="mb-3 fw-bold">@{{mainTitle}} List</h5>
                    <button type="button" class="btn btn-primary mb-3" @click="handleAdd">
                        Add @{{mainTitle}}
                    </button>
                </div>
                <table id="productsTable" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        <tr v-for="(role, index) in dataTable" :key="index">
                            <td>@{{role.id}}</td>
                            <td>@{{role.name}}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleSetPermission(role.id)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-handshake"></i>
                                        Set Permission
                                    </button>
                                    <button @click="handleEdit(role)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(role.id)" type="button" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody> --}}

                </table>
            </div>
        </div>
    </div>
    @include('admin.role.action.addEdit')
    @include('admin.role.action.delete')
    @include('admin.role.action.set_permission')

@endsection

@push('js')
    <script>
        const { createApp, ref, onMounted } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        name:''
                    },
                    formEdit:{
                        role_id:'',
                        data:{
                            name:''
                        }
                    },
                    formSetPermissionRole:{
                        role_id:'',
                        permission_id:[]
                    }
                });
                const mainTitle=ref("Role");
                const checkboxContainer=ref();
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const formSetPermissionRole=ref(sampleData.value.formSetPermissionRole);
                const dataTable=ref([]);
                const dataPermission=ref([]);
                const delete_id=ref(0);
                const roleId=ref(0);
                const is_edit=ref(false);

                const reloadDataTable = () => {
                    $('#productsTable').DataTable().ajax.reload(null, false); // Reload without resetting pagination
                };

                const initDataTable = () => {
                    const table = $('#productsTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/admin/role/list',
                            type: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        },
                        columns: [
                            { data: 'id' },
                            { data: 'name' },
                            {
                                data: 'id',
                                orderable: false,
                                searchable: false,
                                render: function (data) {
                                    return `
                                        <button class="btn btn-dark btn-sm setPermission-btn">
                                            <i class="fa-solid fa-handshake"></i>
                                            Set Permission
                                        </button>
                                        <button class="btn btn-dark btn-sm edit-btn" data-id="${data}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="${data}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    `;
                                }
                            }
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

                    // Event listener for edit and delete buttons
                    $("#productsTable").on('click','.setPermission-btn',function(){
                        const row = table.row($(this).parents('tr')).data();
                        handleSetPermission(row.id);
                    })
                    $('#productsTable').on('click', '.edit-btn', function () {
                        const row = table.row($(this).parents('tr')).data();
                        handleEdit(row);
                    });

                    $('#productsTable').on('click', '.delete-btn', function () {
                        const row = table.row($(this).parents('tr')).data();
                        handleDelete(row.id);
                    });
                };

                onMounted(() => {
                    initDataTable();
                });

                const getListPermission=async(role_id)=>{
                    try {
                        var {data} = await axios.post('/admin/role/permission_role',{role_id:role_id}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        console.log(data);

                        dataPermission.value=data;
                    } catch (error) { console.log(error); }
                }
                const getList=async()=>{
                    const {data} = await axios.post('/admin/role/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    dataTable.value=data;
                }
                getList();
                const handleAdd=async()=>{
                    is_edit.value=false;
                    formAdd.value=sampleData.value.formAdd;
                    $("#ModalAddEdit").modal('toggle')
                }
                const handleSubmitAdd=async()=>{
                    const {data} = await axios.post('/admin/role/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                    reloadDataTable();
                }
                const handleDelete=(role_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=role_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/role/submit_delete',{role_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                    reloadDataTable();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.role_id=data.id;
                    formEdit.value.data.name=data.name;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    console.log(formAdd)
                    const {data} = await axios.post('/admin/role/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    formEdit.value=sampleData.value.formEdit;
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                    reloadDataTable();
                }
                const handleSetPermission=(role_id)=>{
                    getListPermission(role_id);
                    formSetPermissionRole.value.role_id=role_id;
                    $("#ModalSetPermission").modal('toggle');
                }
                const handleSubmitSetPermission=async()=>{
                    formSetPermissionRole.value.permission_id=[];
                    const checkboxes = checkboxContainer.value.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach((checkbox) => {
                        if(checkbox.checked){
                            formSetPermissionRole.value.permission_id.push(checkbox.value);
                        }
                    });
                    const {data} = await axios.post('/admin/role/submit_set_permission_role',formSetPermissionRole.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    $("#ModalSetPermission").modal('toggle');
                }
                return {
                    mainTitle,
                    formAdd,
                    dataTable,
                    dataPermission,
                    handleAdd,
                    handleSubmitAdd,
                    handleDelete,
                    handleSubmitDelete,
                    is_edit,
                    handleEdit,
                    handleSubmitEdit,
                    handleSetPermission,
                    formSetPermissionRole,
                    handleSubmitSetPermission,
                    checkboxContainer
                };
            }
        }).mount('#app');
    </script>
@endpush
