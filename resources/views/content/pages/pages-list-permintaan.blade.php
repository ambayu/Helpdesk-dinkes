@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
    <h4> Permintaan</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">List Permintaan</h5>


        <div class="accordion mt-3" id="accordionWithIcon">

            <div class="accordion-item">
                <h2 class="accordion-header d-flex align-items-center">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionWithIcon-3" aria-expanded="false">
                        <i class="mdi mdi-account me-4"></i>
                        <div>
                            <div><strong>Judul:</strong> Permintaan Instalasi Perangkat Lunak</div>
                            <div><strong>Status:</strong> Belum di proses</div>
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
                                                <h6 class="mb-0">Deskripsi</h6>
                                                <small class="text-muted">Today</small>
                                            </div>
                                            <p class="mb-2">Permintaan Pemasangan Lorem, ipsum dolor sit amet consectetur
                                                adipisicing elit. Autem ea impedit praesentium facilis qui nulla voluptas
                                                deleniti id voluptate expedita distinctio, nostrum earum perferendis unde
                                                vitae laboriosam. Provident, consectetur quo. www.googledrive.com</p>
                                            <div class="d-flex flex-wrap">
                                                <div class="avatar me-3">
                                                    <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Lester McCarthy (Pegawai)</h6>
                                                    <span>Dinas Perpustakaan dan kearsipan kota medan</span>
                                                </div>

                                            </div>
                                            <div class="timeline-header mb-1 mt-1">
                                                <h6 class="mb-0">File</h6>

                                            </div>
                                            <button class="btn-sm btn-primary rounded">download</button>
                                        </div>
                                        <div class="m-3">
                                            <button class="btn btn-primary">Kirim Respon</button>
                                            <button class="btn btn-primary">Permintaan Selesai</button>
                                        </div>


                                    </li>



                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!--/ Basic Bootstrap Table -->
        @include('_partials/_modals/modal-share-project')

    @endsection
