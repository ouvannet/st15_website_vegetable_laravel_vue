<div class="modal fade" id="ModalAddEdit" tabindex="-1" aria-labelledby="ModalAddEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 v-if="!is_edit" class="modal-title" id="addExpenseLabel">Add @{{mainTitle}}</h5>
                <h5 v-if="is_edit" class="modal-title" id="addExpenseLabel">Edit @{{mainTitle}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adduserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" v-model="formAdd.username" name="username" class="form-control" required></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" v-model="formAdd.email" name="email" class="form-control" required></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" v-model="formAdd.password" name="password" class="form-control" required></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" v-model="formAdd.full_name" name="full_name" class="form-control" required></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select v-model="formAdd.gender" name="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" v-model="formAdd.phone" name="phone" class="form-control" required></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" v-model="formAdd.address" name="address" class="form-control" required></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select v-model="formAdd.role_id" name="role_id" class="form-control" required>
                                <option  v-for="(role, index) in dataRole" :key="index" :value="role.id" selected>@{{role.name}}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image</label>
                            <input @change="handleImageFiles" class="form-control" type="file" id="formFileMultiple">
                        </div>
                    </div>
                    <div class="text-end">
                        <button v-if="!is_edit" @click="handleSubmitAdd" id="btn_submit_add_user" type="button" class="btn btn-success">Add @{{mainTitle}}</button>
                        <button v-if="is_edit" @click="handleSubmitEdit" id="btn_submit_add_user" type="button" class="btn btn-success">Edit @{{mainTitle}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
