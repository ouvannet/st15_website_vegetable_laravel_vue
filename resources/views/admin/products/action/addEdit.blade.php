<div class="modal fade" id="ModalAddEdit" tabindex="-1" aria-labelledby="ModalAddEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 v-if="!is_edit" class="modal-title">Add @{{mainTitle}}</h5>
                <h5 v-if="is_edit" class="modal-title">Edit @{{mainTitle}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adduserForm" @submit.prevent>
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="budget" class="form-label">Name</label>
                            <input
                                type="text"
                                v-model="formAdd.name"
                                class="form-control"
                                :class="{'is-invalid': errors.name}"
                            >
                            <div v-if="errors.name" class="invalid-feedback">@{{ errors.name }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select
                                v-model="formAdd.category_id"
                                class="form-select"
                                :class="{'is-invalid': errors.category_id}"
                            >
                                <option value="">Select Category</option>
                                <option v-for="(cat, index) in dataCategory" :key="index" :value="cat.id">
                                    @{{cat.name}}
                                </option>
                            </select>
                            <div v-if="errors.category_id" class="invalid-feedback">@{{ errors.category_id }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <select
                                v-model="formAdd.brand_id"
                                class="form-select"
                                :class="{'is-invalid': errors.brand_id}"
                            >
                                <option value="">Select Brand</option>
                                <option v-for="(brand, index) in dataBrand" :key="index" :value="brand.id">
                                    @{{brand.name}}
                                </option>
                            </select>
                            <div v-if="errors.brand_id" class="invalid-feedback">@{{ errors.brand_id }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="unit" class="form-label">Unit</label>
                            <select
                                v-model="formAdd.base_unit_id"
                                class="form-select"
                                :class="{'is-invalid': errors.base_unit_id}"
                            >
                                <option value="">Select Unit</option>
                                <option v-for="(unit, index) in dataUnit" :key="index" :value="unit.id">
                                    @{{unit.name}}
                                </option>
                            </select>
                            <div v-if="errors.base_unit_id" class="invalid-feedback">@{{ errors.base_unit_id }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input
                                type="text"
                                v-model="formAdd.base_price"
                                class="form-control"
                                :class="{'is-invalid': errors.base_price}"
                            >
                            <div v-if="errors.base_price" class="invalid-feedback">@{{ errors.base_price }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input
                                @change="handleImageFiles"
                                class="form-control"
                                type="file"
                                :class="{'is-invalid': errors.image_url}"
                            >
                            <div v-if="is_edit && formAdd.image_url" class="mt-2">
                                <img :src="baseUrl + formAdd.image_url" style="max-width: 100px;">
                            </div>
                            <div v-if="errors.image_url" class="invalid-feedback">@{{ errors.image_url }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select
                                v-model="formAdd.is_active"
                                class="form-select"
                                :class="{'is-invalid': errors.is_active}"
                            >
                                <option value="">Select Status</option>
                                <option value="0">Disabled</option>
                                <option value="1">Enable</option>
                            </select>
                            <div v-if="errors.is_active" class="invalid-feedback">@{{ errors.is_active }}</div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="Description" class="form-label">Description</label>
                            <textarea
                                v-model="formAdd.description"
                                class="form-control"
                                rows="3"
                                :class="{'is-invalid': errors.description}"
                            ></textarea>
                            <div v-if="errors.description" class="invalid-feedback">@{{ errors.description }}</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button
                            v-if="!is_edit"
                            @click="handleSubmitAdd"
                            type="button"
                            class="btn btn-success"
                        >
                            Add @{{mainTitle}}
                        </button>
                        <button
                            v-if="is_edit"
                            @click="handleSubmitEdit"
                            type="button"
                            class="btn btn-success"
                        >
                            Edit @{{mainTitle}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
