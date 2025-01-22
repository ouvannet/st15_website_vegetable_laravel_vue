@extends('admin.layouts.app')

@section('title', 'Site Contact')


@section('content')
    <div id="userTable" class="mb-5">
        <div class="card" >
            <div class="card-body">
                <div style="display:flex;align-items: center;justify-content: space-between;">
                    <h5 class="mb-3 fw-bold">Site Contact List</h5>
                    <button type="button" class="btn btn-primary mb-3" @click="handleAddSiteContact">
                        Add Site Contact
                    </button>
                </div>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Website</th>
                            <th scope="col">Map</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(contact, index) in dataContact" :key="index">
                            <td>@{{contact.id}}</td>
                            <td>@{{contact.address}}</td>
                            <td>@{{contact.phone}}</td>
                            <td>@{{contact.email}}</td>
                            <td>@{{contact.website}}</td>
                            <td>@{{contact.map_url}}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button @click="handleEditContact(contact)" type="button" class="btn btn-dark btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button @click="handleDeleteContact(contact.id)" type="button" class="btn btn-danger btn-sm">
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
    @include('admin.site_setting.contact.action.addEdit')
    @include('admin.site_setting.contact.action.delete')

@endsection

@push('js')
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const sampleData=ref({
                    formAdd:{
                        address:'',
                        phone:'',
                        email:'',
                        website:'',
                        map_url:'',
                    },
                    formEdit:{
                        contact_id:'',
                        data:{
                            address:'',
                            phone:'',
                            email:'',
                            website:'',
                            map_url:'',
                        }
                    }
                });
                const formAdd=ref(sampleData.value.formAdd)
                const formEdit=ref(sampleData.value.formEdit)
                const dataContact=ref([]);
                const delete_id=ref(0);
                const is_edit=ref(false);
                const getListContact=async()=>{
                    const {data} = await axios.post('/admin/sitesetting/list_contact',{}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    dataContact.value=data;
                }
                getListContact();
                const handleAddSiteContact=async()=>{
                    is_edit.value=false;
                    $("#ModalAddEdit").modal('toggle')
                }
                const handleSubmitAddSiteContact=async()=>{
                    console.log(formAdd)
                    const {data} = await axios.post('/admin/sitesetting/submit_add_site_contact',formAdd.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    formAdd.value=sampleData.value.formAdd;
                    handleAddSiteContact();
                    getListContact();
                }
                const handleDeleteContact=(contact_id)=>{
                    $("#ModalDelete").modal('toggle');
                    delete_id.value=contact_id;
                }
                const handleSubmitDeleteContact=async()=>{
                    const {data} = await axios.post('/admin/sitesetting/submit_delete_contact',{contact_id:delete_id.value}, { headers: { 'Content-Type': 'multipart/form-data' } });
                    delete_id.value=0;
                    handleDeleteContact();
                    getListContact();
                }
                const handleEditContact=(contact_data)=>{
                    is_edit.value=true;
                    formEdit.value.contact_id=contact_data.id;
                    formEdit.value.data.address=contact_data.address;
                    formEdit.value.data.phone=contact_data.phone;
                    formEdit.value.data.email=contact_data.email;
                    formEdit.value.data.website=contact_data.website;
                    formEdit.value.data.map_url=contact_data.map_url;
                    formAdd.value=formEdit.value.data;
                    $("#ModalAddEdit").modal('toggle');
                }
                const handleSubmitEditSiteContact=async()=>{
                    console.log(formAdd)
                    const {data} = await axios.post('/admin/sitesetting/submit_edit_contact',formEdit.value, { headers: { 'Content-Type': 'multipart/form-data' } });
                    console.log(data);
                    formEdit.value=sampleData.value.formEdit;
                    formAdd.value=sampleData.value.formAdd;
                    handleAddSiteContact();
                    getListContact();
                }
                return {
                    formAdd,
                    dataContact,
                    handleAddSiteContact,
                    handleSubmitAddSiteContact,
                    handleDeleteContact,
                    handleSubmitDeleteContact,
                    is_edit,
                    handleEditContact,
                    handleSubmitEditSiteContact
                };
            }
        }).mount('#app');
    </script>
@endpush
