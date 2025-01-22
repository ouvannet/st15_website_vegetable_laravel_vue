@extends('admin.layouts.app')

@section('title', 'Payment Method')


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
                            <th scope="col">Name</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(payment_method, index) in dataTable" :key="index">
                            <td>@{{payment_method.id}}</td>
                            <td>@{{payment_method.name}}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(payment_method)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(payment_method.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.payment_method.action.addEdit')
    @include('admin.payment_method.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        name:''
                    },
                    formEdit:{
                        payment_method_id:'',
                        data:{
                            name:''
                        }
                    }
                });
                const mainTitle=ref("Payment Method");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
                const getList=async()=>{
                    const {data} = await axios.post('/admin/paymentmethod/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
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
                    const {data} = await axios.post('/admin/paymentmethod/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                }
                const handleDelete=(payment_method_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=payment_method_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/paymentmethod/submit_delete',{payment_method_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.payment_method_id=data.id;
                    formEdit.value.data.name=data.name;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    const {data} = await axios.post('/admin/paymentmethod/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
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
