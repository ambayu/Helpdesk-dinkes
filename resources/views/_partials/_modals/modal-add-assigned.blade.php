<!-- Add Permission Modal -->
<div class="modal fade" id="addAssignedModal" tabindex="-1" aria-
="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2">Edit User Information</h3>
                    <p class="pt-1">Updating user details will receive a privacy audit.</p>
                </div>
                <form id="addAssigned" method="POST" class="row">
                    @csrf

                    <div class="col-sm-12  mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="editPermissionName" name="permission_name" class="form-control"
                                placeholder="Permission Name" tabindex="-1" />
                            <label for="editPermissionName">Permission Name</label>
                        </div>
                    </div>
                    <h2>Choose The Roles</h2>
                    <ul class="p-0 m-0">
                        @foreach ($roles as $role)
                            <li class="d-flex mb-3 flex-wrap">
                                <div class="avatar me-3">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="avatar"
                                        class="rounded-circle">
                                </div>
                                <div class="d-flex justify-content-between flex-grow-1">
                                    <div class="me-2">
                                        <p class="mb-0 text-heading">{{ $role->name }}</p>
                                        <p class="mb-0">{{ $role->created_at }}</p>
                                    </div>
                                    <div class="dropdown">
                                        <input class="form-check-input" type="checkbox" value="{{ $role->name }}"
                                            name='assigments[]' id="defaultCheck11">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" id="editSubmit">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
