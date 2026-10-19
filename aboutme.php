
<?php
session_start();
include "config/koneksi.php";

$nama = "Alma Aura Livia";
$kelas = "XI RPL";
$sekolah = "SMK Muhammadiyah Tasikmalaya";
$jurusan = "Rekayasa Perangkat Lunak";
$hobi = "Mendengarkan Musik";
$cita_cita = "POLWAN";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Saya</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="aboutme.php">
            Tentang Saya
        </a>

        <a href="dashboard.php" class="btn btn-success btn">
            Kembali ke Dashboard
        </a>
    </div>
</nav>

<div class="container py-5">

    <!-- PROFIL -->
    <div class="card border-0 shadow rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center text-center text-md-start">

                <div class="col-md-4 mb-3 mb-md-0 text-center">
                    <img src="img/alma.jpg"
                         alt="Foto Profil"
                         class="rounded-circle img-thumbnail shadow"
                         width="190"
                         height="190">
                </div>

                <div class="col-md-8">
                    <h1 class="fw-bold text-primary">
                        <?php echo htmlspecialchars($nama); ?>
                    </h1>

                    <h5 class="text-secondary mb-3">
                        <?php echo htmlspecialchars($kelas); ?>
                    </h5>

                    <span class="badge bg-primary fs-6">
                        <?php echo htmlspecialchars($sekolah); ?>
                    </span>

                    <p class="mt-3 mb-0 text-secondary">
                        Selamat datang di halaman profil saya!
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- INFORMASI DIRI -->
    <div class="card border-0 shadow rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">

            <h3 class="fw-bold text-primary mb-4">
                Informasi Tentang Saya
            </h3>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="card bg-primary-subtle border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-secondary">Nama Lengkap</h6>
                            <h5><?php echo htmlspecialchars($nama); ?></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-info-subtle border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-secondary">Kelas</h6>
                            <h5><?php echo htmlspecialchars($kelas); ?></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-success-subtle border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-secondary">Sekolah</h6>
                            <h5><?php echo htmlspecialchars($sekolah); ?></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-warning-subtle border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-secondary">Jurusan</h6>
                            <h5><?php echo htmlspecialchars($jurusan); ?></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-danger-subtle border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-secondary">Hobi</h6>
                            <h5><?php echo htmlspecialchars($hobi); ?></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-info-subtle border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-secondary">Cita-cita</h6>
                            <h5><?php echo htmlspecialchars($cita_cita); ?></h5>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- DESKRIPSI -->
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-4 p-md-5">

            <h3 class="fw-bold text-primary mb-3">
                Deskripsi Saya
            </h3>

            <p class="text-secondary lh-lg">
                Saya adalah seorang pelajar yang sedang belajar
                Rekayasa Perangkat Lunak. Saya senang mempelajari
                teknologi dan membuat website. Saya ingin terus
                belajar agar bisa menjadi Web Developer.
            </p>

            <a href="dashboard.php" class="btn btn-primary mt-2">
                &larr; Kembali ke Dashboard
            </a>

        </div>
    </div>

    <div class="text-center text-secondary mt-4">
        <small>&copy; 2026 Alma Aura Livia</small>
    </div>

</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
