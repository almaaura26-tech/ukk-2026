
<?php
// dashboard.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

// Menghitung jumlah data siswa
$sql_siswa = "SELECT COUNT(*) AS total FROM t_siswa";
$query_siswa = mysqli_query($koneksi, $sql_siswa);
$data_siswa = mysqli_fetch_assoc($query_siswa);
$total_siswa = $data_siswa['total'];

// Menghitung jumlah data guru
$sql_guru = "SELECT COUNT(*) AS total FROM t_guru";
$query_guru = mysqli_query($koneksi, $sql_guru);
$data_guru = mysqli_fetch_assoc($query_guru);
$total_guru = $data_guru['total'];

// Menghitung jumlah kelas
$sql_kelas = "SELECT COUNT(*) AS total FROM t_kelas";
$query_kelas = mysqli_query($koneksi, $sql_kelas);
$data_kelas = mysqli_fetch_assoc($query_kelas);
$total_kelas = $data_kelas['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <?php include "layout/sidebar.php"; ?>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">

            <h2>Dashboard</h2>

            <p>
                Selamat datang di halaman dashboard.
            </p>

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
                    <div class="card shadow-sm bg-warning text-dark">
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

                <!-- CARD DATA SISWA -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Data Tahun Ajaran</h5>

                            <h2>
                                <?= $total_siswa ?>
                            </h2>

                            <a href="kelola_siswa.php"
                               class="btn btn-light btn-sm">
                                Lihat Data Tahun Ajaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>