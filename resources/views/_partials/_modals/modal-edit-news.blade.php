<!-- Add Permission Modal -->
<div class="modal fade" id="editNews" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1">Update Kabar</h3>
                    <p>isi untuk mengupdate kabar</p>
                </div>
                <form id="" class="row" action="{{ route('news.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="judul" name="judul" class="form-control"
                                placeholder="Masukan Judul" autofocus />
                            <label for="judul">Judul</label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="link" name="link" class="form-control"
                                placeholder="www.zoom.com" autofocus />
                            <label for="link">Link</label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control"
                                placeholder=" Masukkan Deskripsi" autofocus />
                            <label for="deskripsi">Deskripsi</label>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="date" id="tanggal" name="tanggal" class="form-control"
                                placeholder=" Masukkan tanggal" autofocus />
                            <label for="tanggal">Tanggal</label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="durasi" name="durasi" class="form-control"
                                placeholder=" 32 Menit" autofocus />
                            <label for="durasi">Durasi</label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="file" id="photo" name="photo" class="form-control"
                                placeholder="www.zoom.com" autofocus />
                            <label for="photo">Photo</label>
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
