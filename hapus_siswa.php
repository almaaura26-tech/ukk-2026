
<?php
// hapus_siswa.php

include 'includes/cek_session.php';
include 'config/koneksi.php';

// Ambil ID siswa dari URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Jika ID tidak valid
if ($id <= 0) {
    header('Location: kelola_siswa.php?pesan=hapus_gagal');
    exit;
}

// Cek apakah siswa tersedia
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id FROM t_siswa WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$hasil = mysqli_stmt_get_result($stmt);
$siswa = mysqli_fetch_assoc($hasil);

mysqli_stmt_close($stmt);

// Jika data siswa tidak ditemukan
if (!$siswa) {
    header('Location: kelola_siswa.php?pesan=hapus_gagal');
    exit;
}

// Hapus data siswa
$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM t_siswa WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header('Location: kelola_siswa.php?pesan=hapus_berhasil');
    exit;
}

// Jika penghapusan gagal
mysqli_stmt_close($stmt);
header('Location: kelola_siswa.php?pesan=hapus_gagal');
exit;
?>