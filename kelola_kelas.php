
<?php
// Data_kelas.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM t_kelas ORDER BY nama ASC";
$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// NOTIFIKASI BERHASIL ATAU GAGAL
$pesan = $_GET['pesan'] ?? '';
$notifikasi = '';
$jenis_notifikasi = 'success';

if ($pesan === 'edit') {
    $notifikasi = 'Data kelas berhasil diperbarui.';
} elseif ($pesan === 'hapus' || $pesan === 'hapus_berhasil') {
    $notifikasi = 'Data kelas berhasil dihapus.';
} elseif ($pesan === 'tambah') {
    $notifikasi = 'Data kelas berhasil ditambahkan.';
} elseif ($pesan === 'hapus_gagal') {
    $notifikasi = 'Data kelas gagal dihapus atau tidak ditemukan.';
    $jenis_notifikasi = 'danger';
} elseif ($pesan === 'edit_gagal') {
    $notifikasi = 'Data kelas gagal diperbarui.';
    $jenis_notifikasi = 'danger';
}

// NOTIFIKASI DARI SESSION
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

    <title>Data Kelas</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css">
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <?php include 'layout/sidebar.php'; ?>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">

            <h2>Data Kelas</h2>
            <p>Selamat datang di halaman Kelas.</p>

            <!-- NOTIFIKASI -->
            <?php if ($notifikasi !== '') { ?>

                <div class="alert alert-<?= htmlspecialchars($jenis_notifikasi) ?> alert-dismissible fade show"
                     role="alert">

                    <?= htmlspecialchars($notifikasi) ?>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Tutup">
                    </button>

                </div>

            <?php } ?>

            <div class="mb-3">

                <a href="dashboard.php" class="btn btn-primary">
                    Kembali ke Dashboard
                </a>

                <a href="tambah_kelas.php" class="btn btn-success">
                    + Tambah Kelas
                </a>

            </div>

            <!-- TABEL DATA KELAS -->
            <div class="table-responsive">

                <table id="tabelKelas"
                       class="table table-striped table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Tingkat</th>
                            <th>Jurusan</th>
                            <th>Status Aktif</th>
                            <th>Dibuat</th>
                            <th>Diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>

                            <tr>

                                <!-- Nomor otomatis -->
                                <td></td>

                                <td>
                                    <?= htmlspecialchars($row['nama']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['tingkat']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['jurusan']) ?>
                                </td>

                                <td>
                                    <?php if ($row['status_aktif'] == 1) { ?>
                                        <span class="badge bg-success">
                                            Aktif
                                        </span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger">
                                            Tidak Aktif
                                        </span>
                                    <?php } ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['created_at'] ?? '') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['updated_at'] ?? '') ?>
                                </td>

                                <td>

                                    <a href="edit_kelas.php?id=<?= urlencode($row['id']) ?>"
                                       class="btn btn-primary btn-sm mb-1">
                                        Edit
                                    </a>

                                    <a href="hapus_kelas.php?id=<?= urlencode($row['id']) ?>"
                                       class="btn btn-danger btn-sm mb-1"
                                       onclick="return confirm('Yakin ingin menghapus data kelas ini?');">
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    var tabel = $('#tabelKelas').DataTable({

        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        order: [[1, 'asc']],

        columnDefs: [
            {
                targets: 0,
                orderable: false,
                searchable: false
            },
            {
                targets: 7,
                orderable: false,
                searchable: false
            }
        ],

        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            zeroRecords: "Data kelas tidak ditemukan",
            emptyTable: "Belum ada data kelas",

            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },

        // Nomor urut otomatis
        drawCallback: function () {

            var api = this.api();
            var info = api.page.info();

            api.column(0, {
                page: 'current'
            }).nodes().each(function (cell, i) {

                cell.innerHTML = info.start + i + 1;

            });

        }

    });

});
</script>

</body>
</html>
