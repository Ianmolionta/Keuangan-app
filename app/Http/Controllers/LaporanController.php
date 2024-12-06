<?php

namespace App\Http\Controllers;

use App\Models\LaporanModel;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function getAllData(){
        $data = LaporanModel::all();
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'data tidak ditemukan',
            ], 404);
        }else {
            return response()->json([
                'code' => 200,
                'message' => 'sukses get data laporan',
                'data' => $data,
            ]);
        }
    }

    public function createData(Request $request){
        try {
            DB::beginTransaction();
            $tanggal = $request->input('tanggal');
            $totalPemasukan = TransaksiModel::where('transaksi', 'pemasukan')->whereDate('tanggal', $tanggal)->sum('jumlah');
            $totalPengeluaran = TransaksiModel::where('transaksi', 'pengeluaran')->whereDate('tanggal', $tanggal)->sum('jumlah');
            $keuntungan = $totalPemasukan - $totalPengeluaran;

            $data = new LaporanModel();
            $data->total_pemasukan = $totalPemasukan;
            $data->total_pengeluaran = $totalPengeluaran;
            $data->keuntungan = $keuntungan;
            $data->tanggal = $tanggal;
            $data->save();
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'sukses tambah data',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'code' => 400,
                'message' => 'gagal tambah data',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function getDataById($id){
        $data = LaporanModel::find($id);
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'data tidak ditemukan',
            ], 404);
        }else {
            return response()->json([
                'code' => 200,
                'message' => 'sukses get data laporan',
                'data' => $data,
            ]);
        }
    }

    public function updateData(Request $request, $id){
        try {
            DB::beginTransaction();
            $tanggal = $request->input('tanggal');
            $totalPemasukan = TransaksiModel::where('transaksi', 'pemasukan')->whereDate('tanggal', $tanggal)->sum('jumlah');
            $totalPengeluaran = TransaksiModel::where('transaksi', 'pengeluaran')->whereDate('tanggal', $tanggal)->sum('jumlah');
            $keuntungan = $totalPemasukan - $totalPengeluaran;

            $data = LaporanModel::find($id);
            $data->total_pemasukan = $totalPemasukan;
            $data->total_pengeluaran = $totalPengeluaran;
            $data->keuntungan = $keuntungan;
            $data->tanggal = $request->input('tanggal');
            $data->update();
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'sukses tambah data',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'code' => 400,
                'message' => 'gagal tambah data',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function deleteData($id){
        $data = LaporanModel::find($id);
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'data tidak ditemukan',
            ]);
        }
        $data->delete();
        return response()->json([
            'code' => 200,
            'message' => 'berhasil delete data'
        ]);
    }
}
