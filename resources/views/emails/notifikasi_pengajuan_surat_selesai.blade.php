<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notifikasi Surat Selesai</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #1e40af;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            color: #333;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
        }
        .footer {
            background-color: #f1f1f1;
            text-align: center;
            font-size: 12px;
            color: #777;
            padding: 15px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="email-container">

    <!-- Header -->
    <div class="header">
        <h1>Sistem Layanan Surat</h1>
        <p>Surat Anda Sudah Selesai</p>
    </div>

    <!-- Content -->
    <div class="content">
        <p>Halo,</p>

        <p>Pemberitahuan bahwa surat permohonan Anda telah selesai diproses.</p>

        <p>Anda dapat mengunduh surat menggunakan tombol di bawah ini:</p>

        <a href="{{ $link }}" class="button">Download Surat PDF</a>

        <p style="margin-top: 20px;">Jika tombol di atas tidak berfungsi, anda bisa mendownloadnya di menu riwayat di bagian menu atas website pelayanan administrasi desa rias.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; {{ date('Y') }} Sistem Layanan Surat. <br>
        Jika Anda memiliki pertanyaan, silakan hubungi kami di support@layanan-surat.ac.id.
    </div>

</div>

</body>
</html>