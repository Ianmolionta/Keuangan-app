@extends('layout.index')
@section('style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Data Laporan</h6>
            <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal"
                data-target="#transaksiModal" id="tambahLaporan">
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
                        <table id="DataLaporan" class="table table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th>Total Pemasukan</th>
                                    <th>Total Pengeluaran</th>
                                    <th>Keuntungan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Total Pemasukan</th>
                                    <th rowspan="1" colspan="1">Total Pengeluaran</th>
                                    <th rowspan="1" colspan="1">Keuntungan</th>
                                    <th rowspan="1" colspan="1">Tanggal</th>
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
    <div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="laporanModallable">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="upsertData" method="POST">
            @csrf
                <input type="hidden" class="form-control" id="id" name="id" aria-describedby="emailHelp">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" rows="3"></input>
                    <small id="tanggal-error" class="text-danger"></small>
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
                url: `/api/v2/`,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    let tableBody = "";
                    $.each(response.data, function (index, item) {
                        tableBody += "<tr>"
                        // tableBody += "<td>" + (index +1) + "</td>" 
                        tableBody += "<td>" + item.total_pemasukan + "</td>";
                        tableBody += "<td>" + item.total_pengeluaran + "</td>";
                        tableBody += "<td>" + item.keuntungan + "</td>";
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
                    let table = $("#DataLaporan").DataTable();
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
            $('#laporanModallable').text('Edit Data');
            $.ajax({
                type: 'GET',
                url: `/api/v2/get/${id}`,
                success: function(response) {
                    console.log(response);
                    
                    $('#id').val(response.data.id);
                    $('#total_pemasukan').val(response.data.total_pemasukan);
                    $('#total_pengeluaran').val(response.data.total_pengeluaran);
                    $('#keuntungan').val(response.data.keuntungan);
                    $('#tanggal').val(response.data.tanggal);
                    $('#laporanModal').modal('show');
                },
                error: function(error) {
                    console.error('Gagal mengambil data', error);
                }
            });
        });

        $(document).on('click', '#tambahLaporan', function () {
            $('#laporanModallable').text('Tambah Data');
            $('#upsertData')[0].reset();
            $('#id').val('');
            $('#laporanModal').modal('show');
        });

        $('#laporanModal').on('hidden.bs.modal', function() {
            $('.text-danger').text('');
            $('#total_pemasukan').val('');
            $('#total_pengeluaran').val('');
            $('#keuntungan').val('');
            $('#tanggal').val('');
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
            var total_pemasukan = $('#total_pemasukan').val();
            var total_pengeluaran = $('#total_pengeluaran').val();
            var keuntungan = $('#keuntungan').val();
            var tanggal = $('#tanggal').val();

            var data = {
                total_pemasukan: total_pemasukan,
                total_pengeluaran: total_pengeluaran,
                keuntungan: keuntungan,
                tanggal: tanggal,
            };

            if (id) {
                $.ajax({
                    type: 'POST',
                    url: `/api/v2/update/${id}`,
                    data: data,
                    success: function (response) {
                        console.log(response);
                        
                        if (response.code == 422) {
                            let errors = response.errors;
                            $.each(errors, function (key, value) {
                                $('#' + key + '-error').text(value[0]);
                            });
                        } else if (response.code == 200) {
                            $('#laporanModal').modal('hide');
                            showSweetAlert('success', 'Success!', 'sukses perbarui data');
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
                    url: '/api/v2/create',
                    data: data,
                    success: function(response) {
                        if (response.data == 422) {
                            let errors = response.errors;
                            $.each(errors, function (key, value) {
                                $('#' + key + '-error').text(value[0]);
                            });
                        } else if (response.code == 200) {
                            $('#laporanModal').modal('hide');
                            showSweetAlert('success', 'Success!', 'Sukses tambah data');
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

        $(document).on('click', '.delete-confirm', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `/api/v2/delete/${id}`,
                        success: function(response) {
                            showSweetAlert('success', 'Success!', 'Sukses hapus data');
                            getAllData();
                        },
                        error: function(error) {
                            Swal.fire('Error', 'Gagal menghapus data', 'error');
                        }
                    })
                }
            })
        });
    })
</script>
@endsection
