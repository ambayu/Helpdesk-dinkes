<!-- Add Permission Modal -->
<div class="modal fade" id="editBidangModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-md-0">
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1">Edit Bidang </h3>
                    <p>Edit nama bidang</p>

                </div>
                <form id="editBidang" class="row" action="" method="post">
                    @csrf
                    <div class="col-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="namabidang" name="nama_bidang" class="form-control"
                                placeholder="Nama Bidang" autofocus />
                            <label for="nama_bidang">Nama Bidang</label>
                        </div>
                    </div>

                    <h2>Pilih Layanan</h2>
                    <ul class="p-0 m-0">
                        @foreach ($menus as $menu)
                            <li class="d-flex mb-3 flex-wrap">
                                <div class="avatar me-3">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="avatar"
                                        class="rounded-circle">
                                </div>
                                <div class="d-flex justify-content-between flex-grow-1">
                                    <div class="me-2">
                                        <p class="mb-0 text-heading">{{ $menu->nama_layanan }}</p>
                                        <p class="mb-0">{{ $menu->created_at }}</p>
                                    </div>
                                    <div class="dropdown">
                                        <input class="form-check-input" type="checkbox" value="{{ $menu->id }}"
                                            name='menu[]' id="defaultCheck11">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

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
