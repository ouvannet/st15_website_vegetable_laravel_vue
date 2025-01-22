@extends('admin.layouts.app')

@section('title', 'Customer Feedback')


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
                            <th scope="col">Comment</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cus_fb, index) in dataTable" :key="index">
                            <td>@{{cus_fb.id}}</td>
                            <td>@{{cus_fb.user.full_name}}</td>
                            <td>@{{cus_fb.comment}}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(cus_fb)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(cus_fb.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.customer_feedback.action.addEdit')
    @include('admin.customer_feedback.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        user_id:'',
                        comment:'',
                    },
                    formEdit:{
                        brand_id:'',
                        data:{
                            user_id:'',
                            comment:'',
                        }
                    }
                });
                const mainTitle=ref("Customer Feedback");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const dataUser=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
                const getList=async()=>{
                    try {
                        var {data} = await axios.post('/admin/customerfeedback/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        dataTable.value=data;
                    } catch (error) { console.log(errror); }
                    try {
                        var {data} = await axios.post('/admin/user/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        dataUser.value=data;
                        console.log(dataUser.value);

                    } catch (error) { console.log(errror); }
                }
                getList();
                const handleAdd=async()=>{
                    is_edit.value=false;
                    $("#ModalAddEdit").modal('toggle')
                }
                const handleSubmitAdd=async()=>{
                    const {data} = await axios.post('/admin/customerfeedback/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                }
                const handleDelete=(customer_feedback_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=customer_feedback_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/customerfeedback/submit_delete',{customer_feedback_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.customer_feedback_id=data.id;
                    formEdit.value.data.user_id=data.user_id;
                    formEdit.value.data.comment=data.comment;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    console.log(formAdd)
                    const {data} = await axios.post('/admin/customerfeedback/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
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
                    dataUser,
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
