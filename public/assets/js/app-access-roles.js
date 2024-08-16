/**
 * App user list
 */

'use strict';

// Datatable (jquery)
$(function () {
  var dtUserTable = $('.datatables-users'),
    statusObj = {
      2: { title: 'Pending', class: 'bg-label-warning' },
      1: { title: 'Active', class: 'bg-label-success' },
      0: { title: 'Inactive', class: 'bg-label-secondary' }
    };

  var userView = '/app/user/view/account/';

  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      ajax: '/app/create-admin/list', // JSON file to add data
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'full_name' },
        { data: 'username' },

        { data: 'role' },
        { data: 'bidang' },
        { data: 'status' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          searchable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          // User full name and email
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['full_name'],
              $email = full['email'],
              $image = full['avatar'];
            if ($image) {
              // For Avatar image
              var $output = '<img src="/storage/' + $image + '" alt="Avatar" class="rounded-circle">';
            } else {
              // For Avatar badge
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['full_name'],
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
          // Username
          targets: 2,
          render: function (data, type, full, meta) {
            var $username = full['username'];

            return '<span class="text-heading">' + $username + '</span>';
          }
        },
        {
          // User Role
          targets: 3,
          render: function (data, type, full, meta) {
            var $role = full['role'];
            var roleBadgeObj = {
              'Super Admin': '<i class="mdi mdi-account-outline mdi-20px text-primary me-2"></i>',
              'Admin Layanan': '<i class="mdi mdi-cog-outline mdi-20px text-warning me-2"></i>',
              'Admin Utama': '<i class="mdi mdi-chart-donut mdi-20px text-success me-2"></i>',
              Administrator: '<i class="mdi mdi-pencil-outline mdi-20px text-info me-2"></i>',
              User: '<i class="mdi mdi-laptop mdi-20px text-danger me-2"></i>'
            };
            if (roleBadgeObj.hasOwnProperty($role)) {
              return "<span class='text-truncate d-flex align-items-center'>" + roleBadgeObj[$role] + $role + '</span>';
            } else {
              return (
                "<span class='text-truncate d-flex align-items-center'>" +
                '<i class="mdi mdi-account-question-outline mdi-20px text-secondary me-2"></i>' +
                $role +
                '</span>'
              );
            }
          }
        },
        {
          // User Bidang
          targets: 4,
          render: function (data, type, full, meta) {
            var $role = full['bidang'];
            var roleBadgeObj = {
              '': '<i class="mdi mdi-account-outline mdi-20px text-primary me-2"></i>',
              IT: '<i class="mdi mdi-account-cog-outline mdi-20px text-warning me-2"></i>',
              Server: '<i class="mdi mdi-account-tag mdi-20px text-success me-2"></i>',
              Administrator: '<i class="mdi mdi-pencil-outline mdi-20px text-info me-2"></i>',
              User: '<i class="mdi mdi-laptop mdi-20px text-danger me-2"></i>'
            };
            if (roleBadgeObj.hasOwnProperty($role)) {
              return "<span class='text-truncate d-flex align-items-center'>" + roleBadgeObj[$role] + $role + '</span>';
            } else {
              return (
                "<span class='text-truncate d-flex align-items-center'>" +
                '<i class="mdi mdi-account-settings-outline  mdi-20px text-secondary me-2"></i>' +
                $role +
                '</span>'
              );
            }
          }
        },

        {
          // User Status
          targets: 5,
          render: function (data, type, full, meta) {
            var $status = full['status'];

            return (
              '<span class="badge rounded-pill ' +
              statusObj[$status].class +
              '" text-capitalized>' +
              statusObj[$status].title +
              '</span>'
            );
          }
        },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            var statusClass = full['status'] == 1 ? 'btn-text-success' : 'btn-text-secondary';
            return (
              '<button class="btn btn-sm btn-icon toggle-status ' +
              statusClass +
              ' rounded-pill btn-icon" data-id="' +
              full.id +
              '" data-status="' +
              full.status +
              '"><i class="mdi mdi-check-circle mdi-20px"></i></button>' +
              ' <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical mdi-24px text-muted"></i></button><ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item" href="' +
              userView +
              full.id +
              '">View</a></li><li><a class="dropdown-item delete-record" data-id="' +
              full.id +
              '" href="javascript:void(0);">Delete</a></li> <li><a class="dropdown-item change-role" data-id="' +
              full.id +
              '" href="javascript:void(0);">Change Role</a></li> </ul>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      dom:
        '<"row mx-2"' +
        '<"col-sm-12 col-md-4 col-lg-6" l>' +
        '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"user_role w-px-200 pb-3 pb-sm-0">>>' +
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
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      },
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

  // Event listener untuk tombol delete
  $('.datatables-users').on('click', '.delete-record', function () {
    var button = $(this);
    var id = button.data('id');

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

        // Kirim permintaan AJAX untuk menghapus user
        $.ajax({
          url: '/app/create-admin/delete/' + id, // Sesuaikan dengan endpoint yang benar di Laravel
          method: 'DELETE',
          data: {
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            if (response.success) {
              // Berhasil menghapus, muat ulang DataTables
              $('.datatables-users').DataTable().ajax.reload();

              // Tampilkan SweetAlert bahwa user telah dihapus sebagai toast
              Swal.fire({
                icon: 'success',
                title: 'Dihapus!',
                text: 'Pengguna telah terhapus.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000 // Durasi tampilan toast dalam milidetik (opsional)
              });
            } else {
              Swal.fire('Gagal!', 'pengguna gagal dihapus.', 'Gagal');
            }
          },
          error: function () {
            Swal.fire('Gagal!', 'Pengguna gagal dihapus. Silahkan coba lagi.', 'Gagal');
          }
        });
      }
    });
  });

  // Event listener untuk "Change Role"
  $('.datatables-users').on('click', '.change-role', function () {
    var button = $(this);

    var id = button.data('id');

    // Atur nilai awal modal roleSelect jika perlu
    $('#changeRoleModal').data('userId', id);
    // Tampilkan modal "Change Role"
    $('#changeRoleModal').modal('show');
  });

  // Event listener untuk menyimpan perubahan role
  $('#saveRoleBtn').on('click', function () {
    var selectedRole = $('#roleSelect').val();
    var selectedBidang = $('#bidangSelect').val();
    var userId = $('#changeRoleModal').data('userId'); // Misalkan menyimpan ID user di data-attribute modal

    // Kirim permintaan AJAX untuk menyimpan perubahan role
    $.ajax({
      url: '/app/create-admin/change-role/' + userId,
      method: 'POST', // Ganti dengan metode yang sesuai di Laravel
      data: {
        role: selectedRole,
        bidang: selectedBidang,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        if (response.success) {
          // Tutup modal setelah berhasil
          $('#changeRoleModal').modal('hide');

          // Tampilkan pesan sukses jika perlu
          Swal.fire({
            icon: 'success',
            title: 'Diubah!',
            text: 'Peranmu berhasil diganti.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000 // Durasi tampilan toast dalam milidetik (opsional)
          });

          // Muat ulang DataTables jika perlu
          $('.datatables-users').DataTable().ajax.reload();
        } else {
          // console.log(response);
          Swal.fire('Gagal!', response.message + ' role tidak dapat diubah.', 'gagal');
        }
      },
      error: function (xhr, status, error) {
        // Logika untuk menangani kesalahan
        Swal.fire('Gagal!', xhr.responseJSON.message + ' Pengguna gagal dihapus. Silahkan coba lagi.', 'Gagal');
      }
    });
  });

  // Event listener untuk tombol status
  $('.datatables-users').on('click', '.toggle-status', function () {
    var button = $(this);

    var id = button.data('id');
    var currentStatus = button.data('status');
    var newStatus = currentStatus == 1 ? 0 : 1;

    // Kirim permintaan AJAX untuk memperbarui status
    $.ajax({
      url: '/app/create-admin/update-status', // Ubah URL ini sesuai endpoint API Anda
      method: 'POST',
      data: {
        id: id,
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
          $('.datatables-users').DataTable().ajax.reload();
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

$('#roleSelect').on('change', function () {
  var selectedRoleId = $(this).val();

  var adminLayananRoleId = 'Admin Layanan'; // Ganti dengan ID yang sesuai untuk "Admin Layanan"

  if (selectedRoleId == adminLayananRoleId) {
    $('#bidangSelectContainer').show();
  } else {
    $('#bidangSelectContainer').hide();
  }
});

(function () {
  // On edit role click, update text
  var roleEditList = document.querySelectorAll('.role-edit-modal'),
    roleAdd = document.querySelector('.add-new-role'),
    roleTitle = document.querySelector('.role-title');

  roleAdd.onclick = function () {
    roleTitle.innerHTML = 'Add New Role'; // reset text
  };
  if (roleEditList) {
    roleEditList.forEach(function (roleEditEl) {
      roleEditEl.onclick = function () {
        roleTitle.innerHTML = 'Edit Role'; // reset text
      };
    });
  }
  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
})();
