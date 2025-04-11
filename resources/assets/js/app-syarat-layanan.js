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
      ajax: '/app/syarat-layanan/list', // JSON file to add data
      columns: [
        // columns according to JSON
        { data: 'id' },

        { data: '' },
        { data: 'nama_layanan' },
        { data: 'syarat.id' },
        // { data: 'syarat.id' },

        { data: 'created_at' },
        { data: '' }
      ],
      columnDefs: [
        {
          targets: 0,
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
          targets: 2,
          render: function (data, type, full, meta) {
            var $name = full['nama_layanan'];
            return '<span class="text-nowrap text-heading">' + $name + '</span>';
          }
        },

        {
          //cara penggunaan
          targets: 3,
          render: function (data, type, full, meta) {
            var cek = full.syarat ? 'text-success' : 'text-secondary';
            return (
              '<span class="text-nowrap text-heading"> <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 lihat-syarat"><i class="mdi mdi-tag-search ' +
              cek +
              ' mdi-20px"></i></button></span>'
            );
          }
        },

        // {
        //   //cara penggunaan
        //   targets: 4,
        //   render: function (data, type, full, meta) {
        //     var cek = full.syarat ? 'text-success' : 'text-secondary';
        //     return (
        //       '<span class="text-nowrap text-heading"> <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 lihat-bantuan"><i class="mdi mdi-tag-search mdi-20px ' +
        //       cek +
        //       ' "></i></button></span>'
        //     );
        //   }
        // },
        {
          targets: 4,
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
              '<span class="text-nowrap"><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 tambah-syarat"><i class="mdi mdi-pencil-outline mdi-20px"></i></button>' +
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

  var datas;
  $('.datatables-permissions tbody').on('click', '.tambah-syarat', function () {
    var row = $(this).closest('tr');
    datas = dt_permission.row(row).data();
    $.ajax({
      url: '/app/syarat-layanan/list/' + datas.id, // Sesuaikan dengan URL endpoint yang benar
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        console.log(response.syarat);
        $('#full-editor .ql-editor').html(response.syarat);
        $('#full-editor2 .ql-editor').html(response.cara_penggunaan);

        $('#tambahSyaratLayanan').modal('show');
      },
      error: function (xhr, status, error) {
        console.error('Error:', error);
        // Tambahkan logika penanganan error jika perlu
      }
    });
  });

  $('.datatables-permissions tbody').on('click', '.lihat-syarat', function () {
    var row = $(this).closest('tr');
    datas = dt_permission.row(row).data();
    $('#full-editor3').empty();
    // alert(JSON.stringify(datas));
    $.ajax({
      url: '/app/syarat-layanan/list/' + datas.id, // Sesuaikan dengan URL endpoint yang benar
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        // console.log(response.syarat);
        $('#full-editor3 ').html(response.syarat);

        $('#syaratLayanan').modal('show');
      },
      error: function (xhr, status, error) {
        console.error('Error:', error);
        // Tambahkan logika penanganan error jika perlu
      }
    });
  });

  $('.datatables-permissions tbody').on('click', '.lihat-bantuan', function () {
    var row = $(this).closest('tr');
    datas = dt_permission.row(row).data();
    $('#full-editor4').empty();
    // alert(JSON.stringify(datas));
    $.ajax({
      url: '/app/syarat-layanan/list/' + datas.id, // Sesuaikan dengan URL endpoint yang benar
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        console.log(response);
        $('#full-editor4').html(response.cara_penggunaan);

        $('#bantuanLayanan').modal('show');
      },
      error: function (xhr, status, error) {
        console.error('Error:', error);
        // Tambahkan logika penanganan error jika perlu
      }
    });
  });

  $('.simpan-syarat').on('click', function () {
    var syarat = $('#full-editor .ql-editor').html();
    var bantuan = $('#full-editor2 .ql-editor').html();

    $.ajax({
      url: '/app/syarat-layanan', // Ganti dengan URL endpoint Anda
      type: 'POST',
      data: {
        syarat: syarat,
        bantuan: bantuan,
        id: datas.id,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        console.log('Data berhasil disimpan:', response);
        Swal.fire({
          icon: 'success',
          title: 'Disimpan!',
          text: response.message,
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000 // Durasi tampilan toast dalam milidetik (opsional)
        });

        $('.datatables-permissions').DataTable().ajax.reload();
        $('#tambahSyaratLayanan').modal('hide');

        // Tambahkan logika lain yang diperlukan setelah berhasil disimpan
      },
      error: function (error) {
        Swal.fire({
          icon: 'Error',
          title: 'Gagal',
          text: 'Gagal tidak bisa menyimpan syarat dan bantuan',
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000 // Durasi tampilan toast dalam milidetik (opsional)
        });
        // Tambahkan logika penanganan error jika perlu
      }
    });
  });
});
