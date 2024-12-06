<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'laporan';
    protected $fillable = [
        'id',
        'total_pengeluaran',
        'total_pemasukan',
        'keuntungan',
        'tanggal'
    ];
    
    public function getTransaksi(): BelongsTo
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi', 'id');
    }
}
