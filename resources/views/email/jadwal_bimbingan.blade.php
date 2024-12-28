<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Jadwal Bimbingan</title>
</head>
<body>
    <h2>Notifikasi Jadwal Bimbingan</h2>

    <p>Hai, {{ $dosenNama }} (Dosen) dan {{ $mahasiswaNama }} (Mahasiswa),</p>

    <p>Jadwal bimbingan baru telah dibuat sebagai berikut:</p>

    <ul>
        <li><strong>Tanggal:</strong> {{ $jadwal->tanggal }}</li>
        <li><strong>Jam:</strong> {{ $jadwal->jam }}</li>
        <li><strong>Status:</strong> {{ $jadwal->status }}</li>
    </ul>

    <p>Silakan cek jadwal Anda di sistem untuk informasi lebih lanjut.</p>

    <p>Terima kasih,</p>
    <p>Tim Jadwal Bimbingan</p>
</body>
</html>
