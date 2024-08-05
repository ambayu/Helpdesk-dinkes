<!-- Add Permission Modal -->
<div class="modal fade" id="pindahCekPermintaanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1"> Pemindahan Layanan </h3>
                    <p>Kirim respon permohonan pemindahan Layanan karena ketidak sesuaian layanan yang diisi dan
                        pengajuan
                        untuk dipindahkan ke layanan lain
                    </p>
                </div>
                <form id="form-pindah" class="row" action="" method="post">
                    @csrf
                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <select id="ubah_bidang" name="ubah_bidang" class="select2 form-select"
                                data-allow-clear="true">
                                <option value="">Pilih Layanan Pengganti</option>
                                @foreach ($menu as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <textarea style="height: 150px" type="textarea" id="respon" name="respon" class="form-control"
                                placeholder="Hii, silahkan masukkan tujuan pemindahan layanan dan alasannya" autofocus></textarea>
                            <label for="nama_bidang">Respon yang ingin dikirim</label>
                        </div>
                    </div>

                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Kirim respon</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
