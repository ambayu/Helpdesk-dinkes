@extends('layouts/layoutMaster')

@section('title', 'User View - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/modal-edit-user.js') }}"></script>
    <script src="{{ asset('assets/js/modal-enable-otp.js') }}"></script>
    <script src="{{ asset('assets/js/app-user-view.js') }}"></script>
    <script src="{{ asset('assets/js/app-user-view-security.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">User / View /</span> Security
    </h4>
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-3 mt-4"
                                src="{{ $user->profile_photo_path ? Storage::url($user->profile_photo_path) : asset('assets/img/avatars/1.png') }}"
                                height="120" width="120" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4>{{ $user->name }}</h4>
                                <span class="badge bg-label-danger rounded-pill">{{ $user->role }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap my-2 py-3">
                        <div class="d-flex align-items-center me-4 mt-3 gap-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class='mdi mdi-check mdi-24px'></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $ticketCounts['finish'] }}</h4>
                                <span>Permintaan Selesai</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3 gap-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class='mdi mdi-briefcase-variant-outline mdi-24px'></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="mb-0">
                                    {{ $ticketCounts['pending'] + $ticketCounts['proses'] + $ticketCounts['finish'] }}</h4>
                                <span>Total Permintaan</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-3 border-bottom mb-3">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Username:</span>
                                <span>{{ $user->username }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Email:</span>
                                <span>{{ $user->email }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Nomor Hp:</span>
                                <span>{{ $user->no_hp }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Status:</span>
                                <span class="badge bg-label-success rounded-pill">{{ $user->status }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Role:</span>
                                <span>{{ $user->role }}</span>
                            </li>
                            {{-- <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Tax id:</span>
                                <span>Tax-8965</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Contact:</span>
                                <span>(123) 456-7890</span>
                            </li> --}}
                            <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Languages:</span>
                                <span>Indonesia</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium text-heading me-2">Country:</span>
                                <span>Indonesia</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <!-- /User Card -->

        </div>
        <!--/ User Sidebar -->


        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
            <!-- User Tabs -->
            <ul class="nav nav-tabs mb-3">

                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                            class="mdi mdi-lock-open-outline mdi-20px me-1"></i>Security</a></li>

            </ul>
            <!--/ User Tabs -->

            <!-- Change Password -->
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
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
                <div class="card-body">
                    {{-- <form id="formChangePassword" method="POST"> --}}
                    @if ($user->role != 'User')
                        <form id="" action="{{ url('/app/user/view/account/' . $user->id) }}" method="POST">
                            @csrf
                            <div class="alert alert-warning" role="alert">
                                <h6 class="alert-heading mb-1">Ensure that these requirements are met</h6>
                                <span>Minimum 8 characters long, uppercase & symbol</span>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="password" id="newPassword" name="newPassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <label for="newPassword">New Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i
                                                class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="password" name="confirmPassword"
                                                id="confirmPassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <label for="confirmPassword">Confirm New Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i
                                                class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">Change Password</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning" role="alert">
                            <h6 class="alert-heading mb-1">Tidak dapat Mengubah Password User</h6>
                            <span>Super Admin Hanya dapat mengubah password sesama admin</span>
                        </div>
                    @endif
                </div>
            </div>
            <!--/ Change Password -->

            <!-- Two-steps verification -->

            <!--/ Two-steps verification -->


        </div>
        <!--/ User Content -->
    </div>

    <!-- Modals -->
    @include('_partials/_modals/modal-edit-user')
    @include('_partials/_modals/modal-enable-otp')
    @include('_partials/_modals/modal-upgrade-plan')
    <!-- /Modals -->

@endsection
