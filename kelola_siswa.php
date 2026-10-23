
<?php
// kelola_data_siswa.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM t_siswa ORDER BY nama ASC";
$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Notifikasi berhasil atau gagal
$pesan = $_GET['pesan'] ?? '';
$notifikasi = '';
$jenis_notifikasi = 'success';

if ($pesan === 'edit') {
    $notifikasi = 'Data siswa berhasil diperbarui.';
} elseif ($pesan === 'hapus' || $pesan === 'hapus_berhasil') {
    $notifikasi = 'Data siswa berhasil dihapus.';
} elseif ($pesan === 'tambah') {
    $notifikasi = 'Data siswa berhasil ditambahkan.';
} elseif ($pesan === 'hapus_gagal') {
    $notifikasi = 'Data siswa gagal dihapus atau tidak ditemukan.';
    $jenis_notifikasi = 'danger';
}

// Notifikasi dari session
if (!empty($_SESSION['pesan_sukses'])) {
    $notifikasi = $_SESSION['pesan_sukses'];
    $jenis_notifikasi = 'success';
    unset($_SESSION['pesan_sukses']);
} elseif (!empty($_SESSION['pesan_error'])) {
    $notifikasi = $_SESSION['pesan_error'];
    $jenis_notifikasi = 'danger';
    unset($_SESSION['pesan_error']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Siswa - Sistem Pelanggaran Siswa</title>

    <!-- Bootstrap 4.6.2 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- CSS DataTables Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <?php include 'layout/sidebar.php'; ?>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">

            <h1>Data Siswa</h1>
            <p>Selamat datang di halaman Siswa.</p>

            <!-- NOTIFIKASI -->
            <?php if ($notifikasi !== '') { ?>
                <div class="alert alert-<?= htmlspecialchars($jenis_notifikasi) ?> alert-dismissible fade show"
                     role="alert">

                    <?= htmlspecialchars($notifikasi) ?>

                    <button type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            <?php } ?>

            <p>
                <a href="dashboard.php" class="btn btn-primary">
                    Kembali ke Dashboard
                </a>

                <a href="tambah_siswa.php" class="btn btn-success">
                    Tambah Siswa
                </a>
            </p>

            <!-- TABEL SISWA -->
            <div class="table-responsive">
                <table id="tabelSiswa"
                       class="table table-bordered table-striped table-hover">

                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Status Aktif</th>
                            <th>Dibuat</th>
                            <th>Diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
                        <tr>
                            <td></td>

                            <td><?= htmlspecialchars($row['nis']) ?></td>
                            <td><?= htmlspecialchars($row['nisn']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>

                            <td>
                                <?= ($row['status_aktif'] == 1)
                                    ? 'Aktif'
                                    : 'Tidak Aktif' ?>
                            </td>

                            <td><?= htmlspecialchars($row['created_at'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['updated_at'] ?? '') ?></td>

                            <td>
                                <a href="edit_siswa.php?id=<?= urlencode($row['id']) ?>"
                                   class="btn btn-primary btn-sm mb-1">
                                    Edit
                                </a>

                                <a href="hapus_siswa.php?id=<?= urlencode($row['id']) ?>"
                                   class="btn btn-danger btn-sm mb-1"
                                   onclick="return confirm('Yakin ingin menghapus data siswa ini?');">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>

        </main>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<!-- Pengaturan DataTables -->
<script>
$(document).ready(function () {

    var tabel = $('#tabelSiswa').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        order: [[3, 'asc']],

        columnDefs: [
            {
                targets: [0, 10],
                orderable: false,
                searchable: false
            }
        ],

        language: {
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Data siswa tidak ditemukan",
            emptyTable: "Belum ada data siswa",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            search: "Cari siswa:",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });

    // Nomor otomatis dan berurutan
    function nomorUrut() {
        var halaman = tabel.page.info().start;

        tabel.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.textContent = halaman + i + 1;
        });
    }

    tabel.on('draw.dt order.dt search.dt', nomorUrut);
    nomorUrut();

});
</script>

</body>
</html>
