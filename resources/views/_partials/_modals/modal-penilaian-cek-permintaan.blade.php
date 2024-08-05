<!-- Add Permission Modal -->
<div class="modal fade" id="penilaianCekPermintaanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1">Penilaian Kepuasan </h3>
                    <p>Berikan masukan dan juga tanggapan anda mengenai pelayanan kami, masukkan dan tanggapan sangat
                        berarti buat kami
                    </p>
                </div>
                <form id="form-penilaian" class="row" action="" method="post">
                    @csrf
                    <div class="col-12 mb-3">
                        <h6>Berikan Rating Kepuasan </h6>
                        <div class="full-star-ratings" data-rateyo-full-star="true" name='star' id="star"></div>
                        <label for="star"></label>
                        <input type="hidden" value="" id="ratingstar" name="star">
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <textarea style="height: 150px" type="textarea" id="respon" name="respon" class="form-control"
                                placeholder="Hii, silahkan masukkan tujuan pemindahan layanan dan alasannya" autofocus></textarea>
                            <label for="nama_bidang">Deskripsi Penilaian</label>
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
