/**
 * App user list (jquery)
 */

'use strict';

$(function () {
  var dataTablePermissions = $('.datatables-permissions'),
    dt_permission,
    userList = baseUrl + '/app/user/view/account/';
  // Users List datatable
  var userView = '/app/user/view/account/';

  if (dataTablePermissions.length) {
    dt_permission = dataTablePermissions.DataTable({
      ajax: '/app/penilaian/list', // JSON file to add data
      columns: [
        // columns according to JSON

        { data: '' },
        { data: 'id' },
        { data: 'user' },
        { data: 'judul' },
        { data: 'deskripsi' },
        { data: 'rating' },
        { data: 'status' },
        { data: 'created_date' },
        { data: 'admin' },

        { data: '' }
      ],
      columnDefs: [
        {
          targets: 1,
          searchable: false,
          visible: false
        },
        {
          // Nomor Urut
          targets: 0,
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return meta.row + 1;
          }
        },

        {
          // User full name and email
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['user'],
              $email = full['user_email'],
              $image = full['user_poto'];
            if ($image) {
              // For Avatar image
              var $output = '<img src="/storage/' + $image + '" alt="Avatar" class="rounded-circle">';
            } else {
              // For Avatar badge
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['user'],
                $initials = $name.match(/\b\w/g) || [];
              $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
              $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
            }
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar avatar-sm me-3">' +
              $output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<a href="' +
              userView +
              full.id +
              '" class="text-truncate"><span class="text-heading fw-medium">' +
              $name +
              '</span></a>' +
              '<small>' +
              $email +
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          // remove ordering from Name
          targets: 3,
          orderable: false,

          render: function (data, type, full, meta) {
            var $judul = full['judul'];
            return '<p>' + $judul + '</p>';
          }
        },
        {
          // remove ordering from Name
          targets: 4,
          orderable: false,

          render: function (data, type, full, meta) {
            var $deskripsi = full['deskripsi'];
            return '<p>' + $deskripsi + '</p>';
          }
        },
        {
          // remove ordering from Name
          targets: 5,
          orderable: false,

          render: function (data, type, full, meta) {
            var $rating = full['rating'];
            return '<p>' + $rating + '</p>';
          }
        },
        {
          // remove ordering from Name
          targets: 6,
          orderable: false,

          render: function (data, type, full, meta) {
            var $status = full['status'];
            if ($status > 0) return '<p> Dipublikasi </p>';
            else return '<p>' + 'Tidak dipublikasi' + '</p>';
          }
        },

        {
          // User full name and email
          targets: 8,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['admin'],
              $email = full['admin_email'],
              $image = full['admin_poto'];
            if ($image) {
              // For Avatar image
              var $output = '<img src="/storage/' + $image + '" alt="Avatar" class="rounded-circle">';
            } else {
              // For Avatar badge
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['admin'],
                $initials = $name.match(/\b\w/g) || [];
              $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
              $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
            }
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar avatar-sm me-3">' +
              $output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<a href="' +
              userView +
              full.id +
              '" class="text-truncate"><span class="text-heading fw-medium">' +
              $name +
              '</span></a>' +
              '<small>' +
              $email +
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },

        {
          // Actions
          targets: -1,
          searchable: false,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            var statusClass = full['status'] == 1 ? 'btn-text-success' : 'btn-text-secondary';
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            return (
              '<span class="text-nowrap"><button class="btn btn-sm btn-icon ' +
              statusClass +
              ' rounded-pill btn-icon me-2 validasi" ><i class="mdi mdi-check-circle mdi-20px"></i></button>' +
              '</span>' +
              '<span class="text-nowrap"><form action="/app/cek-permintaan/" method="POST">' +
              '<input type="hidden" name="_token" value="' +
              csrfToken +
              '">' +
              '<input type="hidden" name="search" value="' +
              full['ticket'] +
              '">' +
              '<button class="btn btn-sm btn-icon ' +
              ' rounded-pill btn-icon me-2 lihat" ><i class="mdi mdi-eye mdi-20px"></i></button><form>' +
              '</span>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row mx-1"' +
        '<"col-sm-12 col-md-3" l>' +
        '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..'
      },
      // Buttons with Dropdown
      buttons: [],
      // For responsive popup

      initComplete: function () {
        // Adding role filter once table initialized
        this.api()
          .columns(3)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>'
            )
              .appendTo('.user_role')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
      }
    });
  }

  // Delete Record
  $('.datatables-permissions tbody').on('click', '.validasi', function () {
    var row = $(this).closest('tr');
    var rowData = dt_permission.row(row).data();

    var currentStatus = rowData.status;

    var newStatus = currentStatus == 1 ? 0 : 1;

    // Kirim permintaan AJAX untuk memperbarui status
    $.ajax({
      url: '/app/penilaian/status', // Ubah URL ini sesuai endpoint API Anda
      method: 'POST',
      data: {
        id: rowData.id,
        status: newStatus,

        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        if (response.success) {
          // Perbarui data-status dan kelas CSS tombol
          Swal.fire({
            icon: 'success',
            title: 'Diubah!',
            text: 'Status berhasil diubah.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000 // Durasi tampilan toast dalam milidetik (opsional)
          });
          $('.datatables-permissions').DataTable().ajax.reload();
        } else {
          alert('Gagal untuk mengubah status');
        }
      },
      error: function () {
        alert('Gagal untuk mengubah status');
      }
    });
  });
});
