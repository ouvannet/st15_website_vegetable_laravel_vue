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
                <table id="productsTable" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
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
                    </tbody> --}}

                </table>
            </div>
        </div>
    </div>
    @include('admin.blog.action.addEdit')
    @include('admin.blog.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref, onMounted } = Vue;
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

                const reloadDataTable = () => {
                    $('#productsTable').DataTable().ajax.reload(null, false); // Reload without resetting pagination
                };

                const initDataTable = () => {
                    const table = $('#productsTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/admin/blog/list',
                            type: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        },
                        columns: [
                            { data: 'id' },
                            {
                                data: 'featured_image',
                                render: function (data) {
                                    return `<img src="${baseUrl}${data}" style="width: 60px; height: 60px;" />`;
                                }
                            },
                            { data: 'title' },
                            {
                                data: 'content',
                                render: function (data) {
                                    return `<textarea rows="6" style="width:100%;">${data}</textarea>`;
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
                    reloadDataTable();
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
                    reloadDataTable();
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
                    reloadDataTable();
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
