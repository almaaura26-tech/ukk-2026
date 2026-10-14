<?php
// kelola_wali_kelas.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT
            w.*,
            k.nama AS nama_kelas,
            g.nama AS nama_guru
        FROM t_wali_kelas w
        LEFT JOIN t_kelas k ON w.kelas_id = k.id
        LEFT JOIN t_guru g ON w.guru_id = g.id
        ORDER BY w.id DESC";

$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Kelola Wali Kelas</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 bg-dark min-vh-100 p-3">
            <h4 class="text-white mb-4">
                My Website
            </h4>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item mb-2">
                    <a href="dashboard.php" class="nav-link text-white">
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
                    <a href="kelola_wali_kelas.php" class="nav-link active">
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
<h1>Kelola Wali Kelas</h1>

<p>
    <a href="dashboard.php">Kembali ke Dashboard</a> |
    <a href="tambah_wali_kelas.php">Tambah Wali Kelas</a>
</p>

<table  class="table table-sm">
    <tr>
        <th>ID</th>
        <th>Tahun Ajaran ID</th>
        <th>Kelas</th>
        <th>Guru</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['tahun_ajaran_id']; ?></td>
        <td><?php echo htmlspecialchars($row['nama_kelas'] ?? '-'); ?></td>
        <td><?php echo htmlspecialchars($row['nama_guru'] ?? '-'); ?></td>
        <td><?php echo $row['tanggal_mulai']; ?></td>
        <td><?php echo $row['tanggal_selesai']; ?></td>
        <td>
            <?php echo $row['status_aktif'] == 1
                ? 'Aktif' : 'Tidak Aktif'; ?>
        </td>
        <td>
            <a href="edit_wali_kelas.php?id=<?php echo $row['id']; ?>">
                Edit
            </a>
            |
            <a href="hapus_wali_kelas.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Yakin ingin menghapus data wali kelas ini?');">
                Hapus
            </a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>