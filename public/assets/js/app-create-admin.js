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
      ajax: '/app/access-permission-list', // JSON file to add data
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'id' },
        { data: 'name' },
        { data: 'assigned_to' },
        { data: 'created_date' },
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
          // Name
          targets: 2,
          render: function (data, type, full, meta) {
            var $name = full['name'];
            return '<span class="text-nowrap text-heading">' + $name + '</span>';
          }
        },
        {
          // User Role
          targets: 3,
          orderable: false,
          render: function (data, type, full, meta) {
            var $assignedTo = full['assigned_to'],
              $output = '';
            var roleBadgeObj = {
              'Super Admin':
                '<a href="' +
                userList +
                full.id +
                '"><span class="badge rounded-pill bg-label-primary m-1">Super Admin</span></a>',
              'Admin Layanan':
                '<a href="' +
                userList +
                full.id +
                '"><span class="badge rounded-pill bg-label-warning m-1">Admin Layanan</span></a>',
              Users:
                '<a href="' +
                userList +
                full.id +
                '"><span class="badge rounded-pill bg-label-success m-1">Users</span></a>',
              'Admin Laporan':
                '<a href="' +
                userList +
                full.id +
                '"><span class="badge rounded-pill bg-label-info m-1">Admin Laporan</span></a>',
              Administrator:
                '<a href="' +
                userList +
                full.id +
                '"><span class="badge rounded-pill bg-label-danger m-1">Administrator</span></a>'
            };

            if ($assignedTo && Array.isArray($assignedTo)) {
              for (var i = 0; i < $assignedTo.length; i++) {
                var val = $assignedTo[i];
                // Use roleBadgeObj[val] if it exists, otherwise use a default message
                $output +=
                  roleBadgeObj[val] ||
                  '<a href="' +
                    userList +
                    full.id +
                    '"><span class="badge rounded-pill bg-label-secondary m-1">' +
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
          targets: 4,
          orderable: false,
          render: function (data, type, full, meta) {
            var $date = full['created_date'];
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
          text: 'Add Permission',
          className: 'add-new btn btn-primary mb-3 mb-md-0',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#addPermissionModal'
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
          url: '/app/access-permission-delete/' + rowData.id, // Adjust this to your needs
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
              title: 'The row has been deleted',
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
              title: 'Failed to delete the row',
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

  $('.datatables-permissions tbody').on('click', '.edit-permission', function () {
    var row = $(this).closest('tr');
    var rowData = dt_permission.row(row).data();
    $('#addAssignedModal').modal('show');

    $.ajax({
      url: '/app/access-permission-list/' + rowData.id,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        // Memproses data yang diterima
        data.assigned_to.forEach(function (role) {
          // Menetapkan tanda centang ke kotak centang yang sesuai
          $('.form-check-input[value="' + role + '"]').prop('checked', true);
        });
      },
      error: function (xhr, status, error) {
        console.error('AJAX request failed:', error);
      }
    });

    $('#editPermissionName').val(rowData.name);

    $('#addAssigned').attr('action', '/app/access-permission/assigned/' + rowData.id);
  });
  $(function () {
    // Select2
    var select2 = $('.select2');
    if (select2.length) {
      select2.each(function () {
        var $this = $(this);
        select2Focus($this);
        $this.wrap('<div class="position-relative"></div>').select2({
          dropdownParent: $this.parent(),
          placeholder: $this.data('placeholder'), // for dynamic placeholder
          dropdownCss: {
            minWidth: '350px' // set a minimum width for the dropdown
          }
        });
      });
      $('.select2-selection__rendered').addClass('');
    }
  });

  $('#modalAddressCountry').on('change', function () {
    var selectedRoleId = $(this).val();

    var adminLayananRoleId = 4; // Ganti dengan ID yang sesuai untuk "Admin Layanan"

    if (selectedRoleId == adminLayananRoleId) {
      $('#bidangSelectContainer').show();
    } else {
      $('#bidangSelectContainer').hide();
    }
  });
});
