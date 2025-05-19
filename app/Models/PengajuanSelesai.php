<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanSelesai extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_selesai'; 

    protected $fillable = [
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
}