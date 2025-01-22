<div class="modal fade" id="ModalSetPermission" tabindex="-1" aria-labelledby="ModalSetPermission" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpenseLabel">Set Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="setPermissionRoleForm">
                    <div class="row" ref="checkboxContainer">
                        <div v-for="(permission,index) in dataPermission" :key="index" class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" :value="permission.id" :checked="permission.roles.length > 0" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked">@{{permission.name}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button @click="handleSubmitSetPermission" type="button" class="btn btn-success">Set Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
