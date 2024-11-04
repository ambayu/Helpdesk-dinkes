/**
 * App user list (jquery)
 */

'use strict';

$(function () {
  var dataTablePermissions = $('.datatables-permissions'),
    dt_permission,
    userList = baseUrl + '/app/user/view/account/';
  // Users List datatable
  if (dataTablePermissions.length) {
    dt_permission = dataTablePermissions.DataTable({
      ajax: '/app/kelola-layanan/list', // JSON file to add data
      columns: [
        // columns according to JSON
        { data: '' },
        { data: '' },
        { data: 'id' },
        { data: 'nama_layanan' },
        { data: 'formulir' },
        { data: 'file' },

        { data: 'created_at' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          searchable: false,
          responsivePriority: 3,
          targets: 0,
          render: function (data, type, full, meta) {
            return (
              '<button class="btn btn-link" style="color: green; padding: 0; border: none; background: none;" onclick="viewFunction(' +
              full.id +
              ')">' +
              '<i class="mdi mdi-account-cog-outline"></i>' +
              '</button>'
            );
          }
        },
        {
          targets: 2,
          searchable: false,
          visible: false
        },
        {
          // Nomor Urut
          targets: 1,
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return meta.row + 1;
          }
        },

        {
          // Name
          targets: 3,
          render: function (data, type, full, meta) {
            var $name = full['nama_layanan'];
            return '<span class=" text-heading">' + $name + '</span>';
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            var formulirArray = full['formulir'];
            var colors = [
              'bg-label-primary',
              'bg-label-success',
              'bg-label-danger',
              'bg-label-warning',
              'bg-label-info',
              'bg-label-dark'
            ];
            var formulirText = formulirArray
              .map(function (item) {
                var randomColor = colors[Math.floor(Math.random() * colors.length)];
                return (
                  '<span class="badge rounded-pill ' +
                  randomColor +
                  '" text-capitalized="">' +
                  item.formulir +
                  '</span>'
                );
              })
              .join(' '); // Gabungkan nilai formulir menjadi satu string, dipisahkan dengan koma

            return formulirText;
          }
        },

        {
          // file
          targets: 5,
          render: function (data, type, full, meta) {
            var $file = full['file'];
            if ($file == '1') {
              return '<span class="text-nowrap text-heading">Aktif</span>';
            } else {
              return '<span class="text-nowrap text-heading">Tidak Aktif</span>';
            }
          }
        },
        {
          targets: 6,
          orderable: false,
          render: function (data, type, full, meta) {
            var date = new Date(full['created_at']);
            if (!isNaN(date.getTime())) {
              var formattedDate =
                date.getFullYear() +
                '-' +
                ('0' + (date.getMonth() + 1)).slice(-2) +
                '-' +
                ('0' + date.getDate()).slice(-2);
              return '<span class="text-nowrap">' + formattedDate + '</span>';
            } else {
              return '<span class="text-nowrap">Invalid Date</span>';
            }
          }
        },

        {
          // Actions
          targets: -1,
          searchable: false,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<span class="text-nowrap"><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 "  data-bs-toggle="modal" data-bs-target="#editLayanan' +
              full.id +
              '"><i class="mdi mdi-pencil-outline mdi-20px"></i></button>' +
              '<button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon delete-record"><i class="mdi mdi-delete-outline mdi-20px"></i></button></span>'
            );
          }
        }
      ],
      order: [[1, 'asc']],
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
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['nama_layanan'];
            },
            classes: 'modal-xl'
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

  // Delete Record
  $('.datatables-permissions tbody').on('click', '.delete-record', function () {
    var row = $(this).closest('tr');
    var rowData = dt_permission.row(row).data();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      customClass: {
        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-secondary waves-effect'
      },
      buttonsStyling: false
    }).then(result => {
      if (result.isConfirmed) {
        // Perform your AJAX request to delete the data from the server here
        $.ajax({
          url: '/app/kelola-layanan/delete/' + rowData.id, // Adjust this to your needs
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            // Remove the row from the DataTable
            dt_permission.row(row).remove().draw();
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'Layanan berhasil dihapus',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              customClass: {
                popup: 'colored-toast'
              }
            });
          },
          error: function (xhr, status, error) {
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'Gagal delete layanan',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              customClass: {
                popup: 'colored-toast'
              }
            });
          }
        });
      }
    });
  });
});
