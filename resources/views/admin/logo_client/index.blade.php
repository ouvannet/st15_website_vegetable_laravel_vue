@extends('admin.layouts.app')

@section('title', 'Logo Client')


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
                            <th scope="col">Description</th>
                            <th scope="col">Logo</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(logo_client, index) in dataTable" :key="index">
                            <td>@{{logo_client.id}}</td>
                            <td>@{{logo_client.name}}</td>
                            <td>@{{logo_client.website_url}}</td>
                            <td>
                                <img
                                    :src="baseUrl+logo_client.logo_url"
                                    style="width: 60px; height: 60px;"
                                />
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(logo_client)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(logo_client.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.logo_client.action.addEdit')
    @include('admin.logo_client.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        name:'',
                        website_url:'',
                        logo:''
                    },
                    formEdit:{
                        logo_client_id:'',
                        old_logo:'',
                        data:{
                            name:'',
                            website_url:'',
                            logo:''
                        }
                    }
                });
                const mainTitle=ref("Logo Client");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
                const getList=async()=>{
                    const {data} = await axios.post('/admin/logoclient/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    dataTable.value=data;
                }
                getList();
                const handleLogoFiles=(e)=>{
                    formAdd.value.logo = Array.from(e.target.files);
                }
                const handleAdd=async()=>{
                    is_edit.value=false;
                    formAdd.value=sampleData.value.formAdd;
                    $("#ModalAddEdit").modal('toggle')
                }
                const handleSubmitAdd=async()=>{
                    const {data} = await axios.post('/admin/logoclient/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                }
                const handleDelete=(logo_client_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=logo_client_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/logoclient/submit_delete',{logo_client_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.logo_client_id=data.id;
                    formEdit.value.old_logo=data.logo_url;
                    formEdit.value.data.name=data.name;
                    formEdit.value.data.website_url=data.website_url;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    console.log(formAdd)
                    const {data} = await axios.post('/admin/logoclient/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
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
                    handleLogoFiles,
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
