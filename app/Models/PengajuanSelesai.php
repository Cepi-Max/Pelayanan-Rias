<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanSelesai extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_selesai'; 

    protected $fillable = [
        'nama',
        'jenis_surat_id',
        'pengajuan_id',
        'surat_diminta',
    ];

    /**
     * Relasi ke PengajuanSurat
     */
    public function pengajuan()
    {
        return $this->belongsTo(PengajuanSurat::class, 'pengajuan_id');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }
}