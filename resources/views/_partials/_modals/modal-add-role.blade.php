<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2 pb-0">Add New Role</h3>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="" action="{{ route('app-access-roles.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-12 mb-4">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalRoleName" name="role_name" class="form-control"
                                placeholder="Enter a role name" tabindex="-1" />
                            <label for="modalRoleName">Role Name</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <h5>Role Permissions</h5>
                        <!-- Permission table -->

                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->
