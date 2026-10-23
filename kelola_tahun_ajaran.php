
<?php
// Data_tahun_ajaran.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM t_tahun_ajaran ORDER BY tanggal_mulai DESC, id DESC";
$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tahun Ajaran</title>

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

            <h2>Data Tahun Ajaran</h2>
            <p>Selamat datang di halaman Tahun Ajaran.</p>

            <div class="mb-3">
                <a href="dashboard.php" class="btn btn-primary">
                    Kembali ke Dashboard
                </a>

                <a href="tambah_tahun_ajaran.php" class="btn btn-success">
                    + Tambah Tahun Ajaran
                </a>
            </div>

            <!-- TABEL TAHUN AJARAN -->
            <div class="table-responsive">
                <table id="tabelTahunAjaran"
                       class="table table-striped table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Tahun Ajaran</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
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
                                <?= htmlspecialchars($row['nama']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['tanggal_mulai']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['tanggal_selesai']) ?>
                            </td>

                            <td>
                                <?php if ($row['status_aktif'] == 1) { ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                <?php } ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['created_at'] ?? '') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['updated_at'] ?? '') ?>
                            </td>

                            <td>
                                <a href="edit_tahun_ajaran.php?id=<?= urlencode($row['id']) ?>"
                                   class="btn btn-primary btn-sm mb-1">
                                    Edit
                                </a>

                                <a href="hapus_tahun_ajaran.php?id=<?= urlencode($row['id']) ?>"
                                   class="btn btn-danger btn-sm mb-1"
                                   onclick="return confirm('Yakin ingin menghapus data tahun ajaran ini?');">
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

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    var tabel = $('#tabelTahunAjaran').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],

        // Urutkan berdasarkan tanggal mulai terbaru
        order: [[2, 'desc']],

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
            zeroRecords: "Data tahun ajaran tidak ditemukan",
            emptyTable: "Belum ada data tahun ajaran",

            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });

    // Membuat nomor urut otomatis
    function nomorUrut() {
        tabel.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.textContent = i + 1;
        });
    }

    // Perbarui nomor saat tabel berubah
    tabel.on('draw.dt', function () {
        nomorUrut();
    });

    nomorUrut();

});
</script>

</body>
</html>
