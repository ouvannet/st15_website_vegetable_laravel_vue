@extends('admin.layouts.app')

@section('title', 'Brands')


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
                        <tr v-for="(brand, index) in dataTable" :key="index">
                            <td>@{{brand.id}}</td>
                            <td>@{{brand.name}}</td>
                            <td>@{{brand.description}}</td>
                            <td>
                                <img
                                    :src="baseUrl+brand.logo_url"
                                    style="width: 60px; height: 60px;"
                                />
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(brand)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(brand.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.brand.action.addEdit')
    @include('admin.brand.action.delete')

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
                        logo:''
                    },
                    formEdit:{
                        brand_id:'',
                        old_logo:'',
                        data:{
                            name:'',
                            description:'',
                            logo:''
                        }
                    }
                });
                const mainTitle=ref("Brand");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
                const getList=async()=>{
                    const {data} = await axios.post('/admin/brand/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    dataTable.value=data;
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
                    const {data} = await axios.post('/admin/brand/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                }
                const handleDelete=(brand_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=brand_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/brand/submit_delete',{brand_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.brand_id=data.id;
                    formEdit.value.old_logo=data.logo_url;
                    formEdit.value.data.name=data.name;
                    formEdit.value.data.description=data.description;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    console.log(formAdd)
                    const {data} = await axios.post('/admin/brand/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
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
