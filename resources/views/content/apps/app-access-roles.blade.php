@extends('layouts/layoutMaster')

@section('title', 'Roles - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.8/b-3.0.2/date-1.5.2/r-3.0.2/datatables.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>

@endsection



@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/js/app-access-roles.js') }}"></script>
    <script src="{{ asset('assets/js/modal-add-role.js') }}"></script>
@endsection

@section('content')
    <h4 class="mb-1">Roles List</h4>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p class="mb-4">A role provided access to predefined menus and features so that depending on assigned role an
        administrator can have access to what user needs.</p>
    <!-- Role cards -->

    <div class="row g-4">
        @foreach ($roles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <p>total 2</p>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Kim Merchent" class="avatar pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets/img/avatars/10.png') }}"
                                        alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Sam D'souza" class="avatar pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets/img/avatars/13.png') }}"
                                        alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Nurvi Karlos" class="avatar pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets/img/avatars/20.png') }}"
                                        alt="Avatar">
                                </li>
                                <li class="avatar">
                                    <span class="avatar-initial rounded-circle pull-up bg-lighter text-body"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="3 more">+3</span>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1 text-body">{{ $role->name }}</h4>
                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#editdRoleModal{{ $role->id }}" class="role-edit-modal"><span>Edit
                                        Role</span></a> |

                                <a href="javascript:void(0);" onclick="deleteRole('{{ $role->id }}')">Delete</a>
                                <form id="delete-role-form-{{ $role->id }}"
                                    action="{{ route('app-access-roles.destroy', $role) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </div>
                            <a href="javascript:void(0);" class="text-muted"><i
                                    class="mdi mdi-content-copy mdi-20px"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-5">
                        <div class="d-flex align-items-end h-100 justify-content-center">
                            <img src="{{ asset('assets/img/illustrations/add-new-role-illustration.png') }}"
                                class="img-fluid" alt="Image" width="70">
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                class="btn btn-primary mb-3 text-nowrap add-new-role">Add Role</button>
                            <p class="mb-0">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-medium mb-1 mt-5">Total users with their roles</h4>
        <p class="mb-0 mt-1">Find all of your company’s administrator accounts and their associate roles.</p>

        <div class="col-12">
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-users table">
                        <thead class="table-light">
                            <tr>

                                <th></th>
                                <th>User</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->

    <!-- Add Role Modal -->
    @include('_partials/_modals/modal-add-role')
    <!-- / Add Role Modal -->

    {{-- edit role modal --}}


    @foreach ($roles as $role)
        <div class="modal fade" id="editdRoleModal{{ $role->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-body p-md-0">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2 pb-0">Edit Role</h3>
                            <p>Set role permissions</p>
                        </div>
                        <!-- Add role form -->
                        <form id="" action="{{ route('app-access-roles.update', $role->id) }}" method="POST"
                            class="row g-3">
                            @csrf
                            @method('PUT')
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
    @endforeach
    {{-- edit role modal --}}

    {{-- modal change role --}}

    <!-- Add Role Modal -->
    <div class="modal fade" id="changeRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body p-md-0">
                    <div class="text-center mb-4">
                        <h3 class="role-title mb-2 pb-0">Change Role</h3>
                        <p>Set role permissions</p>
                    </div>
                    <!-- Add role form -->

                    <div class="col-12 mb-4">
                        <div class="form-floating form-floating-outline">
                            <select id="roleSelect" name="role_id" class="form-select" aria-label="Choose Plan">
                                <option selected>Choose Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="button" id="saveRoleBtn" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Role Modal -->

    {{-- end change role --}}
    <script>
        function deleteRole(roleId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-outline-secondary waves-effect'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-role-form-' + roleId).submit();
                }
            });
        }
    </script>


@endsection
