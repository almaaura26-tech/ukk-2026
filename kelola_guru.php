
<?php
// kelola_guru.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

// Ambil data guru
$sql = "SELECT * FROM t_guru ORDER BY nama ASC";
$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Notifikasi berhasil atau gagal
$pesan = $_GET['pesan'] ?? '';
$notifikasi = '';
$jenis_notifikasi = 'success';

if ($pesan === 'edit') {
    $notifikasi = 'Data guru berhasil diperbarui.';
} elseif ($pesan === 'hapus' || $pesan === 'hapus_berhasil') {
    $notifikasi = 'Data guru berhasil dihapus.';
} elseif ($pesan === 'tambah') {
    $notifikasi = 'Data guru berhasil ditambahkan.';
} elseif ($pesan === 'hapus_gagal') {
    $notifikasi = 'Data guru gagal dihapus atau tidak ditemukan.';
    $jenis_notifikasi = 'danger';
} elseif ($pesan === 'gagal') {
    $notifikasi = 'Data guru gagal diproses.';
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

    <title>Kelola Guru - Sistem Pelanggaran Siswa</title>

    <!-- Bootstrap 4.6.2 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- DataTables Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <?php include 'layout/sidebar.php'; ?>

        <!-- KONTEN UTAMA -->
        <main class="col-md-9 col-lg-10 p-4">

            <h1>Kelola Guru</h1>
            <p>Selamat datang di halaman Kelola Guru.</p>

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

            <!-- TOMBOL -->
            <div class="mb-3">
                <a href="dashboard.php" class="btn btn-primary">
                    Kembali ke Dashboard
                </a>

                <a href="tambah_guru.php" class="btn btn-success">
                    + Tambah Guru
                </a>
            </div>

            <!-- TABEL GURU -->
            <div class="table-responsive">
                <table id="tabelGuru"
                       class="table table-bordered table-striped table-hover">

                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status Aktif</th>
                            <th>Dibuat</th>
                            <th>Diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
                        <tr>
                            <!-- Nomor urut otomatis -->
                            <td></td>

                            <td>
                                <?= htmlspecialchars($row['nip'] ?? '') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['nama'] ?? '') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['email'] ?? '') ?>
                            </td>

                            <td>
                                <?php if ($row['status_aktif'] == 1) { ?>
                                    <span class="badge badge-success">
                                        Aktif
                                    </span>
                                <?php } else { ?>
                                    <span class="badge badge-secondary">
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
                                <a href="edit_guru.php?id=<?= urlencode($row['id']) ?>"
                                   class="btn btn-primary btn-sm mb-1">
                                    Edit
                                </a>

                                <a href="hapus_guru.php?id=<?= urlencode($row['id']) ?>"
                                   class="btn btn-danger btn-sm mb-1"
                                   onclick="return confirm('Yakin ingin menghapus data guru ini?');">
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

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {

    $('#tabelGuru').DataTable({

        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        ordering: true,
        searching: true,

        // Urutan awal berdasarkan nama guru
        order: [[2, 'asc']],

        language: {
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Data guru tidak ditemukan",
            emptyTable: "Belum ada data guru",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            search: "Cari guru:",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },

        // Kolom No tidak ikut diurutkan atau dicari
        columnDefs: [{
            targets: 0,
            orderable: false,
            searchable: false
        }],

        // Nomor otomatis dan berurutan
        drawCallback: function () {
            const api = this.api();
            const info = api.page.info();

            api.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                cell.innerHTML = info.start + i + 1;
            });
        }

    });

});
</script>

</body>
</html>
```