@extends('admin.layouts.app')

@section('title', 'Category')


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
                            <th scope="col">Logo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        <tr v-for="(category, index) in dataTable" :key="index">
                            <td>@{{category.id}}</td>
                            <td>
                                <img
                                    :src="baseUrl+category.image_url"
                                    style="width: 60px; height: 60px;"
                                />
                            </td>
                            <td>@{{category.name}}</td>
                            <td>@{{category.is_active}}</td>
                            <td>@{{category.description}}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(category)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(category.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.category.action.addEdit')
    @include('admin.category.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref, onMounted } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        name:'',
                        description:'',
                        image:'',
                        is_active:'',
                    },
                    formEdit:{
                        category_id:'',
                        old_image:'',
                        data:{
                            name:'',
                            description:'',
                            image:'',
                            is_active:'',
                        }
                    }
                });
                const mainTitle=ref("Category");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);

                const reloadDataTable = () => {
                    $('#productsTable').DataTable().ajax.reload(null, false); // Reload without resetting pagination
                };

                const initDataTable = () => {
                    const table = $('#productsTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/admin/category/list',
                            type: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        },
                        columns: [
                            { data: 'id' },
                            {
                                data: 'image_url',
                                render: function (data) {
                                    return `<img src="${baseUrl}${data}" style="width: 60px; height: 60px;" />`;
                                }
                            },
                            { data: 'name' },
                            { data: 'is_active' },
                            { data: 'description' },
                            {
                                data: 'id',
                                orderable: false,
                                searchable: false,
                                render: function (data) {
                                    return `
                                        <button class="btn btn-dark btn-sm edit-btn"  data-id="${data}">
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

                const getList=async()=>{
                    const {data} = await axios.post('/admin/category/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    dataTable.value=data;
                }
                getList();
                const handleImageFiles=(e)=>{
                    formAdd.value.image = Array.from(e.target.files);
                }
                const handleAdd=async()=>{
                    is_edit.value=false;
                    $("#ModalAddEdit").modal('toggle')
                }
                const handleSubmitAdd=async()=>{
                    const {data} = await axios.post('/admin/category/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                    reloadDataTable();
                }
                const handleDelete=(category_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=category_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/category/submit_delete',{category_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                    reloadDataTable();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.category_id=data.id;
                    formEdit.value.old_logo=data.image_url;
                    formEdit.value.data.name=data.name;
                    formEdit.value.data.description=data.description;
                    formEdit.value.data.is_active=data.is_active;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    const {data} = await axios.post('/admin/category/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formEdit.value=sampleData.value.formEdit;
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                    reloadDataTable();
                }
                return {
                    mainTitle,
                    baseUrl,
                    formAdd,
                    dataTable,
                    handleImageFiles,
                    handleAdd,
                    handleSubmitAdd,
                    handleDelete,
                    handleSubmitDelete,
                    is_edit,
                    handleEdit,
                    handleSubmitEdit
                };
            }
        }).mount('#app');
    </script>
@endpush
