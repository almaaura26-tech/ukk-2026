
<?php
//dashboard.php
include 'includes/cek_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 bg-dark min-vh-100 p-3">
            <h4 class="text-white mb-4">
                My Website
            </h4>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link active">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_siswa.php" class="nav-link text-white">
                        kelola siswa
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_guru.php" class="nav-link text-white">
                        kelola guru
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_kelas.php" class="nav-link text-white">
                        kelola kelas
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_tahun_ajaran.php" class="nav-link text-white">
                        kelola tahun ajaran
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_wali_kelas.php" class="nav-link text-white">
                        kelola wali kelas
                    </a>

                    </li>
                <li class="nav-item mb-2">
                    <a href="penempatan_siswa.php" class="nav-link text-white">
                        penempatan siswa
                    </a>
                    </li>
                <li class="nav-item mb-2">
                    <a href="kelola_pelanggaran_kategori.php" class="nav-link text-white">
                        kelola pelanggaran kategori
                    </a>

                    <li class="nav-item mb-2">
                    <a href="aboutme.php" class="nav-link text-white">
                        About me
                    </a>

                </li>
                <hr class="text-secondary">
                <li class="nav-item">
                    <a href="#" class="nav-link text-danger">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">
            <h2>Dashboard</h2>
            <p>
                Selamat datang di halaman dashboard.
            </p>
            <div class="row">
                <!-- CARD DATA SISWA -->
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                Data Siswa
                            </h5>
                            <h2>
                                120
                            </h2>
                        </div>
                    </div>
                </div>
                <!-- CARD DATA GURU -->
                <div class="col-md-5">
                    <div class="card shadow-sm">
                        <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title">
                                Data Guru
                            </h5>
                            <h2>
                                25
                            </h2>
                        </div>
                    </div>
                </div>
                <!-- CARD KELAS -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                Kelas
                            </h5>
                            <h2>
                             12
                          </h2>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
    <h2>Dashboard</h2>
    <p>
        Selamat datang,
        <?php echo $_SESSION['nama_user']; ?>
    </p>
    <p>
        Anda berhasil login.
    </p>
    <a href="logout.php">Logout</a>
</body>
</html>

<!DOCYTPE html>
<html>
    <head>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>login - Pelanggaran Siswa</title>
        <title>dashboard - Pelanggaran Siswa</title>
    <head>
    <body>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <h1>selamat datang, <?php echo $_SESSION['name']; ?></h1>
        <p>anda login sebagai: <?php echo $_SESSION['role']; ?></p>


        <ul>
            <?php if($_SESSION['role'] == 'admin'){ ?>
        <li><a href="kelola_guru.php">kelola guru</a></li>
        <li><a href="kelola_siswa.php">kelola siswa</a></li>
        <li><a href="kelola_kelas.php">kelola kelas</a></li>
        <li><a href="kelola_tahun_ajaran.php">kelola tahun ajaran</a></li>
        <li><a href="kelola_wali_kelas.php">kelola wali kelas</a></li>
        <li><a href="kelola_pelanggaran_kategori.php">kelola pelanggaran kategori</a></li>
        <li><a href="penempatan_siswa.php">penempatan siswa</a></li>
        <li><a href="aboutme.php">About me/a></li>
    <?php } ?>

        <?php if ($_SESSION['role'] == 'guru'){ ?>
        <li><a href="menu3.php">menu 3</a></li>
        <li><a href="menu4.php">menu 4</a></li>
            <?php } ?>
</ul>
        <a href="logout.php">logout</a>
</body>
</html>