@extends('admin.layouts.app')

@section('title', 'User')


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
                            <th scope="col">Full Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Role</th>
                            <th scope="col">Image</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in dataTable" :key="index">
                            <td>@{{user.id}}</td>
                            <td>@{{user.full_name}}</td>
                            <td>@{{user.gender}}</td>
                            <td>@{{user.phone}}</td>
                            <td>@{{user.address}}</td>
                            <td>@{{user.role.name}}</td>=
                            <td>
                                <img
                                    :src="baseUrl+user.image_url"
                                    style="width: 60px; height: 60px;"
                                />
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(user)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(user.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.user.action.addEdit')
    @include('admin.user.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        username:'',
                        email:'',
                        password:'',
                        full_name:'',
                        gender:'',
                        phone:'',
                        address:'',
                        role_id:'',
                        image_url:''
                    },
                    formEdit:{
                        user_id:'',
                        old_image_url:'',
                        data:{
                            username:'',
                            email:'',
                            password:'',
                            full_name:'',
                            gender:'',
                            phone:'',
                            address:'',
                            role_id:'',
                            image_url:''
                        }
                    }
                });
                const mainTitle=ref("User");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const dataRole=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
                const getList=async()=>{
                    try {
                        var {data} = await axios.post('/admin/user/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        dataTable.value=data;
                    } catch (error) { console.log(error); }
                    try {
                        var {data} = await axios.post('/admin/role/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        dataRole.value=data;
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
                    const {data} = await axios.post('/admin/user/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                }
                const handleDelete=(user_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=user_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/user/submit_delete',{user_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.user_id=data.id;
                    formEdit.value.old_image_url=data.image_url;
                    formEdit.value.data.username=data.username;
                    formEdit.value.data.email=data.email;
                    formEdit.value.data.password=data.password;
                    formEdit.value.data.full_name=data.full_name;
                    formEdit.value.data.gender=data.gender;
                    formEdit.value.data.phone=data.phone;
                    formEdit.value.data.address=data.address;
                    formEdit.value.data.role_id=data.role_id;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    const {data} = await axios.post('/admin/user/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
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
                    dataRole,
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
