<!-- Add Permission Modal -->
<div class="modal fade" id="editBidangModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1">Ubah Peran Bidang </h3>
                    <p>Ubah peran bidang dari admin yang dipilih</p>

                </div>
                <form id="editBidang" class="row" action="" method="post">
                    @csrf
                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <select id="roleSelect" name="bidang" class="form-select" aria-label="Choose Plan">

                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                                @endforeach
                            </select>
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
