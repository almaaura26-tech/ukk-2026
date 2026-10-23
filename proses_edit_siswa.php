
<?php
// proses_edit_siswa.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

// Pastikan form dikirim menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: kelola_siswa.php');
    exit;
}

// Ambil data dari form
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nis = trim($_POST['nis'] ?? '');
$nisn = trim($_POST['nisn'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$jenis_kelamin = trim($_POST['jenis_kelamin'] ?? '');
$tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$status_aktif = filter_input(
    INPUT_POST,
    'status_aktif',
    FILTER_VALIDATE_INT
);

// Validasi input
if (
    !$id ||
    $nis === '' ||
    $nisn === '' ||
    $nama === '' ||
    !in_array($jenis_kelamin, ['L', 'P'], true) ||
    $tanggal_lahir === '' ||
    $alamat === '' ||
    !in_array($status_aktif, [0, 1], true)
) {
    $_SESSION['pesan_error'] = 'Data tidak valid. Periksa kembali formulir.';
    header('Location:proses_edit_siswa.php?id=' . (int) $id);
    exit;
}

// Pastikan siswa tersedia
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id FROM t_siswa WHERE id = ?"
);

if (!$stmt) {
    $_SESSION['pesan_error'] = 'Gagal memeriksa data siswa.';
    header('Location: kelola_siswa.php');
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$data_ada = mysqli_num_rows($hasil) > 0;
mysqli_stmt_close($stmt);

if (!$data_ada) {
    $_SESSION['pesan_error'] = 'Data siswa tidak ditemukan.';
    header('Location: kelola_siswa.php');
    exit;
}

// Update data siswa
$sql = "UPDATE t_siswa
        SET nis = ?,
            nisn = ?,
            nama = ?,
            jenis_kelamin = ?,
            tanggal_lahir = ?,
            alamat = ?,
            status_aktif = ?,
            updated_at = CURRENT_TIMESTAMP
        WHERE id = ?";

$stmt = mysqli_prepare($koneksi, $sql);

if (!$stmt) {
    $_SESSION['pesan_error'] = 'Gagal menyiapkan perubahan data siswa.';
    header('Location: proses_edit_siswa.php?id=' . $id);
    exit;
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssii",
    $nis,
    $nisn,
    $nama,
    $jenis_kelamin,
    $tanggal_lahir,
    $alamat,
    $status_aktif,
    $id
);

// Jalankan update
try {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        $_SESSION['pesan_sukses'] =
            'Data siswa berhasil diperbarui.';

        header('Location: kelola_siswa.php?pesan=edit');
        exit;
    }

    mysqli_stmt_close($stmt);

} catch (mysqli_sql_exception $e) {
    $kode_error = $e->getCode();
    mysqli_stmt_close($stmt);

    if ($kode_error === 1062) {
        $_SESSION['pesan_error'] =
            'NIS atau NISN sudah digunakan siswa lain.';
    } else {
        $_SESSION['pesan_error'] =
            'Gagal memperbarui data siswa.';
    }

    header('Location: proses_edit_siswa.php?id=' . $id);
    exit;
}

$_SESSION['pesan_error'] = 'Gagal memperbarui data siswa.';
header('Location: proses_edit_siswa.php?id=' . $id);
exit;
?>
