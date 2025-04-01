@extends('admin.layouts.app')

@section('title', 'Products')


@section('content')
    <div class="mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>
        <div v-if="addProductSuccess" class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                Add Product Success !!
            </div>
        </div>
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
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        <tr v-for="(product, index) in dataTable" :key="index">
                            <td>@{{product.id}}</td>
                            <td>
                                <img
                                    :src="baseUrl+product.image_url"
                                    style="width: 60px; height: 60px;"
                                />
                            </td>
                            <td>@{{product.name}}</td>
                            <td>@{{product.category.name}}</td>
                            <td>@{{product.brand.name}}</td>
                            <td>@{{product.base_unit.name}}</td>
                            <td>@{{product.base_price}}</td>
                            <td>@{{product.stock_quantity}}</td>
                            <td>
                                <span v-if="product.is_active" class="badge bg-primary">Primary</span>
                                <span v-else class="badge bg-danger">Danger</span>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(product)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(product.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.products.action.addEdit')
    @include('admin.products.action.delete')

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
                        category_id:'',
                        brand_id:'',
                        base_unit_id:'',
                        base_price:'',
                        image_url:'',
                        is_active:'',
                    },
                    formEdit:{
                        product_id:'',
                        old_image_url:'',
                        data:{
                            name:'',
                            description:'',
                            category_id:'',
                            brand_id:'',
                            base_unit_id:'',
                            base_price:'',
                            image_url:'',
                            is_active:'',
                        }
                    }
                });
                const errors = ref({});
                const addProductSuccess = ref(false);

                const mainTitle=ref("Product");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                // const addProductSuccess=false;
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const dataCategory=ref([]);
                const dataBrand=ref([]);
                const dataUnit=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);

                // Validation function
                const validateForm = () => {
                    errors.value = {};

                    if (!formAdd.value.name.trim()) {
                        errors.value.name = 'Name is required';
                    }
                    if (!formAdd.value.category_id) {
                        errors.value.category_id = 'Category is required';
                    }
                    if (!formAdd.value.brand_id) {
                        errors.value.brand_id = 'Brand is required';
                    }
                    if (!formAdd.value.base_unit_id) {
                        errors.value.base_unit_id = 'Unit is required';
                    }
                    if (!formAdd.value.base_price) {
                        errors.value.base_price = 'Price is required';
                    } else if (isNaN(formAdd.value.base_price) || Number(formAdd.value.base_price) <= 0) {
                        errors.value.base_price = 'Price must be a valid number greater than 0';
                    }
                    if (!is_edit.value && !formAdd.value.image_url) {
                        errors.value.image_url = 'Image is required for new products';
                    }
                    if (!formAdd.value.description.trim()) {
                        errors.value.description = 'Description is required';
                    }
                    if (formAdd.value.is_active === '') {
                        errors.value.is_active = 'Status is required';
                    }

                    return Object.keys(errors.value).length === 0;
                };

                const reloadDataTable = () => {
                    $('#productsTable').DataTable().ajax.reload(null, false); // Reload without resetting pagination
                };

                const initDataTable = () => {
                    const table = $('#productsTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/admin/products/list',
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
                            { data: 'category.name' },
                            { data: 'brand.name' },
                            { data: 'base_unit.name' },
                            { data: 'base_price' },
                            { data: 'stock_quantity' },
                            {
                                data: 'is_active',
                                render: function (data) {
                                    return data
                                        ? '<span class="badge bg-primary">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>';
                                }
                            },
                            {
                                data: 'id',
                                orderable: false,
                                searchable: false,
                                render: function (data) {
                                    return `
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
                    try {
                        var {data} = await axios.post('/admin/products/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        dataTable.value=data;
                    } catch (error) { console.log(error); }
                    try {
                        var {data} = await axios.post('/admin/category/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        dataCategory.value=data;
                    } catch (error) { console.log(error); }
                    try {
                        var {data} = await axios.post('/admin/brand/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        dataBrand.value=data;
                    } catch (error) { console.log(error); }
                    try {
                        var {data} = await axios.post('/admin/unit/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        dataUnit.value=data;
                    } catch (error) { console.log(error); }
                }
                getList();
                const handleImageFiles=(e)=>{
                    formAdd.value.image_url = Array.from(e.target.files);
                }
                const handleAdd=async()=>{
                    is_edit.value=false;
                    $("#ModalAddEdit").modal('toggle')
                }
                const handleSubmitAdd=async()=>{
                    if (!validateForm()) return;
                    const {data} = await axios.post('/admin/products/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    addProductSuccess.value=true;
                    handleAdd();
                    getList();
                    reloadDataTable();
                }
                const handleDelete=(product_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=product_id;
                }
                const handleSubmitDelete=async()=>{
                    // if (!validateForm()) return;
                    const {data} = await axios.post('/admin/products/submit_delete',{product_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                    reloadDataTable();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.product_id=data.id;
                    formEdit.value.data.name=data.name;
                    formEdit.value.data.description=data.description;
                    formEdit.value.data.category_id=data.category_id;
                    formEdit.value.data.brand_id=data.brand_id;
                    formEdit.value.data.base_unit_id=data.base_unit_id;
                    formEdit.value.data.base_price=data.base_price;
                    formEdit.value.data.is_active=data.is_active;
                    formEdit.value.old_image_url=data.image_url;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    console.log(formAdd)
                    const {data} = await axios.post('/admin/products/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
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
                    addProductSuccess,
                    dataTable,
                    dataCategory,
                    dataBrand,
                    dataUnit,
                    handleImageFiles,
                    handleAdd,
                    handleSubmitAdd,
                    handleDelete,
                    handleSubmitDelete,
                    is_edit,
                    handleEdit,
                    handleSubmitEdit,
                    errors
                };
            }
        }).mount('#app');
    </script>
@endpush
