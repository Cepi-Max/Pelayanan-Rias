<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    //
    protected $table = 'pengajuan_surat';
    protected $fillable = ['user_id', 'jenis_surat_id', 'data_pengajuan', 'status', 'catatan'];

    protected $casts = [
        'data_pengajuan' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }


}
