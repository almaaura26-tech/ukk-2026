<?php
// Memeriksa session login
include "includes/cek_session.php";

// Mengambil data pengguna
$nama = $_SESSION['nama'] ?? $_SESSION['nama_lengkap'] ?? '';
$email = $_SESSION['email'] ?? '-';
$role = $_SESSION['role'] ?? '-';

// Menghubungkan database
include "config/koneksi.php";

// Menghitung jumlah data dari database
function hitungData($koneksi, $tabel)
{
    $tabelDiizinkan = ['t_siswa', 't_guru', 't_kelas', 't_wali_kelas', 't_tahun_ajaran', 't_pelanggaran_kategori', 't_pelanggaran'];

    if (!in_array($tabel, $tabelDiizinkan, true)) {
        return 0;
    }

    $sql = "SELECT COUNT(*) AS total FROM `$tabel`";
    $hasil = mysqli_query($koneksi, $sql);

    if (!$hasil) {
        die(
            "Gagal menghitung data pada tabel " .
            htmlspecialchars($tabel) .
            ". Periksa nama tabel di database. Error: " .
            htmlspecialchars(mysqli_error($koneksi))
        );
    }

    $data = mysqli_fetch_assoc($hasil);

    return (int) $data['total'];
}

// Jumlah data otomatis
$total_siswa = hitungData($koneksi, 't_siswa');
$total_guru = hitungData($koneksi, 't_guru');
$total_kelas = hitungData($koneksi, 't_kelas');
$total_wali_kelas = hitungData($koneksi, 't_wali_kelas');
$total_tahun_ajaran = hitungData($koneksi, 't_tahun_ajaran');
$total_kategori_pelanggaran = hitungData($koneksi, 't_pelanggaran_kategori');
$total_pelanggaran = hitungData($koneksi, 't_pelanggaran');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">

    <title>Dashboard</title>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <?php
        include "layout/sidebar.php";
        ?>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">

            <h2>Dashboard</h2>

            <!-- Menampilkan data pengguna -->
            <?php if ($role == 'guru') { ?>

                <p>Selamat datang di halaman dashboard guru <b><?php echo htmlspecialchars($nama); ?></b></p>

            <?php } else { ?>

                <p>Selamat datang di halaman dashboard <b><?php echo htmlspecialchars($nama); ?></b></p>

            <?php } ?>

            <?php if ($role == 'admin') { ?>

                <div class="row">

                    <!-- CARD DATA SISWA -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Data Siswa</h5>

                            <h2>
                                <?= $total_siswa ?>
                            </h2>

                            <a href="kelola_siswa.php"
                               class="btn btn-light btn-sm">
                                Lihat Data Siswa
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD DATA GURU -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Data Guru</h5>

                            <h2>
                                <?= $total_guru ?>
                            </h2>

                            <a href="kelola_guru.php"
                               class="btn btn-light btn-sm">
                                Lihat Data Guru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD DATA KELAS -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Data Kelas</h5>

                            <h2>
                                <?= $total_kelas ?>
                            </h2>

                            <a href="kelola_kelas.php"
                               class="btn btn-light btn-sm">
                                Lihat Data Kelas
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD DATA TAHUN AJARAN -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Data Tahun Ajaran</h5>

                            <h2>
                                <?= $total_tahun_ajaran ?>
                            </h2>

                            <a href="kelola_tahun_ajaran.php"
                               class="btn btn-light btn-sm">
                                Lihat Data Tahun Ajaran
                            </a>
                        </div>
                    </div>
                </div>
                <!-- CARD DATA SISWA -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Data Wali Kelas</h5>

                            <h2>
                                <?= $total_wali_kelas ?>
                            </h2>

                            <a href="kelola_wali_kelas.php"
                               class="btn btn-light btn-sm">
                                Lihat Data Wali Kelas
                            </a>
                        </div>
                    </div>
                </div>
                <!-- CARD DATA SISWA -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Penempatan siswa</h5>

                            <h2>
                                <?= $total_siswa ?>
                            </h2>

                            <a href="penempatan_siswa.php"
                               class="btn btn-light btn-sm">
                                Lihat Data Penempatan siswa
                            </a>
                        </div>
                    </div>
                </div>
                 <!-- CARD DATA SISWA -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Kategori pelanggaran</h5>

                            <h2>
                                <?= $total_kategori_pelanggaran ?>
                            </h2>

                            <a href="kelola_pelanggaran_kategori.php"
                               class="btn btn-light btn-sm">
                                Lihat Data kategori pelanggaran
                            </a>
                        </div>
                    </div>
                </div>
                 <!-- CARD DATA SISWA -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Kategori jenis pelanggaran</h5>

                            <h2>
                                <?= $total_pelanggaran ?>
                            </h2>

                            <a href="kelola_jenis_pelanggaran.php"
                               class="btn btn-light btn-sm">
                                Lihat Data kategori pelanggaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <?php } elseif ($role == 'guru') { ?>

                <ul class="nav nav-pills flex-column">

             <!-- DASHBOARD GURU -->
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Catat Pelanggaran</h5>
                                <p>Mencatat pelanggaran siswa.</p>

                                <a href="catat_pelanggaran.php"
                                   class="btn btn-light btn-sm">
                                    Catat Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm bg-warning text-white">
                            <div class="card-body">
                                <h5 class="card-title">Riwayat Pelanggaran</h5>
                                <p>Melihat riwayat pelanggaran siswa.</p>

                                <a href="riwayat.php"
                                   class="btn btn-light btn-sm">
                                    Lihat Riwayat
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Rekap Poin</h5>
                                <p>Melihat jumlah poin pelanggaran.</p>

                                <a href="rekap_poin.php"
                                   class="btn btn-light btn-sm">
                                    Lihat Rekap
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } else { ?>

                <div class="alert alert-danger">
                    Role pengguna tidak dikenali.
                </div>

            <?php } ?>

        </main>

    </div>
</div>

</body>
</html>