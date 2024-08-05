<!-- Add Permission Modal -->
<div class="modal fade" id="responCekPermintaanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1">Kirim Respon</h3>
                    <p>Kirim respon mengenai kelengkapan dari formulir yang telah diisi</p>
                </div>
                <form id="form-respon" class="row" action="" method="post" enctype="multipart/form-data">
                    @csrf





                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">

                            <textarea style="height: 150px" type="textarea" id="respon" name="respon" class="form-control"
                                placeholder="Hii, silahkan masukkan respon yang ingin dikirim" autofocus></textarea>
                            <label for="respon">Respon yang ingin dikirim</label>
                        </div>
                        <span class="text-danger"><small>jika file lebih dari 2mb silahkan simpan di google drive dan
                                linknya
                                di sematkan di dalam respon</small> </span>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="file" class="form-control" id="file" name="file"
                                placeholder="Cari ">
                            <label for="file">Masukkan File (jpg,jpeg,png,pdf,doc,docx,xls,xlsx)
                                <span class="text-danger">file tidak boleh lebih dari 2mb</span></label>
                        </div>
                    </div>

                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 kirim-respon">Kirim
                            respon</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
