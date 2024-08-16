// Ambil form dengan id form-respon
const form = document.getElementById('form-respon');

// Tambahkan event listener untuk event submit pada form
form.addEventListener('submit', function (event) {
  // Hentikan aksi default form (pengiriman langsung)
  event.preventDefault();

  // Tampilkan SweetAlert untuk konfirmasi
  Swal.fire({
    title: 'Are you sure?',
    text: 'You are about to send the response!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, send it!'
  }).then(result => {
    // Jika pengguna mengklik "Yes, send it!"
    if (result.isConfirmed) {
      // Submit form secara manual
      form.submit();
    }
  });
});
