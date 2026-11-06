
<?php
// hapus_kelas.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

// Periksa ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: kelola_kelas.php?pesan=hapus_gagal");
    exit;
}

$id = (int) $_GET['id'];

// Ambil nama kelas sebelum dihapus
$stmt = mysqli_prepare($koneksi, "SELECT nama FROM t_kelas WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$hasil = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($hasil);

if (!$data) {
    header("Location: kelola_kelas.php?pesan=hapus_gagal");
    exit;
}

// Hapus data kelas
$stmt_hapus = mysqli_prepare($koneksi, "DELETE FROM t_kelas WHERE id = ?");
mysqli_stmt_bind_param($stmt_hapus, "i", $id);

if (mysqli_stmt_execute($stmt_hapus) && mysqli_stmt_affected_rows($stmt_hapus) > 0) {

    // Notifikasi berhasil
    header("Location: kelola_kelas.php?pesan=hapus");
    exit;

} else {

    // Notifikasi gagal
    header("Location: kelola_kelas.php?pesan=hapus_gagal");
    exit;
}
?>
