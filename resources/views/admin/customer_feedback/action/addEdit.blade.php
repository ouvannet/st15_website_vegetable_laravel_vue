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
                        <div class="col-md-6 mb-3">
                            <label for="user" class="form-label">User</label>
                            <select type="text" v-model="formAdd.user_id" name="user" class="form-select" required>
                                <option  v-for="(user, index) in dataUser" :key="index" :value="user.id" selected>@{{user.full_name}}</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="Comment" class="form-label">Comment</label>
                            <textarea v-model="formAdd.comment" name="Comment" class="form-control" rows="5" required></textarea>
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
