@extends('admin.layouts.app')

@section('title', 'Varient')


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
                            <th scope="col">Product</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(varient, index) in dataTable" :key="index">
                            <td>@{{varient.id}}</td>
                            <td>@{{varient.product.name}}</td>
                            <td>@{{varient.unit.name}}</td>
                            <td>@{{varient.price}}</td>
                            <td>@{{varient.quantity_in_base_unit}}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(varient)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(varient.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.varient.action.addEdit')
    @include('admin.varient.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        product_id:'',
                        unit_id:'',
                        price:'',
                        quantity_in_base_unit:0
                    },
                    formEdit:{
                        varient_id:'',
                        data:{
                            product_id:'',
                            unit_id:'',
                            price:'',
                            quantity_in_base_unit:0
                        }
                    }
                });
                const mainTitle=ref("Varient");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const dataProduct=ref([]);
                const dataUnit=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
                const getList=async()=>{
                    var {data} = await axios.post('/admin/varient/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    dataTable.value=data;
                    var {data} = await axios.post('/admin/unit/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    dataUnit.value=data;
                    var {data} = await axios.post('/admin/products/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    dataProduct.value=data;
                }
                getList();
                const handleLogoFiles=(e)=>{
                    formAdd.value.logo = Array.from(e.target.files);
                }
                const handleAdd=async()=>{
                    is_edit.value=false;
                    $("#ModalAddEdit").modal('toggle')
                }
                const handleSubmitAdd=async()=>{
                    const {data} = await axios.post('/admin/varient/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                }
                const handleDelete=(varient_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=varient_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/varient/submit_delete',{varient_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.varient_id=data.id;
                    formEdit.value.data.product_id=data.product_id;
                    formEdit.value.data.unit_id=data.unit_id;
                    formEdit.value.data.price=data.price;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    const {data} = await axios.post('/admin/varient/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
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
                    handleLogoFiles,
                    handleAdd,
                    handleSubmitAdd,
                    handleDelete,
                    handleSubmitDelete,
                    is_edit,
                    handleEdit,
                    handleSubmitEdit,
                    dataUnit,
                    dataProduct
                };
            }
        }).mount('#app');
    </script>
@endpush
