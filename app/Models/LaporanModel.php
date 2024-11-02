<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanModel extends Model
{
    use HasFactory;
    protected $table = 'laporan';
    protected $fillable = [
        'id',
        'periode_mulai',
        'periode_selesai',
        'total_pemasukan',
        'total_pengeluaran'
    ];
}
