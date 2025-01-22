@extends('admin.layouts.app')

@section('title', 'Blog')


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
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(blog, index) in dataTable" :key="index">
                            <td>@{{blog.id}}</td>
                            <td>
                                <img
                                    :src="baseUrl+blog.featured_image"
                                    style="width: 60px; height: 60px;"
                                />
                            </td>
                            <td>@{{blog.title}}</td>
                            <td>
                                <textarea rows="6" style="width:100%;">@{{blog.content}}</textarea>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEdit(blog)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDelete(blog.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.blog.action.addEdit')
    @include('admin.blog.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        title:'',
                        content:'',
                        create_by:'',
                        featured_image:'',
                        published_at:''
                    },
                    formEdit:{
                        blog_id:'',
                        old_featured_image:'',
                        data:{
                            title:'',
                            content:'',
                            featured_image:''
                        }
                    }
                });
                const mainTitle=ref("Blog");
                const baseUrl= "{{ asset('') }}";
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataTable=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
                const getList=async()=>{
                    const {data} = await axios.post('/admin/blog/list',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    dataTable.value=data;
                }
                getList();
                const handleFeaturedImage=(e)=>{
                    formAdd.value.featured_image = Array.from(e.target.files);
                }
                const handleAdd=async()=>{
                    is_edit.value=false;
                    $("#ModalAddEdit").modal('toggle')
                }
                const handleSubmitAdd=async()=>{
                    const {data} = await axios.post('/admin/blog/submit_add',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    formAdd.value=sampleData.value.formAdd;
                    handleAdd();
                    getList();
                }
                const handleDelete=(blog_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=blog_id;
                }
                const handleSubmitDelete=async()=>{
                    const {data} = await axios.post('/admin/blog/submit_delete',{blog_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDelete();
                    getList();
                }
                const handleEdit=(data)=>{
                    is_edit.value=true;
                    formEdit.value.blog_id=data.id;
                    formEdit.value.old_featured_image=data.featured_image;
                    formEdit.value.data.title=data.title;
                    formEdit.value.data.content=data.content;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEdit=async()=>{
                    const {data} = await axios.post('/admin/blog/submit_edit',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
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
                    handleFeaturedImage,
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
