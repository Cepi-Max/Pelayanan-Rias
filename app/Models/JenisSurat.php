<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;
    protected $table = 'jenis_surat';
    protected $casts = [
        'form_fields' => 'array',
    ];
    protected $fillable = ['nama_jenis', 'deskripsi', 'form_fields'];

    // public function pengajuan()
    // {
    //     return $this->hasMany(Pengajuan::class, 'jenis_id');
    // }
}
