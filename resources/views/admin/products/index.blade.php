@extends('admin.layouts.app')

@section('title', 'Products')


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
                <table class="table table-striped mb-0">
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
                    <tbody>
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
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @include('admin.products.action.addEdit')
    @include('admin.products.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref } = Vue;
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
                const mainTitle=ref("Product");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const dataCategory=ref([]);
                const dataBrand=ref([]);
                const dataUnit=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
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
                    const {data} = await axios.post('/admin/products/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                }
                const handleDelete=(product_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=product_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/products/submit_delete',{product_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
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
                }
                return {
                    mainTitle,
                    baseUrl,
                    formAdd,
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
                    handleSubmitEdit
                };
            }
        }).mount('#app');
    </script>
@endpush
