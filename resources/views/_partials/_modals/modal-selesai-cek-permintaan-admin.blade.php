<!-- Add Permission Modal -->
<div class="modal fade" id="selesaiCekPermintaanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1">Kirim Respon Selesai</h3>
                    <p>Kirim respon selesai mengenai formulir yang telah diproses</p>
                </div>
                <form id="form-selesai" class="row" action="" method="post">
                    @csrf

                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <textarea style="height: 150px" type="textarea" id="respon" name="respon" class="form-control"
                                placeholder="Hii, silahkan masukkan deskripsi  mengenai formulir yang telah diproses" autofocus></textarea>
                            <label for="respon">Respon yang ingin dikirim</label>
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
