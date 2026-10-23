
<?php
// proses_tambah_guru.php

include 'includes/cek_session.php';
include 'config/koneksi.php';

// Pastikan form dikirim menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah_guru.php');
    exit;
}

// Ambil data dari form
$nip = trim($_POST['nip'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$konfirmasi_password = $_POST['konfirmasi_password'] ?? '';
$status_aktif = $_POST['status_aktif'] ?? '';

// Fungsi untuk kembali ke form dengan notifikasi
function kembaliKeForm($pesan, $nip = '', $nama = '', $email = '')
{
    $parameter = [
        'pesan' => $pesan,
        'nip' => $nip,
        'nama' => $nama,
        'email' => $email
    ];

    header('Location: tambah_guru.php?' . http_build_query($parameter));
    exit;
}

// Validasi NIP kosong
if ($nip === '') {
    kembaliKeForm('nip_kosong', $nip, $nama, $email);
}

// Validasi NIP harus 18 digit angka
if (!preg_match('/^[0-9]{18}$/', $nip)) {
    kembaliKeForm('nip_tidak_valid', $nip, $nama, $email);
}

// Validasi nama
if ($nama === '') {
    kembaliKeForm('nama_kosong', $nip, $nama, $email);
}

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    kembaliKeForm('email_tidak_valid', $nip, $nama, $email);
}

// Validasi password
if ($password === '') {
    kembaliKeForm('password_kosong', $nip, $nama, $email);
}

// Validasi konfirmasi password
if ($password !== $konfirmasi_password) {
    kembaliKeForm('password_tidak_cocok', $nip, $nama, $email);
}

// Validasi status aktif
if (!in_array((string)$status_aktif, ['0', '1'], true)) {
    kembaliKeForm('gagal', $nip, $nama, $email);
}

// Periksa apakah NIP sudah terdaftar
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT nip FROM t_guru WHERE nip = ?"
);

if (!$stmt) {
    kembaliKeForm('gagal', $nip, $nama, $email);
}

mysqli_stmt_bind_param($stmt, 's', $nip);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

$nip_ada = mysqli_stmt_num_rows($stmt) > 0;

mysqli_stmt_close($stmt);

if ($nip_ada) {
    kembaliKeForm('nip_terdaftar', $nip, $nama, $email);
}

// Periksa apakah email sudah terdaftar
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT email FROM t_guru WHERE email = ?"
);

if (!$stmt) {
    kembaliKeForm('gagal', $nip, $nama, $email);
}

mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

$email_ada = mysqli_stmt_num_rows($stmt) > 0;

mysqli_stmt_close($stmt);

if ($email_ada) {
    kembaliKeForm('email_terdaftar', $nip, $nama, $email);
}

// Enkripsi password sebelum disimpan
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Simpan data guru
$stmt = mysqli_prepare(
    $koneksi,
    "INSERT INTO t_guru (nip, nama, email, password, status_aktif)
     VALUES (?, ?, ?, ?, ?)"
);

if (!$stmt) {
    kembaliKeForm('gagal', $nip, $nama, $email);
}

mysqli_stmt_bind_param(
    $stmt,
    'ssssi',
    $nip,
    $nama,
    $email,
    $password_hash,
    $status_aktif
);

$berhasil = mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

if ($berhasil) {
    header('Location: tambah_guru.php?pesan=berhasil');
    exit;
}

// Jika penyimpanan gagal
kembaliKeForm('gagal', $nip, $nama, $email);
?>
