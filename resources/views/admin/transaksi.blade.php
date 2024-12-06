@extends('layout.index')
@section('style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Data Transaksi</h6>
            <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal"
                data-target="#transaksiModal" id="tambahTransaksi">
                Tambah Data
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="DataTransaksi" class="table table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th>Jumlah</th>
                                    <th>Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Jumlah</th>
                                    <th rowspan="1" colspan="1">Transaksi</th>
                                    <th rowspan="1" colspan="1">Tanggal</th>
                                    <th rowspan="1" colspan="1">Deskripsi</th>
                                    <th rowspan="1" colspan="1">Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of
                            57 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="example2_previous"><a
                                        href="#" aria-controls="example2" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="example2"
                                        data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                <li class="paginate_button page-item next" id="example2_next"><a href="#"
                                        aria-controls="example2" data-dt-idx="7" tabindex="0"
                                        class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="transaksiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="TransaksiModallable">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="upsertData" method="POST">
            @csrf
                <input type="hidden" class="form-control" id="id" name="id" aria-describedby="emailHelp">
                <div class="form-group">
                  <label for="jumlah">jumlah</label>
                  <input type="number" class="form-control" id="jumlah" name="jumlah" aria-describedby="emailHelp" placeholder="Masukkan jumlah" required>
                  <small id="jumlah-error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="transaksi">Transaksi</label>
                    <select class="custom-select" name="transaksi" id="transaksi" required>
                    <option value="" selected disabled hidden>Pemasukan atau Pengeluaran</option required>
                    <option value="pemasukan">pemasukan</option>
                    <option value="pengeluaran">pengeluaran</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi">tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" aria-describedby="emailHelp" placeholder="Masukkan Tanggal" required>
                    <small id="tanggal-error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="deskripsi">deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    <small id="deskripsi-error" class="text-danger"></small>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="simpanData" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        getAllData();
        function getAllData(){
            $.ajax({
                url: `/api/v1/`,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    let tableBody = "";
                    $.each(response.data, function (index, item) {
                        tableBody += "<tr>"
                        // tableBody += "<td>" + (index +1) + "</td>" 
                        tableBody += "<td>" + item.jumlah + "</td>";
                        tableBody += "<td>" + item.transaksi + "</td>";
                        tableBody += "<td>" + item.deskripsi + "</td>";
                        tableBody += "<td>" + item.tanggal + "</td>";
                        tableBody += "<td >" +
                            "<button type='button' class='btn btn-primary edit-modal' " +
                            "data-id='" + item.id + "'>" +
                            "<i class='fa fa-edit'></i></button>" +
                            "<button type='button' class='btn btn-danger delete-confirm' data-id='" +
                            item.id + "'><i class='fa fa-trash'></i></button>" +
                            "</td>";
                        tableBody += "</tr>"
                    });
                    let table = $("#DataTransaksi").DataTable();
                    table.clear().draw();
                    table.rows.add($(tableBody)).draw();
                },
                error: function () {
                    console.log("Failed to get data from server");
                }
            });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.edit-modal', function () {
            let id = $(this).data('id');
            $('#TransaksiModallable').text('Edit Data');
            $.ajax({
                type: 'GET',
                url: `/api/v1/get/${id}`,
                success: function(response) {
                    console.log(response);
                    
                    $('#id').val(response.data.id);
                    $('#jumlah').val(response.data.jumlah);
                    $('#transaksi').val(response.data.transaksi);
                    $('#deskripsi').val(response.data.deskripsi);
                    $('#tanggal').val(response.data.tanggal);
                    $('#transaksiModal').modal('show');
                },
                error: function(error) {
                    console.error('Gagal mengambil data', error);
                }
            });
        });

        $(document).on('click', '#tambahTransaksi', function () {
            $('#TransaksiModallable').text('Tambah Data');
            $('#upsertData')[0].reset();
            $('#id').val('');
            $('#transaksiModal').modal('show');
        });

        $('#transaksiModal').on('hidden.bs.modal', function() {
            $('.text-danger').text('');
            $('#jumlah').val('');
            $('#transaksi').val('');
            $('#tanggal').val('');
            $('#deskripsi').val('');
        });

        function showSweetAlert(icon, title, message) {
            Swal.fire({
                icon: icon,
                title: title,
                text: message
            });
        }

        $(document).on('click', '#simpanData', function (e) {
            $('.text-danger').text('');

            e.preventDefault();
            var id = $('#id').val();
            var jumlah = $('#jumlah').val();
            var transaksi = $('#transaksi').val();
            var tanggal = $('#tanggal').val();
            var deskripsi = $('#deskripsi').val();

            var data = {
                jumlah: jumlah,
                transaksi: transaksi,
                tanggal: tanggal,
                deskripsi: deskripsi,
            };

            if (id) {
                $.ajax({
                    type: 'POST',
                    url: `/api/update/${id}`,
                    data: data,
                    success: function (response) {
                        if (response.code == 422) {
                            let errors = response.errors;
                            $.each(errors, function (key, value) {
                                $('#' + key + '-error').text(value[0]);
                            });
                        } else if (response.code == 200) {
                            $('#transaksiModal').modal('hide');
                            showSweetAlert('success', 'Success!', 'Success perbarui data');
                            getAllData();
                        } else{
                            showSweetAlert('error', 'Error', 'gagal perbarui data');
                        }
                    },
                    error: function(xhr) {
                        console.error('Gagal mengirim permintaan', xhr);
                    }
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url: '/api/v1/create',
                    data: data,
                    success: function(response) {
                        if (response.data == 422) {
                            let errors = response.errors;
                            $.each(errors, function (key, value) {
                                $('#' + key + '-error').text(value[0]);
                            });
                        } else if (response.code == 200) {
                            $('#transaksiModal').modal('hide');
                            showSweetAlert('success', 'Success!', 'Success tambah data');
                            getAllData();
                        } else {
                            showSweetAlert('error', 'Error', 'gagal perbarui data');
                        }
                    },
                    error: function(xhr) {
                        console.error('Gagal mengirim permintaan', xhr);
                    }
                });
            }
        });
    })
</script>
@endsection
