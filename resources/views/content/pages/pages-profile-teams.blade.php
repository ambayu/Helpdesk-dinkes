@extends('layouts/layoutMaster')

@section('title', 'User Profile - Teams')

<!-- Page -->
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection


@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">User Profile /</span> Teams
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
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
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
                <li class="nav-item"><a class="nav-link" href="{{ url('pages/profile-user') }}"><i
                            class='mdi mdi-account-outline me-1 mdi-20px'></i>Profile</a></li>
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                            class='mdi mdi-account-multiple-outline me-1 mdi-20px'></i>Teams</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-projects')}}"><i class='mdi mdi-view-grid-outline me-1 mdi-20px'></i>Projects</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-connections')}}"><i class='mdi mdi-link me-1 mdi-20px'></i>Connections</a></li> --}}
            </ul>
        </div>
    </div>
    <!--/ Navbar pills -->

    <!-- Teams Cards -->
    <div class="row g-4">
        @foreach ($user->all_role as $all_role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <a href="{{ route('app-access-roles.index') }}" class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-2">
                                    <img src="{{ asset('assets/img/icons/brands/react-label.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </div>
                                <div class="me-2 text-heading h5 mb-0">
                                    {{ $all_role->name }}
                                </div>
                            </a>

                        </div>
                        <p>We don’t make assumptions about the rest of your technology stack, so you can develop new
                            features in
                            React.</p>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @foreach ($all_role->users as $users)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="{{ $users->name }}" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="{{ asset('assets/img/avatars/' . $users->id . '.png') }}"
                                                alt="Avatar">
                                        </li>
                                    @endforeach
                                    @if ($all_role->users_count > 3)
                                        <li class="avatar avatar-sm">
                                            <span class="avatar-initial rounded-circle pull-up bg-lighter text-body"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $all_role->users_count - 3 }} more">+{{ $all_role->users_count - 3 }}</span>
                                        </li>
                                    @endif

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <!--/ Teams Cards -->
@endsection
