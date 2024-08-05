@extends('layouts/layoutMaster')

@section('title', 'User Profile - Profile')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
@endsection

<!-- Page -->
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection


@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-user-view-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">User Profile /</span> Profile
    </h4>

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ $user->profile_photo_path ? Storage::url($user->profile_photo_path) : asset('assets/img/avatars/1.png') }}"
                            alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $user->name }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item">
                                        <i class='mdi mdi-invert-colors me-1 mdi-20px'></i><span
                                            class="fw-medium">{{ $user->role }}</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class='mdi mdi-map-marker-outline me-1 mdi-20px'></i><span
                                            class="fw-medium">Medan, Indonesia</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class='mdi mdi-calendar-blank-outline me-1 mdi-20px'></i><span class="fw-medium">
                                            Joined {{ $user->date }}</span>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary">
                                <i class='mdi mdi-account-check-outline me-1'></i>Connected SSO
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- Navbar pills -->
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                            class='mdi mdi-account-outline me-1 mdi-20px'></i>Profile</a></li>
                @if ($user->role != 'User')
                    <li class="nav-item"><a class="nav-link" href="{{ url('pages/profile-teams') }}"><i
                                class='mdi mdi-account-multiple-outline me-1 mdi-20px'></i>Teams</a></li>
                @endif

                {{--  <li class="nav-item"><a class="nav-link" href="{{ url('pages/profile-projects') }}"><i
                            class='mdi mdi-view-grid-outline me-1 mdi-20px'></i>Projects</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link" href="{{ url('pages/profile-connections') }}"><i
                            class='mdi mdi-link me-1 mdi-20px'></i>Connections SSO</a></li> --}}
            </ul>
        </div>
    </div>
    <!--/ Navbar pills -->

    <!-- User Profile Content -->
    <div class="row">
        <div class=" {{ $user->role != 'User' ? 'col-xl-6 col-lg-6 col-md-6' : 'col-xl-12 col-lg-12 col-md-12' }}">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">About</small>
                    <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-account-outline mdi-24px"></i><span
                                class="fw-medium mx-2">Full Name:</span> <span>{{ $user->name }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-check mdi-24px"></i><span
                                class="fw-medium mx-2">Status:</span> <span>{{ $user->status }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-star-outline mdi-24px"></i><span
                                class="fw-medium mx-2">Role:</span> <span>{{ $user->role }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-flag-outline mdi-24px"></i><span
                                class="fw-medium mx-2">Country:</span> <span>Indonesia</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-translate mdi-24px"></i><span
                                class="fw-medium mx-2">Languages:</span> <span>Indonesia</span></li>
                    </ul>
                    <small class="card-text text-uppercase">Contacts</small>
                    <ul class="list-unstyled my-3 py-1">
                        {{-- <li class="d-flex align-items-center mb-3"><i class="mdi mdi-phone-outline mdi-24px"></i><span
                                class="fw-medium mx-2">Contact:</span> <span>(123) 456-7890</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-message-outline mdi-24px"></i><span
                                class="fw-medium mx-2">Skype:</span> <span>john.doe</span></li> --}}
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-email-outline mdi-24px"></i><span
                                class="fw-medium mx-2">Email:</span> <span>{{ $user->email }}</span></li>
                    </ul>

                    <small class="card-text text-uppercase">Teams </small>
                    <ul class="list-unstyled mb-0 mt-3 pt-1">
                        <li class="d-flex align-items-center mb-3"><i
                                class="mdi mdi-github mdi-24px text-secondary me-2"></i>
                            <div class="d-flex flex-wrap"><span
                                    class="fw-medium me-2">{{ $user->role }}</span><span>({{ $user->roleCount }}
                                    Members)</span></div>
                        </li>

                    </ul>
                </div>
            </div>

            <!--/ About User -->
            <!-- Profile Overview -->
            @if ($user->role != 'User')
                <div class="card mb-4">
                    <div class="card-body">
                        <small class="card-text text-uppercase">Overview</small>
                        <ul class="list-unstyled mb-0 mt-3 pt-1">
                            <li class="d-flex align-items-center mb-3"><i class="mdi mdi-check mdi-24px"></i><span
                                    class="fw-medium mx-2">Task Compiled:</span> <span>13.5k</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="mdi mdi-account-outline mdi-24px"></i><span
                                    class="fw-medium mx-2">Projects Proses:</span> <span>146</span></li>
                            <li class="d-flex align-items-center"><i class="mdi mdi-view-grid-outline mdi-24px"></i><span
                                    class="fw-medium mx-2">Pending:</span> <span>897</span></li>
                        </ul>
                    </div>
                </div>
            @endif



            <!--/ Profile Overview -->
        </div>
        @if ($user->role != 'User')

            <div class="col-lg-6 col-xl-6">
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">Teams ({{ $user->role }})</h5>
                        <div class="card-action-element">
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="mdi mdi-dots-vertical mdi-24px text-muted"></i></button>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach ($user->user_role as $role_user)
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar me-3">
                                                <img src="{{ $role_user->profile_photo_path ? Storage::url($role_user->profile_photo_path) : asset('assets/img/avatars/1.png') }}"
                                                    alt="Avatar" class="rounded-circle">
                                            </div>
                                            <div class="me-2">
                                                <h6 class="mb-0">{{ $role_user->name }}</h6>
                                                <small>{{ $role_user->email }}</small>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="javascript:;"><span
                                                    class="badge bg-label-danger rounded-pill"></span></a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <li class="text-center">
                                {{-- <a href="javascript:;">View all teams</a> --}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!--/ User Profile Content -->
@endsection
