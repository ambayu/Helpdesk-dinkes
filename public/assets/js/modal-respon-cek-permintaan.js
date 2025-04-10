// Ambil form dengan id form-respon
const form = document.getElementById('form-respon');

// Tambahkan event listener untuk event submit pada form
form.addEventListener('submit', function (event) {
  // Hentikan aksi default form (pengiriman langsung)
  event.preventDefault();

  // Tampilkan SweetAlert untuk konfirmasi
  Swal.fire({
    title: 'Apakah kamu sudah yakin?',
    text: 'Respon yang kamu kirim tidak dapat diubah lagi!',
    icon: 'warning',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Kirim'
  }).then(result => {
    // Jika pengguna mengklik "Yes, send it!"
    if (result.isConfirmed) {
      // Submit form secara manual
      form.submit();
    }
  });
});

const form2 = document.getElementById('form-pindah');

// Tambahkan event listener untuk event submit pada form2
form2.addEventListener('submit', function (event) {
  // Hentikan aksi default form2 (pengiriman langsung)
  event.preventDefault();

  // Tampilkan SweetAlert untuk konfirmasi
  Swal.fire({
    title: 'Apakah kamu sudah yakin?',
    text: 'Respon yang kamu kirim tidak dapat diubah lagi!',
    icon: 'warning',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Kirim'
  }).then(result => {
    // Jika pengguna mengklik "Yes, send it!"
    if (result.isConfirmed) {
      // Submit form2 secara manual
      form2.submit();
    }
  });
});

const form3 = document.getElementById('form-selesai');

// Tambahkan event listener untuk event submit pada form3
form3.addEventListener('submit', function (event) {
  // Hentikan aksi default form3 (pengiriman langsung)
  event.preventDefault();

  // Tampilkan SweetAlert untuk konfirmasi
  Swal.fire({
    title: 'Apakah kamu sudah yakin?',
    text: 'Anda tidak akan bisa mengirimkan balasan lagi apabila formulir telah selesai!',
    icon: 'warning',
    showCancelButton: false,
    confirmButtonColor: '#3085d6',

    confirmButtonText: 'Ya, Selesai'
  }).then(result => {
    // Jika pengguna mengklik "Yes, send it!"
    if (result.isConfirmed) {
      // Submit form3 secara manual
      form3.submit();
    }
  });
});

//function respon
function showResponModal(answerId) {
  let formAction = '/app/cek-permintaan/respon/' + answerId; // Update this URL to your actual endpoint
  document.getElementById('form-respon').setAttribute('action', formAction);

  $('#responCekPermintaanModal').modal('show');
}

//function selesai
function showSelesaiModal(answerId) {
  let formAction = '/app/cek-permintaan/selesai/' + answerId; // Update this URL to your actual endpoint
  document.getElementById('form-selesai').setAttribute('action', formAction);

  $('#selesaiCekPermintaanModal').modal('show');
}

//function pindah
function showPindahModal(answerId) {
  let formAction = '/app/cek-permintaan/pindah/' + answerId; // Update this URL to your actual endpoint
  document.getElementById('form-pindah').setAttribute('action', formAction);

  $('#pindahCekPermintaanModal').modal('show');
}

//function penilaian
function showPenilaianModal(answerId) {
  let formAction = '/app/cek-permintaan/penilaian/' + answerId; // Update this URL to your actual endpoint
  document.getElementById('form-penilaian').setAttribute('action', formAction);

  $('#penilaianCekPermintaanModal').modal('show');
}
