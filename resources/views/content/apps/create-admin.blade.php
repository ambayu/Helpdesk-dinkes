@extends('layouts/layoutMaster')

@section('title', 'Permission - Apps')

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

    <script src="{{ asset('assets/js/app-access-permission.js') }}"></script>
    <script src="{{ asset('assets/js/modal-add-permission.js') }}"></script>
    <script src="{{ asset('assets/js/modal-edit-permission.js') }}"></script>

@endsection

@section('content')
    <h4 class="py-3 mb-2">Create Admin Access</h4>
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
    <p class="mb-4">Silahkan isi data dibawah ini untuk menambah admin</p>

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Form</h5> <small class="text-body float-end"></small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('create-admin.store') }}">
                    @csrf

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="basic-default-fullname" name="name"
                            placeholder="John Doe" />
                        <label for="basic-default-fullname">Full Name</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="basic-default-username" name="username"
                            placeholder="admin1" />
                        <label for="basic-default-username">Username </label>
                    </div>


                    <div class="mb-4">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="basic-default-email" name="email" class="form-control"
                                    placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-default-email2" />
                                <label for="basic-default-email">Email</label>
                            </div>
                            <span class="input-group-text" id="basic-default-email2">@example.com</span>
                        </div>

                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="password" id="basic-default-phone" name="password" class="form-control phone-mask"
                            placeholder="658 799 8941" />
                        <label for="basic-default-phone">Password</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>


@endsection
