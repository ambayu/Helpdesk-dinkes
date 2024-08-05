<!-- Add Permission Modal -->
<div class="modal fade" id="pindahBidangModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-2">
                    <h2 class="mb-2 pb-1">Ganti Layanan </h2>
                    <p><small>Ganti layanan yang anda inginkan, jika anda tidak ingin mengganti layanan pilih kembali
                            layanan yang lama</small></p>
                    <br>
                </div>
                <form id="gantiBidang" class="row" action="" method="post">
                    @csrf



                    <ul class="p-0 m-0 mb-4">
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="modalBidang" name="id_layanan_baru"
                                class="select2 form-select @error('role') is-invalid @enderror" data-allow-clear="true"
                                required>
                                <option value="" selected>Pilih Layanan</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->nama_layanan }}</option>
                                @endforeach
                            </select>
                            <label for="modalBidang">Pilih Layanan</label>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </ul>

                    <div class="col-12  text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Ganti</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
