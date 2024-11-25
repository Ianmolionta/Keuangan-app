<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function getAllData(){
        $data = TransaksiModel::all();
        if ($data->isEmpty()) {
            return response()->json([
                'code' => 404,
                'message' => 'data tidak ditemukan',
            ], 404);
        }else {
            return response()->json([
                'code' => 200,
                'message' => 'sukses get data',
                'data' => $data
            ]);
        }
    }
    public function createData(Request $request){
        $validation = Validator::make($request->all(), 

        [
            'jumlah' => 'required',
            'transaksi' => 'required|in:pemasukan,pengeluaran',
            'deskripsi' => 'required',
            'tanggal' => 'required'
        ],
        [
            'jumlah' => 'jumlah tidak boleh kosong',
            'transaksi' => 'transaksi tidak boleh kosong',
            'in' => 'transaksi harus pemasukan atau pengeluaran',
            'deskripsi' => 'deskripsi tidak boleh kosong',
            'tanggal' => 'tanggal tidak boleh kosong'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'cek validasi',
                'errors' => $validation->errors()
            ]);
        }
        try {
            $data = new TransaksiModel();
            $data->jumlah = $request->input('jumlah');
            $data->transaksi = $request->input('transaksi');
            $data->deskripsi = $request->input('deskripsi');
            $data->tanggal = $request->input('tanggal');
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'gagal tambah data',
                'errors' => $th->getMessage()
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'berhasil tambah data',
            'data' => $data
        ]);
    }

    public function getDataById($id){
        $data = TransaksiModel::find($id);
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'data tidak ditemukan',
            ], 404);
        }else {
            return response()->json([
                'code' => 200,
                'message' => 'sukses get data by id transaksi',
                'data' => $data
            ]);
        }
    }

    public function updateData(Request $request, $id){
        try {
            $data = TransaksiModel::find($id);
            if (!$data) {
                return response()->json([
                    'code' => 404,
                    'message' => 'data tidak ditemukan',
                    'error' => $data->errors()
                ]);
            }
            $validation = Validator::make($request->all(), 

            [
                'jumlah' => 'required',
                'transaksi' => 'required|in:pemasukan,pengeluaran',
                'deskripsi' => 'required',
                'tanggal' => 'required'
            ],
            [
                'jumlah' => 'jumlah tidak boleh kosong',
                'transaksi' => 'transaksi tidak boleh kosong',
                'in' => 'transaksi harus pemasukan atau pengeluaran',
                'deskripsi' => 'deskripsi tidak boleh kosong',
                'tanggal' => 'tanggal tidak boleh kosong'
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'code' => 422,
                    'message' => 'cek validasi',
                    'errors' => $validation->errors()
                ]);
            }
            $data = TransaksiModel::find($id);
            $data->jumlah = $request->input('jumlah');
            $data->transaksi = $request->input('transaksi');
            $data->deskripsi = $request->input('deskripsi');
            $data->tanggal = $request->input('tanggal');
            $data->update();
            } catch (\Throwable $th) {
                return response()->json([
                    'code' => 400,
                    'message' => 'gagal update data',
                    'errors' => $th->getMessage()
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'sukses update data',
                'data' => $data
            ]);
    }   

    public function deleteData($id){
        $data = TransaksiModel::find($id);
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
