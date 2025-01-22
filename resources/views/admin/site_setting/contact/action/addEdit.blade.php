<div class="modal fade" id="ModalAddEdit" tabindex="-1" aria-labelledby="ModalAddEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 v-if="!is_edit" class="modal-title" id="addExpenseLabel">Add User</h5>
                <h5 v-if="is_edit" class="modal-title" id="addExpenseLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adduserForm">
                    @csrf
                    <div class="row">
                        <!-- Budget -->
                        <div class="col-md-12 mb-3">
                            <label for="budget" class="form-label">Address</label>
                            <textarea v-model="formAdd.address" name="address" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="Phone" class="form-label">Phone</label>
                            <input v-model="formAdd.phone" name="phone" type="text" class="form-control" required>
                        </div>
                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="Email" class="form-label">Email</label>
                            <input v-model="formAdd.email" name="email" type="email" class="form-control" required>
                        </div>
                        <!-- Website -->
                        <div class="col-md-6 mb-3">
                            <label for="Website" class="form-label">Website</label>
                            <input v-model="formAdd.website" name="website" type="text" class="form-control" required>
                        </div>
                        <!-- Map url -->
                        <div class="col-md-12 mb-3">
                            <label for="map" class="form-label">Map</label>
                            <textarea v-model="formAdd.map_url" name="map" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="text-end">
                        <button v-if="!is_edit" @click="handleSubmitAddSiteContact" id="btn_submit_add_user" type="button" class="btn btn-success">Add User</button>
                        <button v-if="is_edit" @click="handleSubmitEditSiteContact" id="btn_submit_add_user" type="button" class="btn btn-success">Edit User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
