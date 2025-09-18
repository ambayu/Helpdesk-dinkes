@foreach ($menus as $menu)
    <!-- Add Permission Modal -->
    <div class="modal fade" id="editLayanan{{ $menu->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body p-md-0">
                    <div class="text-center mb-4">
                        <h3 class="mb-2 pb-1">Ubah Layanan {{ $menu->nama_layanan }}</h3>
                        <p>Ubah Layanan sesuai dengan ketentuan yang ada </p>

                    </div>
                    <form class="source-item pt-1" action="{{ route('kelola-layanan.update', ['menu' => $menu->id]) }}"
                        method="POST">
                        @csrf

                        @method('PUT')
                        <div class="mb-3" data-repeater-list="inputan">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="name_layanan" name="nama_layanan"
                                    value="{{ $menu->nama_layanan }}" class="form-control"
                                    placeholder="Layanan Aplikasi">
                                <label for="name_layanan" class="@error('name_layanan') is-invalid @enderror">Nama
                                    Layanan</label>
                                @error('name_label')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>




                            @foreach ($menu->formulir as $formulir)
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                                    <div class="d-flex border rounded position-relative pe-0">
                                        <div class="row w-100 p-3">
                                            <div class="col-md-7 col-12 mb-md-0 mb-3">
                                                <h6 class="mb-2 repeater-title fw-medium">Nama Inputan</h6>
                                                <input type="text" id="collapsible-label_name" name="name_label"
                                                    value="{{ $formulir->formulir }}" class="form-control"
                                                    placeholder="Alamat Lengkap">
                                            </div>

                                            <div class="col-md-5 col-12 mb-md-0 mb-3 ">
                                                <h6 class="mb-2 repeater-title fw-medium">Input Type</h6>

                                                <div class="form-check form-check-inline">
                                                    <input name="input_type" class="form-check-input input-type" checked
                                                        type="radio" value="1" id="text">
                                                    <label class="form-check-label" for="text">Text</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="input_type" class="form-check-input input-type"
                                                        type="radio" value="2" id="textarea">
                                                    <label class="form-check-label" for="textarea">Textarea</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="input_type" class="form-check-input input-type"
                                                        type="radio" value="3" id="choice">
                                                    <label class="form-check-label" for="choice">Pilihan</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="input_type" class="form-check-input input-type"
                                                        type="radio" value="4" id="file">
                                                    <label class="form-check-label" for="file">File</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="input_type" class="form-check-input input-type"
                                                        type="radio" value="5" id="file">
                                                    <label class="form-check-label" for="file">Kelompok</label>
                                                </div>

                                                <!-- Tempat untuk opsi pilihan -->
                                                <div class="choice-options mt-3" style="display: none;">
                                                    <h6 class="mb-2">Tambahkan Pilihan</h6>
                                                    <div data-repeater-list="pilihan">
                                                        <div data-repeater-item class="d-flex mb-2">
                                                            <input type="text" name="nama_pilihan"
                                                                class="form-control me-2" placeholder="Isi pilihan" />
                                                            <button type="button" data-repeater-delete
                                                                class="btn btn-sm btn-danger">X</button>
                                                        </div>
                                                    </div>
                                                    <button type="button" data-repeater-create
                                                        class="btn btn-sm btn-success mt-2">
                                                        + Tambah Pilihan
                                                    </button>
                                                </div>
                                            </div>


                                        </div>
                                        <div
                                            class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                            <i class="mdi mdi-close cursor-pointer" data-repeater-delete=""></i>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary" data-repeater-create><i
                                        class="mdi mdi-plus me-1"></i> Add Item</button>
                            </div>
                        </div>

                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--/ Add Permission Modal -->
@endforeach
