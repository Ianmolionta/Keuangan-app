@extends('layout.index')
@section('style')
    
@endsection
@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Laporan Hari ini</h1>
        </div>
    </div>
    <div class="row" id="laporanContainer">

    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Fungsi untuk mengambil data dari API dan merender ke dalam kartu
        function fetchDataLaporan() {
            $.ajax({
                url: '/api/v2/', // Ganti dengan endpoint API yang sesuai
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log("Respons API:", response);
                    
                    if (response.code === 200) { // Asumsikan response memiliki kode 200 untuk sukses
                        renderLaporan(response.data);
                    } else {
                        console.error("Gagal mengambil data laporan");
                    }
                },
                error: function(error) {
                    console.error("Error saat mengakses API:", error);
                }
            });
        }

        // Fungsi untuk merender data laporan ke dalam kartu
        function renderLaporan(data) {
            $('#laporanContainer').empty(); // Pastikan container kosong sebelum render

            // Ambil data pertama dari array
            const laporan = data[0]; 

            // Buat kartu laporan
            const pemasukanCard = `
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <div class="stat-text">Total Pemasukan</div>
                                <div class="stat-digit"><i class="fa fa-usd"></i> ${laporan.total_pemasukan}</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            const pengeluaranCard = `
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <div class="stat-text">Total Pengeluaran</div>
                                <div class="stat-digit"><i class="fa fa-usd"></i> ${laporan.total_pengeluaran}</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            const keuntunganCard = `
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <div class="stat-text">Keuntungan</div>
                                <div class="stat-digit"><i class="fa fa-usd"></i> ${laporan.keuntungan}</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Append semua kartu ke container
            $('#laporanContainer').append(pemasukanCard, pengeluaranCard, keuntunganCard);
        }


        // Panggil fungsi untuk mengambil dan merender data saat halaman dimuat
        fetchDataLaporan();
    });
</script>
@endsection