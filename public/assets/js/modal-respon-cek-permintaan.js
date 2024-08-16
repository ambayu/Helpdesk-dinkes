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

function showEditPermintaanModal(answerId) {
  $.ajax({
    url: '/app/layanan-api/' + answerId, // Update with your slug or parameter if needed
    type: 'GET',
    success: function (response) {
      let formAction = '/app/layanan/list-edit/' + answerId; // Update this URL to your actual endpoint
      document.getElementById('form-respon-edit').setAttribute('action', formAction);

      let formHtml = '';
      let formHtmlfile = '';
      let judul = response.data.judul || ''; // Use empty string if 'judul' is not present
      let deskripsi = response.data.deskripsi || ''; // Use empty string if 'deskripsi' is not present
      let file = response.data.menu.file || '';
      console.log(response);
      $('.judul').val(judul);
      $('.deskripsi').val(deskripsi); // Use the correct class selector

      if (file == 1) {
        formHtmlfile += `
          <div class="form-floating form-floating-outline mb-3">
            <p><small class="text-center text-danger">Jika file lebih besar dari 2mb silahkan simpan di google drive dan linknya disematkan di dalam deskrisi</small></p>
          </div>
          <div class="form-floating form-floating-outline mb-3">
            <input type="file" class="form-control " id="file" name="file">
            <label for="file">Masukkan file</label>

          </div>
        `;
      }

      // Log the response for debugging
      // console.log(response);

      // Ensure both menu.formulir and formulir exist and are arrays
      if (Array.isArray(response.data.menu.formulir) && Array.isArray(response.data.formulir)) {
        response.data.menu.formulir.forEach((formulir, index) => {
          if (response.data.formulir[index]) {
            // Check if the index exists in response.data.formulir
            let isPilihan = formulir.inputan.nama_type === 'pilihan';
            let options = [];
            let label = '';
            let selectedValue = response.data.formulir[index].respon || ''; // Get the response value or set to empty string if not available

            if (isPilihan) {
              let formulirOptions = formulir.formulir.split(':');
              if (formulirOptions.length > 1) {
                label = formulirOptions[0].trim(); // Get the label, e.g., 'Warna'
                options = formulirOptions[1].split(',').map(option => option.trim());
              }
            }

            formHtml += `
              <div class="form-floating form-floating-outline mb-3">
                <input type="hidden" name="type[${index}][id_formulir]" value="${formulir.id}">
            `;

            if (isPilihan) {
              formHtml += `
                <select class="form-control" id="${formulir.formulir}" name="type[${index}][respon]" autofocus>
                  <option value="">Pilih ${label}</option>
              `;
              options.forEach(option => {
                let selected = option === selectedValue ? 'selected' : ''; // Mark the correct option as selected
                formHtml += `<option value="${option}" ${selected}>${option}</option>`;
              });
              formHtml += `</select><label for="${label}">${label}</label>`;
            } else {
              formHtml += `
                <input type="${formulir.inputan.nama_type}" class="form-control" value="${selectedValue}" id="${formulir.formulir}"
                  name="type[${index}][respon]" placeholder="Masukkan ${formulir.formulir}" autofocus>
                <label for="${formulir.formulir}">${formulir.formulir}</label>
              `;
            }

            formHtml += `
              <div class="invalid-feedback"></div>
              </div>
            `;
          } else {
            console.warn(`No corresponding response data found for form at index ${index}`);
          }
        });
      } else {
        console.error('Expected arrays for menu.formulir and formulir');
      }

      // Clear the modal content before injecting new HTML
      $('#editPermintaanModal .layanan-create').html('');
      $('#editPermintaanModal .layanan-file').html('');

      // Inject the generated form into the modal's body
      $('#editPermintaanModal .layanan-create').html(formHtml);
      $('#editPermintaanModal .layanan-file').html(formHtmlfile);

      // Show the modal after data is loaded and form is populated
      $('#editPermintaanModal').modal('show');
    },
    error: function (xhr, status, error) {
      console.error('Failed to fetch data:', error);
      // Handle errors here (e.g., show an error message)
    }
  });
}

//function selesai
function showSelesaiModal(answerId) {
  let formAction = '/app/cek-permintaan/selesai/' + answerId; // Update this URL to your actual endpoint
  document.getElementById('form-selesai').setAttribute('action', formAction);

  $('#selesaiCekPermintaanModal').modal('show');
}

//function
function deleteAnswer(answerId) {
  // Tampilkan SweetAlert untuk konfirmasi
  Swal.fire({
    title: 'Apa kamu yakin?',
    text: 'Kamu tidak dapat mengembalikan pengguna yang telah dihapus!',
    icon: 'warning',
    showCancelButton: false,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yakin!'
  }).then(result => {
    if (result.isConfirmed) {
      // Tutup SweetAlert konfirmasi sebelumnya
      Swal.close();
      window.location.href = '/app/layanan/list-hapus/' + answerId;
    }
  });
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
