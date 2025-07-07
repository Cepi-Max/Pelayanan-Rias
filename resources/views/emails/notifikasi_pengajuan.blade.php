<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
</head>
<body style="margin: 0; padding: 20px; background-color: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <div style="max-width: 600px; margin: auto; background-color: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
        
        <!-- Header -->
        <div style="background-color: #1d4ed8; padding: 20px; text-align: center;">
            <!-- Ganti src ini dengan URL gambar yang online -->
            <img src="https://pemdesrias.com/img/icon/favicon-96x96.png" alt="Logo Desa" style="width: 60px; height: 60px; border-radius: 50%; margin-bottom: 10px;">
            <h2 style="margin: 0; color: white;">Pelayanan Surat Desa Pemali</h2>
            <p style="margin: 0; color: #e0e7ff;">Notifikasi Pengajuan Surat</p>
        </div>

        <!-- Body -->
        <div style="padding: 30px;">
            <h3 style="color: #1d4ed8; margin-top: 0;">{{ $judul }}</h3>
            <p style="font-size: 16px; color: #333; line-height: 1.5;">
                {{ $pesan }}
            </p>

            <hr style="margin: 30px 0; border: none; border-top: 1px solid #ccc;">

            <!-- Tombol WhatsApp -->
            <p style="text-align: center;">
                <a href="https://wa.me/6281234567890?text=Halo%20Pak/Bu%20Operator%2C%20saya%20ingin%20menanyakan%20tentang%20pengajuan%20surat%20saya." 
                   target="_blank" 
                   style="display: inline-block; background-color: #25D366; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                    Hubungi Operator via WhatsApp
                </a>
            </p>

            <p style="font-size: 14px; color: #555; margin-top: 30px;">
                Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, silakan hubungi operator desa melalui tombol di atas atau kunjungi website resmi kami.
            </p>

            <p style="font-size: 13px; color: #999;">
                Email ini dikirim otomatis oleh sistem Layanan Surat Desa. Harap tidak membalas email ini.
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f1f5f9; padding: 15px; text-align: center; font-size: 13px; color: #777;">
            &copy; {{ date('Y') }} Sistem Layanan Surat Desa. Semua hak dilindungi.
        </div>
    </div>

</body>
</html>
