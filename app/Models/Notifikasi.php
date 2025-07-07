<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    //
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'pengaju_id',
        'pengajuan_surat_id',
        'jenis_surat_id',
        'judul',
        'pesan',
        'tipe',
        'sudah_dibaca_operator',
        'sudah_dibaca_masyarakat',
        'dibaca_operator_pada',
        'dibaca_masyarakat_pada',
    ];

    // Relasi ke User (Pengaju)
    public function pengaju()
    {
        return $this->belongsTo(User::class, 'pengaju_id');
    }

    // Relasi ke PengajuanSurat
    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSurat::class);
    }

    // Relasi ke JenisSurat
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }
}
