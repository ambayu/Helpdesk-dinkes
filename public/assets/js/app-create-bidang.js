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
      ajax: '/app/bidang/list', // JSON file to add data
      columns: [
        // columns according to JSON
        { data: '' },
        { data: '' },
        { data: 'id' },
        { data: 'nama_bidang' },
        { data: 'menu_bidang' },
        { data: 'created_at' },
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
          targets: 1,
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
            var $name = full['nama_bidang'];
            return '<span class="text-nowrap text-heading">' + $name + '</span>';
          }
        },
        {
          // User Role
          targets: 4,
          orderable: false,
          render: function (data, type, full, meta) {
            var $menu_bidang = full['menu_bidang'],
              $output = '';
            const colors = [
              'bg-label-primary',
              'bg-label-secondary',
              'bg-label-success',
              'bg-label-danger',
              'bg-label-warning',
              'bg-label-info'
            ]; // Array of color classes
            if ($menu_bidang && Array.isArray($menu_bidang)) {
              for (var i = 0; i < $menu_bidang.length; i++) {
                var val = $menu_bidang[i];
                var colorClass = colors[i % colors.length]; // Cycle through colors

                // Use menuBidang[val] if it exists, otherwise use a default message
                $output +=
                  '<a href="' +
                  userList +
                  full.id +
                  '"><span class="badge rounded-pill ' +
                  colorClass +
                  ' m-1">' +
                  val +
                  '</span></a>';
              }
            } else {
              $output = '<span class="badge rounded-pill bg-label-secondary m-1">Unknown Role</span>';
            }

            return '<span class="text-nowrap">' + $output + '</span>';
          }
        },
        {
          // remove ordering from Name
          targets: 5,
          orderable: false,
          render: function (data, type, full, meta) {
            var $date = full['created_at'];
            return '<span class="text-nowrap">' + $date + '</span>';
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
              '<span class="text-nowrap"><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 edit-permission" ><i class="mdi mdi-pencil-outline mdi-20px"></i></button>' +
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
      buttons: [
        {
          text: 'Tambah Bidang',
          className: 'add-new btn btn-primary mb-3 mb-md-0',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#addBidangModal'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['name'];
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
          url: '/app/delete-bidang/' + rowData.id, // Adjust this to your needs
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
              title: 'Bidang berhasil dihapus',
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
              title: 'Gagal delete bidang',
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

  //edit

  $('.datatables-permissions tbody').on('click', '.edit-permission', function () {
    var row = $(this).closest('tr');
    var rowData = dt_permission.row(row).data();

    $('#editBidangModal').modal('show');

    $.ajax({
      url: '/app/bidang/list/' + rowData.id,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        // Memproses data yang diterima
        data.id_bidang.forEach(function (id) {
          // Menetapkan tanda centang ke kotak centang yang sesuai
          $('.form-check-input[value="' + id + '"]').prop('checked', true);
        });
      },
      error: function (xhr, status, error) {
        console.error('AJAX request failed:', error);
      }
    });

    $('#namabidang').val(rowData.nama_bidang);

    $('#editBidang').attr('action', '/app/update-bidang/' + rowData.id);
  });
});
