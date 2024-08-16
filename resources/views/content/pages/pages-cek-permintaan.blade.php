@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')


@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/rateyo/rateyo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/rateyo/rateyo.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-star-ratings.js') }}"></script>

    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/modal-respon-cek-permintaan.js') }}"></script>
@endsection

@section('content')
    <h4>List Permintaan</h4>
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
    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('cek-permintaan.search') }}" method="post" class="row g-3">
            @csrf
            <div class="col-auto">
                <label for="searchJudul" class="visually-hidden">Cari berdasarkan Judul</label>
                <input type="text" class="form-control" id="searchJudul" name="search" placeholder="Cari ">
            </div>
            <div class="col-auto">
                <label for="startDate" class="visually-hidden">Tanggal Mulai</label>
                <input type="date" class="form-control" id="startDate" name="startDate">
            </div>
            <div class="col-auto">
                <label for="endDate" class="visually-hidden">Tanggal Selesai</label>
                <input type="date" class="form-control" id="endDate" name="endDate">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Cari</button>
            </div>
        </form>
    </div>

    <div class="accordion mt-3" id="answer">

        @foreach ($dataObject as $answer)

            <div class="accordion-item">
                <h2 class="accordion-header d-flex align-items-center">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#answer-{{ $answer->id }}" aria-expanded="false">
                        <i class="mdi mdi-account me-4"></i>
                        <div style="display: flex; justify-content: space-between; align-items: flex-end; width: 100%;">
                            <div>
                                <div><strong>Judul:</strong> {{ $answer->judul }}</div>
                                {{-- <div><strong>status_answer:</strong> {{ $answer->id_status_answer }}</div> --}}
                                {{-- status dari answer --}}
                                <div><strong>Status:</strong> {{ $answer->status->name }}</div>
                                <div><small {{-- status yang diambil dari ticket --}}
                                        class=" {{ $answer->id_status_answer == '9' ? 'text-success' : 'text-warning' }}">{{ $answer->status_answer->name }}</small>
                                </div>

                            </div>
                            <div style="text-align: right;">
                                <div><strong>Tanggal:</strong> {{ $answer->tanggal_kirim }}</div>
                                <div><small><strong>Nomor Tiket:</strong> {{ $answer->nomor_tiket }}</small></div>
                                <div><small><strong>layanan:</strong> {{ $answer->layanan }}</small></div>
                            </div>
                        </div>
                        @if ($role != 'User')
                            @if ($answer->id_status_answer >= 8)
                                <div class="alert alert-success m-2 pl-1" role="alert">
                                    Selesai

                                </div>
                            @else
                                <button class="btn btn-danger m-4" type="button"
                                    id="organicSessionsDropdown-{{ $answer->id }}" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>

                                <div class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="organicSessionsDropdown-{{ $answer->id }}">
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="showResponModal({{ $answer->id }})">Respon</a>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                        onclick="showPindahModal({{ $answer->id }})"
                                        data-bs-target="#pindahCekPermintaanModal">Pindahkan Kelayanan Lain</a>
                                    <a class="dropdown-item text-success" href="javascript:void(0);"
                                        onclick="showSelesaiModal({{ $answer->id }})">Permintaan Selesai</a>
                                </div>
                            @endif
                        @else
                            @if ($answer->id_status_answer == 0)
                                <button class="btn btn-danger m-4" type="button" id="editPermintaan-{{ $answer->id }}"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>

                                <div class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="editPermintaan-{{ $answer->id }}">
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="showEditPermintaanModal('{{ $answer->id }}')">Edit </a>

                                    <a class="dropdown-item text-success" href="javascript:void(0);"
                                        onclick="deleteAnswer({{ $answer->id }})">Hapus</a>
                                </div>
                            @endif
                        @endif




                    </button>


                </h2>
                <div id="answer-{{ $answer->id }}" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="card card-action mb-4">
                            <div class="card-header align-items-center">
                                <h5 class="card-action-title mb-0"><i
                                        class='mdi mdi-format-list-bulleted mdi-24px me-2'></i>Riwayat Kegiatan</h5>

                            </div>
                            <div class="card-body pt-3 pb-0">
                                <ul class="timeline mb-0">
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-danger"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Usulan</h6>
                                                <small class="text-muted">{{ $answer->tanggal_kirim }}</small>
                                            </div>
                                            <p class="m-0"><strong>Judul :</strong> {{ $answer->judul }}</p>
                                            <p class="m-0"><strong>Nomor Tiket :</strong> {{ $answer->nomor_tiket }}
                                            </p>
                                            <p class="m-0"><strong>Bidang :</strong>
                                                @foreach ($answer->bidang as $index => $bidang)
                                                    {{ $bidang }}
                                                    @if ($index < count($answer->bidang) - 1)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </p>
                                            <p class="mb-0"><strong>Layanan :</strong> {{ $answer->menu->nama_layanan }}
                                            </p>
                                            @if ($answer->pindah_layanan)
                                                <p class="mb-0"><strong>Layanan Baru :</strong>
                                                    {{ $answer->pindah_layanan->menu_baru->nama_layanan ?? '' }}
                                                </p>
                                            @endif


                                            <div class="d-flex flex-wrap">
                                                <div class="avatar me-3">
                                                    <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $answer->nama }}</h6>
                                                    <span>{{ $answer->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-primary"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Data data yang diperlukan</h6>

                                            </div>

                                            @foreach ($answer->formulir as $formulir)
                                                <div>
                                                    <strong>
                                                        @if ($formulir->type_formulir == 3)
                                                            {{ Str::before($formulir->pertanyaan, ':') }}
                                                        @else
                                                            {{ $formulir->pertanyaan }}
                                                        @endif
                                                    </strong>
                                                </div>
                                                <div>
                                                    {{ $formulir->respon }}

                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                    @if ($answer->file)
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-warning"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header mb-1">
                                                    <h6 class="mb-0">File</h6>
                                                </div>

                                                <div class="d-flex flex-wrap gap-2">

                                                    <a href="{{ Storage::url($answer->file) }}" class="me-3">
                                                        <img src="{{ asset('assets/img/icons/misc/doc.png') }}"
                                                            alt="Document image" width="15" class="me-2">
                                                        <span class="fw-medium text-body">Unduh</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    <li class="timeline-item timeline-item-transparent border-transparent">
                                        <span class="timeline-point timeline-point-info"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">Deskripsi tambahan</h6>
                                                {{-- <small class="text-muted">10 Day Ago</small> --}}
                                            </div>
                                            <p class="mb-0">{{ $answer->deskripsi }}</p>
                                        </div>
                                    </li>
                                    @if ($answer->respon_answer)
                                        <h2>Respon</h2>



                                        @foreach ($answer->respon_answer as $respon_answer)
                                            <li
                                                class="timeline-item timeline-item-transparent  {{ $answer->id_status_answer == 8 ? 'border-transparent' : '' }}">
                                                <span
                                                    class="timeline-point  {{ $answer->id_status_answer == 8 ? 'timeline-point-success' : 'timeline-point-warning' }} "></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">
                                                            {{ $respon_answer->user->name . '(' . $respon_answer->user->roles[0]->name . ')' }}

                                                            {{ $respon_answer->user->role_bidang->bidang->nama_bidang ?? '' }}
                                                        </h6>
                                                        <small
                                                            class="text-muted">{{ \Carbon\Carbon::parse($respon_answer->created_at) }}</small>
                                                        {{-- <small class="text-muted">10 Day Ago</small> --}}
                                                    </div>
                                                    <p class="mb-0">{{ $respon_answer->description }}</p>

                                                    @if ($respon_answer->file)
                                                        {{-- file upload --}}
                                                        <h6 class="mb-0">File Terlampir</h6>
                                                        <div class="d-flex flex-wrap gap-2">

                                                            <a href="{{ asset('storage/' . $respon_answer->file) }}"
                                                                class="me-3">
                                                                <img src="{{ asset('assets/img/icons/misc/doc.png') }}"
                                                                    alt="Document image" width="15" class="me-2">
                                                                <span class="fw-medium text-body">File Upload</span>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                            </li>
                                        @endforeach
                                        @if ($role == 'User')
                                            @if ($answer->id_status_answer != 4 && $answer->id_status_answer < 8)
                                                <div class="mb-4">
                                                    <button class="btn btn-primary"
                                                        onclick="showResponModal({{ $answer->id }})">Balas</button>

                                                </div>
                                            @elseif ($answer->id_status_answer == 8)
                                                <div class="mb-4">
                                                    <button class="btn btn-warning"
                                                        onclick="showPenilaianModal({{ $answer->id }})">Kirimkan
                                                        Penilaian</button>

                                                </div>
                                            @elseif ($answer->id_status_answer == 9)
                                                <div class="alert alert-success" role="alert">
                                                    Terimakasih atas penilaiannya . . .
                                                </div>
                                            @else
                                                <div class="alert alert-primary" role="alert">
                                                    Respon anda sedang di tinjau oleh admin, silahkan
                                                    menunggu . . .
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="d-flex
                                                justify-content-center mt-4">
        {{ $answers->links() }}
    </div>
    </div>

    @include('_partials/_modals/modal-respon-cek-permintaan-admin')
    @include('_partials/_modals/modal-edit-permintaan')
    @include('_partials/_modals/modal-penilaian-cek-permintaan')
    @include('_partials/_modals/modal-pindah-cek-permintaan-admin')
    @include('_partials/_modals/modal-selesai-cek-permintaan-admin')

@endsection
