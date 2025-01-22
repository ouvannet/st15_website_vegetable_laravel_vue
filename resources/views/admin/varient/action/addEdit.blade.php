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
                            <label for="product" class="form-label">Product</label>
                            <select type="text" v-model="formAdd.product_id" name="product" class="form-select" required>
                                <option  v-for="(pro, index) in dataProduct" :key="index" :value="pro.id" selected>@{{pro.name}}</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="unit" class="form-label">Unit</label>
                            <select type="text" v-model="formAdd.unit_id" name="unit" class="form-select" required>
                                <option  v-for="(unit, index) in dataUnit" :key="index" :value="unit.id" selected>@{{unit.name}}</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" v-model="formAdd.price" name="price" class="form-control" required></input>
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
