<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class KategoriController extends Controller
{
    public function getAllData(){
        $data = KategoriModel::all();
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'data tidak ditemukan',
            ]);
        }else{
            return response()->json([
                'code' => 200,
                'message' => 'sukses getAllData',
                'data' => $data
            ]);
        }
    }
    public function createData(Request $request){
        $validation = Validator::make($request->all(), 

        [
            'Nama_kategori' => 'required',
            'kategori' => 'required'
        ],
        [
            'Nama_kategori' => 'Nama kategori tidak boleh kosong'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'cek validasi',
                'errors' => $validation->errors()
            ]);
        }
        try {
            $data = new KategoriModel();
            $data->Nama_kategori = $request->input('Nama_kategori');
            $data->Kategori = $request->input('kategori');
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
        $data = KategoriModel::where('id', $id)->first();
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'data tidak ditemukan'
            ]);
        }else{
            return response()->json([
                'code' => 200,
                'message' => 'sukses get data',
                'data' => $data
            ]);
        }
    }
    public function updateData(Request $request, $id){
        try {
            $data = KategoriModel::where('id', $id)->first();
            if (!$data) {
                return response()->json([
                    'code' => 404,
                    'message' => 'data tidak ditemukan'
                ]);
            }
            $validation = validator::make($request->all(), [
                'Nama_kategori' => 'required',
                'kategori' => 'required'
            ],
            [
                'Nama_kategori' => 'Nama kategori tidak boleh kosong',
                'kategori' => 'Kategori tidak boleh kosong'
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'code' => 422,
                    'message' => 'cek validasi',
                    'errors' => $validation->errors()
                ]);
            }
            $data->Nama_kategori = $request->input('Nama_kategori');
            $data->kategori = $request->input('kategori');
            $data->update();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'gagal perbarui data',
                'errors' => $th->getMessage()
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'sukses perbarui data',
            'data' => $data
        ]);
    }
    public function deleteData($id){
        $data = KategoriModel::where('id', $id)->first();
        try {
            if (!$data) {
                return response()->json([
                    'code' => 404,
                    'message' => 'data tidak ditemukan',
                ]);
            }
            $data->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'gagal delete data',
                'errors' => $th->getMessage()
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'sukses delete data'
        ]);
    }
}
