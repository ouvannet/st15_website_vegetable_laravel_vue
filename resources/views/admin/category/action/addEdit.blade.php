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
                        <!-- Budget -->
                        <div class="col-md-6 mb-3">
                            <label for="budget" class="form-label">Name</label>
                            <input type="text" v-model="formAdd.name" name="name" class="form-control" cols="30" rows="5" required></input>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="budget" class="form-label">Status</label>
                            <select type="text" v-model="formAdd.is_active" name="status" class="form-control" cols="30" rows="5" required>
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="formFileMultiple" class="form-label">Image</label>
                            <input @change="handleImageFiles" class="form-control" type="file" id="formFileMultiple">
                        </div>
                        <!-- Description url -->
                        <div class="col-md-12 mb-3">
                            <label for="Description" class="form-label">Description</label>
                            <textarea v-model="formAdd.description" name="Description" class="form-control" rows="3" required></textarea>
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
