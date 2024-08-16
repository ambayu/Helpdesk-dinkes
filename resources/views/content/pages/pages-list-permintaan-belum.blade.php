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
                            <div><strong>Belum diproses:</strong> Belum Proses</div>
                        </div>
                    </button>
                </h2>

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
                            <div><strong>Status:</strong> Belum Diproses</div>
                        </div>
                    </button>
                </h2>

            </div>


        </div>
    </div>
@endsection
