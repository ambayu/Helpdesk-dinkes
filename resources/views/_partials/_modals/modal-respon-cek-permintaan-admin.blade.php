<!-- Add Permission Modal -->
<div class="modal fade" id="responCekPermintaanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1">Ubah Data</h3>
                    <p>Anda tetap bisa mengubah data selama status permintaan masih ditinjau atau belum diproses</p>
                </div>
                <form id="form-respon" class="row" action="" method="post" enctype="multipart/form-data">
                    @csrf


                    <!-- Judul permintaan -->
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                            name="judul" placeholder="Masukkan Judul" autofocus value="{{ old('judul') }}">
                        <label for="judul">Judul permintaan</label>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="layanan-create">

                    </div>


                    <!-- Deskripsi -->
                    <div class="form-floating form-floating-outline mb-3">
                        <div class="input-group input-group-merge mb-4">
                            <span id="basic-icon-default-message2" class="input-group-text"><i
                                    class="mdi mdi-message-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <textarea id="basic-icon-default-message" class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Hi, Silahkan masukkan deskripsi permintaan anda" aria-label="Deskripsi"
                                    aria-describedby="basic-icon-default-message2" style="height: 160px;" name="deskripsi"
                                    value="{{ old('deskripsi') }}"></textarea>
                                <label for="basic-icon-default-message">Deskripsi</label>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>




                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 kirim-respon">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
