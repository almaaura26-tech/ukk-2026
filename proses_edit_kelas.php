
<?php
// proses_edit_kelas.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

// Periksa apakah data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: kelola_kelas.php");
    exit;
}

// Ambil data dari form
$id = $_POST['id'] ?? '';
$nama = trim($_POST['nama'] ?? '');
$tingkat = $_POST['tingkat'] ?? '';
$jurusan = $_POST['jurusan'] ?? '';
$status_aktif = $_POST['status_aktif'] ?? '';

// Validasi data
if (
    !is_numeric($id) ||
    $nama === '' ||
    !in_array($tingkat, ['X', 'XI', 'XII'], true) ||
    !in_array($jurusan, ['RPL', 'TKJ', 'TKR', 'TSM', 'BD'], true) ||
    !in_array((string)$status_aktif, ['0', '1'], true)
) {
    header("Location: kelola_kelas.php?pesan=edit_gagal");
    exit;
}

$id = (int) $id;
$status_aktif = (int) $status_aktif;

// Update data kelas
$stmt = mysqli_prepare(
    $koneksi,
    "UPDATE t_kelas
     SET nama = ?, tingkat = ?, jurusan = ?,
         status_aktif = ?, updated_at = NOW()
     WHERE id = ?"
);

if (!$stmt) {
    header("Location: kelola_kelas.php?pesan=edit_gagal");
    exit;
}

mysqli_stmt_bind_param(
    $stmt,
    "sssii",
    $nama,
    $tingkat,
    $jurusan,
    $status_aktif,
    $id
);

if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) >= 0) {

    header("Location: kelola_kelas.php?pesan=edit");
    exit;

} else {

    header("Location: kelola_kelas.php?pesan=edit_gagal");
    exit;
}
?>
