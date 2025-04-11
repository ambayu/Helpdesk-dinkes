@extends('layouts/layoutMaster')

@section('title', 'Roles - Apps')

@section('vendor-style')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <!-- DataTables Bootstrap 5 core -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">

    <!-- DataTables Responsive Bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">

    <!-- DataTables Buttons Bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />

    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />

    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection


@section('vendor-script')
<!-- jQuery -->
<script src="/assets/vendor/libs/jquery/jquery.js"></script>

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
    {{-- <script src="{{ asset('assets/js/modal-add-role.js') }}"></script> --}}
@endsection

@section('content')
    <h4 class="mb-1">Daftar Peran</h4>
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
    <p class="mb-4">Peran memberikan akses ke menu dan fitur yang telah ditentukan sebelumnya sehingga bergantung pada
        peran yang ditetapkan
        administrator dapat memiliki akses terhadap apa yang dibutuhkan pengguna.</p>
    <!-- Role cards -->

    <div class="row g-4">
        @php
            $counter = 0;
        @endphp
        @foreach ($roles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <p>total {{ $role->users_count }} orang</p>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">

                                @foreach ($role->users as $user)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="{{ $user->name }}" class="avatar pull-up">
                                        <img class="rounded-circle"
                                            src="{{ $user->profile_photo_path ? Storage::url($user->profile_photo_path) : asset('assets/img/avatars/1.png') }}"
                                            alt="Avatar">
                                    </li>
                                    @php
                                        $counter++;
                                    @endphp

                                    @if ($counter >= 8)
                                        ...
                                        @break
                                    @endif
                                @endforeach



                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1 text-body">{{ $role->name }}</h4>
                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#editdRoleModal{{ $role->id }}" class="role-edit-modal"><span>Ubah
                                        Peran</span></a> |

                                <a href="javascript:void(0);" onclick="deleteRole('{{ $role->id }}')">Hapus</a>
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
                                class="btn btn-primary mb-3 text-nowrap add-new-role">Tambah Peran</button>
                            <p class="mb-0">Tambah Peran, jika peran belum ada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-medium mb-1 mt-5">Total pengguna di setiap Role</h4>
        <p class="mb-0 mt-1">Temukan semua izin dan peran pengguna yang diakses di persusahaanmu.</p>

        <div class="col-12">
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-users table">
                        <thead class="table-light">
                            <tr>

                                <th></th>
                                <th>Nama Lengkap </th>
                                <th>Nama Pengguna</th>
                                <th>Peran</th>
                                <th>Bidang</th>
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
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-md-0">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2 pb-0">Ubah Peran</h3>
                            <p>Atur peran permission</p>
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
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Batal</button>
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
                                <option value="" selected>Pilih Peran</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <label for="roleSelect">Pilih Peran</label>

                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div id="bidangSelectContainer" style="display: none;"
                            class="form-floating form-floating-outline mb-4">
                            <select id="bidangSelect" name="bidang" class="select2 form-select"
                                data-allow-clear="true">
                                <option value="" selected>Pilih Bidang</option>
                                <!-- Tambahkan opsi bidang di sini -->
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                                @endforeach
                            </select>
                            <label for="bidangSelect">Pilih Bidang</label>
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
