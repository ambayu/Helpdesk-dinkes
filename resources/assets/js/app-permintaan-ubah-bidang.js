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
      ajax: '/app/permintaan-ubah-layanan/list', // JSON file to add data
      columns: [
        // columns according to JSON

        { data: '' },
        { data: 'id' },
        { data: 'user_name' },
        { data: 'rekomend_menu' },
        { data: 'alasan' },
        { data: 'nama_layanan_lama' },
        { data: 'nama_layanan_baru' },
        { data: 'tanggal_kirim' },
        { data: 'user_name_validasi' },

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
            var $name = full['user_name'],
              $email = full['email_user'],
              $image = full['photo_profil'];
            if ($image) {
              // For Avatar image
              var $output = '<img src="/storage/' + $image + '" alt="Avatar" class="rounded-circle">';
            } else {
              // For Avatar badge
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['user_name'],
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
            var $rekomend_menu = full['rekomend_menu'];
            return '<p>' + $rekomend_menu + '</p>';
          }
        },
        {
          // remove ordering from Name
          targets: 4,
          orderable: false,

          render: function (data, type, full, meta) {
            var $alasan = full['alasan'];
            return '<p>' + $alasan + '</p>';
          }
        },
        {
          // User full name and email
          targets: 8,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['user_name_validasi'],
              $email = full['email_user_validasi'],
              $image = full['photo_profil_validasi'];
            if ($image) {
              // For Avatar image
              var $output = '<img src="/storage/' + $image + '" alt="Avatar" class="rounded-circle">';
            } else {
              // For Avatar badge
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['user_name_validasi'],
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
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            return (
              '<span class="text-nowrap">' +
              '<button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 edit-permission">' +
              '<i class="mdi mdi-pencil-outline mdi-20px"></i>' +
              '</button>' +
              '<button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 lihat-answer">' +
              '<i class="mdi mdi-access-point mdi-20px"></i>' +
              '</button>' +
              '<form action="/app/cek-permintaan/" method="POST" style="display:inline-block;">' +
              '<input type="hidden" name="_token" value="' +
              csrfToken +
              '">' +
              '<input type="hidden" name="search" value="' +
              full['ticket'] +
              '">' +
              '<button class="btn btn-sm btn-icon rounded-pill btn-icon me-2 lihat">' +
              '<i class="mdi mdi-eye mdi-20px"></i>' +
              '</button>' +
              '</form>' +
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

  //  lihat answer
  $('.datatables-permissions tbody').on('click', '.lihat-answer', function () {
    var row = $(this).closest('tr');
    var rowData = dt_permission.row(row).data();
    $('#lihatAnswerShow').modal('show');
    var url = '/app/cek-permintaan/search/' + rowData.id_answer;

    $.ajax({
      url: url,
      method: 'GET',
      success: function (data) {
        // console.log(data.ticket.user.name);
        $('#judul').text(data.judul);

        $('#deskripsi').text(data.deskripsi);
        $('#tanggal_kirim').text(data.tanggal_kirim);
        $('#users').text(data.ticket.user.name);
        $('#tiket').text(data.ticket.nomor_tiket);

        // Clear the previous list
        $('#formulir').empty();
        // Populate the formulir list
        $.each(data.formulir, function (index, item) {
          $('#formulir').append('<span class="badge rounded-pill bg-label-warning" >' + item.respon + '<span>');
        });
      },
      error: function (xhr, status, error) {
        // Handle errors here
        console.error(error);
        $('#answerDetails').html('<p>Terjadi kesalahan saat mengambil data.</p>');
      }
    });
  });

  // permintaan ubah bidang

  $('.datatables-permissions tbody').on('click', '.edit-permission', function () {
    var row = $(this).closest('tr');
    var rowData = dt_permission.row(row).data();

    $('#pindahBidangModal').modal('show');

    $('#gantiBidang').attr('action', '/app/permintaan-ubah-layanan/change/' + rowData.id);
  });
});
