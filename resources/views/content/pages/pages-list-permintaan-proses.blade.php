@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
    <h4>List Permintaan</h4>
    <div class="col-md mb-4 mb-md-2">
        <div class="accordion mt-3" id="accordionWithIcon">

            <div class="accordion-item">
                <h2 class="accordion-header d-flex align-items-center">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionWithIcon-3" aria-expanded="false">
                        <i class="mdi mdi-account me-4"></i>
                        <div>
                            <div><strong>Judul:</strong> Permintaan Instalasi Perangkat Lunak</div>
                            <div><strong>Status:</strong> Sedang Diproses</div>
                        </div>
                    </button>
                </h2>
                <div id="accordionWithIcon-3" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="card card-action mb-4">
                            <div class="card-header align-items-center">
                                <h5 class="card-action-title mb-0"><i
                                        class='mdi mdi-format-list-bulleted mdi-24px me-2'></i>Activity Timeline</h5>

                            </div>
                            <div class="card-body pt-3 pb-0">
                                <ul class="timeline mb-0">
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-danger"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Client Meeting</h6>
                                                <small class="text-muted">Today</small>
                                            </div>
                                            <p class="mb-2">Project meeting with john @10:15am</p>
                                            <div class="d-flex flex-wrap">
                                                <div class="avatar me-3">
                                                    <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                                    <span>CEO of Infibeam</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-primary"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Create a new project for client</h6>
                                                <small class="text-muted">2 Day Ago</small>
                                            </div>
                                            <p class="mb-0">Add files to new design folder</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-warning"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Shared 2 New Project Files</h6>
                                                <small class="text-muted">6 Day Ago</small>
                                            </div>
                                            <p class="mb-2">Sent by Mollie Dixon <img
                                                    src="{{ asset('assets/img/avatars/4.png') }}"
                                                    class="rounded-circle me-3" alt="avatar" height="24"
                                                    width="24"></p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="javascript:void(0)" class="me-3">
                                                    <img src="{{ asset('assets/img/icons/misc/doc.png') }}"
                                                        alt="Document image" width="15" class="me-2">
                                                    <span class="fw-medium text-body">App Guidelines</span>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('assets/img/icons/misc/xls.png') }}"
                                                        alt="Excel image" width="15" class="me-2">
                                                    <span class="fw-medium text-body">Testing Results</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent border-transparent">
                                        <span class="timeline-point timeline-point-info"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Project status updated</h6>
                                                <small class="text-muted">10 Day Ago</small>
                                            </div>
                                            <p class="mb-0">Woocommerce iOS App Completed</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="accordion mt-3" id="accordionWithIcon">

            <div class="accordion-item">
                <h2 class="accordion-header d-flex align-items-center">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionWithIcon-2" aria-expanded="false">
                        <i class="mdi mdi-account me-4"></i>
                        <div>
                            <div><strong>Judul:</strong> Permintaan Server</div>
                            <div><strong>Status:</strong> Selesai</div>
                        </div>
                    </button>
                </h2>
                <div id="accordionWithIcon-2" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="card card-action mb-4">
                            <div class="card-header align-items-center">
                                <h5 class="card-action-title mb-0"><i
                                        class='mdi mdi-format-list-bulleted mdi-24px me-2'></i>Activity Timeline</h5>

                            </div>
                            <div class="card-body pt-3 pb-0">
                                <ul class="timeline mb-0">
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-danger"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Client Meeting</h6>
                                                <small class="text-muted">Today</small>
                                            </div>
                                            <p class="mb-2">Project meeting with john @10:15am</p>
                                            <div class="d-flex flex-wrap">
                                                <div class="avatar me-3">
                                                    <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                                    <span>CEO of Infibeam</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-primary"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Create a new project for client</h6>
                                                <small class="text-muted">2 Day Ago</small>
                                            </div>
                                            <p class="mb-0">Add files to new design folder</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-warning"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Shared 2 New Project Files</h6>
                                                <small class="text-muted">6 Day Ago</small>
                                            </div>
                                            <p class="mb-2">Sent by Mollie Dixon <img
                                                    src="{{ asset('assets/img/avatars/4.png') }}"
                                                    class="rounded-circle me-3" alt="avatar" height="24"
                                                    width="24"></p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="javascript:void(0)" class="me-3">
                                                    <img src="{{ asset('assets/img/icons/misc/doc.png') }}"
                                                        alt="Document image" width="15" class="me-2">
                                                    <span class="fw-medium text-body">App Guidelines</span>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('assets/img/icons/misc/xls.png') }}"
                                                        alt="Excel image" width="15" class="me-2">
                                                    <span class="fw-medium text-body">Testing Results</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent border-transparent">
                                        <span class="timeline-point timeline-point-info"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Project status updated</h6>
                                                <small class="text-muted">10 Day Ago</small>
                                            </div>
                                            <p class="mb-0">Woocommerce iOS App Completed</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
