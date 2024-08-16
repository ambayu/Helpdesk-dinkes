@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
    <h4>List Permintaan</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Permintaan Pergantian Petugas Layanan</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Detail</th>
                        <th>Petugas</th>
                        <th>Status</th>
                        <th>Layanan</th>
                        <th>Permintaan</th>
                        <th>Deskripsi</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td><i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i><span class="fw-medium">Permintan
                                Server</span></td>
                        <td> <button type="button" data-bs-toggle="modal" data-bs-target="#basicModal"
                                class="btn btn-icon btn-primary waves-effect waves-light">
                                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline"></span>
                            </button>
                        </td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>

                            </ul>
                        </td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Active</span></td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Teknis</span></td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Server</span></td>
                        <td>Seharusnya ke Server karena judul pembuatan server</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#shareProject"><i class="mdi mdi-pencil-outline me-1"></i>Terima</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="mdi mdi-trash-can-outline me-1"></i> Tolak</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="mdi mdi-basketball mdi-20px text-info me-3"></i><span class="fw-medium">Permintaan
                                Website</span></td>
                        <td><button type="button" data-bs-toggle="modal" data-bs-target="#basicModal"
                                class="btn btn-icon btn-primary waves-effect waves-light">
                                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline"></span>
                            </button></td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                    <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Christina Parker">
                                    <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge rounded-pill bg-label-success me-1">Completed</span></td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Teknis</span></td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Server</span></td>
                        <td>Seharusnya ke Server karena judul pembuatan server</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#shareProject"><i class="mdi mdi-pencil-outline me-1"></i>Terima</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="mdi mdi-trash-can-outline me-1"></i> Tolak</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="mdi mdi-greenhouse mdi-20px text-success me-3"></i><span class="fw-medium">Greenhouse
                                Project</span></td>
                        <td><button type="button" data-bs-toggle="modal" data-bs-target="#basicModal"
                                class="btn btn-icon btn-primary waves-effect waves-light">
                                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline"></span>
                            </button></td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                    <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Christina Parker">
                                    <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge rounded-pill bg-label-info me-1">Scheduled</span></td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Teknis</span></td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Server</span></td>
                        <td>Seharusnya ke Server karena judul pembuatan server</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#shareProject"><i
                                            class="mdi mdi-pencil-outline me-1"></i>Terima</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="mdi mdi-trash-can-outline me-1"></i> Tolak</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="mdi mdi-bank mdi-20px text-primary me-3"></i><span class="fw-medium">Bank
                                Project</span></td>
                        <td><button type="button" data-bs-toggle="modal" data-bs-target="#basicModal"
                                class="btn btn-icon btn-primary waves-effect waves-light">
                                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline"></span>
                            </button></td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                    <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Christina Parker">
                                    <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge rounded-pill bg-label-warning me-1">Pending</span></td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Teknis</span></td>
                        <td><span class="badge rounded-pill bg-label-primary me-1">Server</span></td>
                        <td>Seharusnya ke Server karena judul pembuatan server</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#shareProject"><i
                                            class="mdi mdi-pencil-outline me-1"></i>Terima</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="mdi mdi-trash-can-outline me-1"></i> Tolak</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Detail Permintaan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" disabled id="nameBasic" class="form-control" placeholder="Judul">
                                <label for="nameBasic">Judul</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-2">
                            <div class="form-floating form-floating-outline">

                                <button type="button" class="btn btn-primary waves-effect waves-light">
                                    Download File
                                </button>


                            </div>
                        </div>

                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col mb-2">
                            <div class="form-floating form-floating-outline">

                                <textarea disabled class="form-control" style="height: 100px;" name="eventDescription" id="eventDescription"></textarea>
                                <label for="eventDescription">Description</label>

                            </div>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
    @include('_partials/_modals/modal-share-project')

@endsection
