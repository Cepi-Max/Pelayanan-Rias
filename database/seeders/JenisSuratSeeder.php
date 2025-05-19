<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class JenisSuratSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis_surat')->insert([
            [
                'slug' => 'surat-keterangan-tidak-mampu',
                'nama_jenis' => 'Surat Keterangan Tidak Mampu',
                'deskripsi' => 'Digunakan untuk keperluan bantuan pendidikan atau kesehatan.',
                'form_fields' => json_encode([
                    ['label' => 'Nama Lengkap', 'type' => 'text', 'name' => 'nama'],
                    ['label' => 'NIK', 'type' => 'number', 'name' => 'nik'],
                    ['label' => 'Alamat', 'type' => 'textarea', 'name' => 'alamat'],
                    ['label' => 'Surat Pengantar RT', 'type' => 'file', 'name' => 'pengantar_rt']
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'slug' => 'surat-keterangan-domisili',
                'nama_jenis' => 'Surat Keterangan Domisili',
                'deskripsi' => 'Digunakan untuk mengurus administrasi domisili tempat tinggal.',
                'form_fields' => json_encode([
                    ['label' => 'Nama Lengkap', 'type' => 'text', 'name' => 'nama'],
                    ['label' => 'No KK', 'type' => 'number', 'name' => 'no_kk'],
                    ['label' => 'Alamat Domisili', 'type' => 'textarea', 'name' => 'alamat_domisili'],
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'slug' => 'surat-keterangan-usaha',
                'nama_jenis' => 'Surat Keterangan Usaha',
                'deskripsi' => 'Untuk keperluan legalitas usaha mikro/kecil.',
                'form_fields' => json_encode([
                    ['label' => 'Nama Pemilik', 'type' => 'text', 'name' => 'nama_pemilik'],
                    ['label' => 'Jenis Usaha', 'type' => 'text', 'name' => 'jenis_usaha'],
                    ['label' => 'Alamat Usaha', 'type' => 'textarea', 'name' => 'alamat_usaha'],
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
