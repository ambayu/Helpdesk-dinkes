<!-- Add Permission Modal -->
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1">Add New Permission</h3>
                    <p>Permissions you may use and assign to your users.</p>
                </div>
              <form id="" class="row" action="/app/access-permission" method="post">
                    @csrf
                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="permission_name" name="permission_name" class="form-control"
                                placeholder="Permission Name" autofocus />
                            <label for="permission_name">Permission Name</label>
                        </div>
                    </div>

                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Create Permission</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
