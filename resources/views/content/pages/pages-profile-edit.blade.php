@extends('layouts/layoutMaster')

@section('title', 'User Profile - Teams')

<!-- Page -->
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection
@section('page-script')

    <script>
        $('#photos').on('change', function() {
            console.log('asd');
            var input = this; // Store the input element reference
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#photo-preview-ubah').html('<div><img src="' + e.target.result +
                        '" class="img-fluid"  /></div>');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>

@endsection
<script></script>

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
                        <img src="{{ $user->profile_photo_path ? Storage::url($user->profile_photo_path) : asset('/assets/img/avatars/1.png') }}"
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
    <!-- Navbar pills -->
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                <li class="nav-item"><a class="nav-link" href="{{ url('pages/profile-user') }}"><i
                            class='mdi mdi-account-outline me-1 mdi-20px'></i>Profile</a></li>
                @if ($user->role != 'User')
                    <li class="nav-item"><a class="nav-link" href="{{ url('pages/profile-teams') }}"><i
                                class='mdi mdi-account-multiple-outline me-1 mdi-20px'></i>Teams</a></li>
                @endif
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                            class='mdi mdi-account-multiple-outline me-1 mdi-20px'></i>Edit</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-projects')}}"><i class='mdi mdi-view-grid-outline me-1 mdi-20px'></i>Projects</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-connections')}}"><i class='mdi mdi-link me-1 mdi-20px'></i>Connections</a></li> --}}
            </ul>
        </div>
    </div>
    <!--/ Navbar pills -->

    <!-- Teams Cards -->
    <div class="row g-4">
        <div class="col-md-12 col-sm-12">

            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">Edit Foto Profil </small>
                    <form id="formUbahDosen" class="row" action="{{ url('/pages/profile-edit') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-2 md-3">
                            <div id="photo-preview-ubah" class=" d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 mt-4"
                                    src="{{ auth()->user()->profile_photo_path ?? asset('assets/img/avatars/1.png') }}"
                                    height="220" width="220" alt="User avatar" />

                            </div>

                        </div>
                        <div class="col-10 mb-3">
                            <div class="mb-3 form-floating form-floating-outline">
                                <input type="file" id="photos" name="photo" class="form-control">
                                <label for="photo">Foto</label>

                            </div>
                            <label for="">Username</label>

                            <div class="mb-3 form-floating form-floating-outline">
                                <input type="text" id="username" name="username"
                                    class="form-control text-light bg-secondary" readonly
                                    value="{{ auth()->user()->username }}" placeholder="Username" />
                            </div>
                            <label for="">Email</label>

                            <div class="mb-3 form-floating form-floating-outline">
                                <input type="text" id="email" name="email"
                                    class="form-control bg-secondary text-light" readonly
                                    value="{{ auth()->user()->email }}" placeholder="Email" readonly />
                            </div>
                            <div class="mb-3 form-floating form-floating-outline">
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ auth()->user()->name }}" placeholder="Username" />
                                <label for="name">Nama Alias</label>
                            </div>
                            {{-- <div class="mb-3 form-floating form-floating-outline">
                                <input type="text" id="no_hp" name="no_hp" class="form-control"
                                    value="{{ auth()->user()->no_hp }}" placeholder="Nomor Hp" />
                                <label for="no_hp">Nomor Hp</label>
                            </div> --}}
                        </div>



                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Ubah Profil</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--/ Teams Cards -->


@endsection
