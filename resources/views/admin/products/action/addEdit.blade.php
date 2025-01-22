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
                        <div class="col-md-4 mb-3">
                            <label for="budget" class="form-label">Name</label>
                            <input type="text" v-model="formAdd.name" name="name" class="form-control" cols="30" rows="5" required></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select type="text" v-model="formAdd.category_id" name="category" class="form-select" required>
                                <option  v-for="(cat, index) in dataCategory" :key="index" :value="cat.id" selected>@{{cat.name}}</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <select type="text" v-model="formAdd.brand_id" name="brand" class="form-select" required>
                                <option  v-for="(brand, index) in dataBrand" :key="index" :value="brand.id" selected>@{{brand.name}}</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="unit" class="form-label">Unit</label>
                            <select type="text" v-model="formAdd.base_unit_id" name="unit" class="form-select" required>
                                <option  v-for="(unit, index) in dataUnit" :key="index" :value="unit.id" selected>@{{unit.name}}</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" v-model="formAdd.base_price" name="price" class="form-control" required></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input @change="handleImageFiles" class="form-control" type="file">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select type="text" v-model="formAdd.is_active" name="status" class="form-select" required>
                                <option value="0">Disabled</option>
                                <option value="1" selected>Enable</option>
                            </select>
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
