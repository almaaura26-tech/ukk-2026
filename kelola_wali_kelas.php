
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
        ORDER BY g.nama ASC";

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

    <title>Kelola Wali Kelas</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- DataTables Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <?php include 'layout/sidebar.php'; ?>

        <main class="col-md-9 col-lg-10 p-4">

            <h1>Kelola Wali Kelas</h1>
            <p>Selamat datang di halaman Kelola Wali Kelas.</p>

            <div class="mb-3">
                <a href="dashboard.php" class="btn btn-primary">
                    Kembali ke Dashboard
                </a>

                <a href="tambah_wali_kelas.php" class="btn btn-success">
                    + Tambah Wali Kelas
                </a>
            </div>

            <div class="table-responsive">
                <table id="tabelWaliKelas"
                       class="table table-bordered table-striped table-hover">

                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
                            <th>Kelas</th>
                            <th>Status Aktif</th>
                            <th>Dibuat</th>
                            <th>Diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
                        <tr>
                            <!-- Nomor otomatis dari DataTables -->
                            <td></td>

                            <td>
                                <?= htmlspecialchars($row['nama_guru'] ?? '-') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['nama_kelas'] ?? '-') ?>
                            </td>

                            <td>
                                <?php if (isset($row['status_aktif']) && $row['status_aktif'] == 1) { ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php } else { ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php } ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['created_at'] ?? '') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['updated_at'] ?? '') ?>
                            </td>

                            <td>
                                <a href="edit_wali_kelas.php?id=<?= urlencode($row['id']) ?>"
                                   class="btn btn-primary btn-sm">
                                    Edit
                                </a>

                                <a href="hapus_wali_kelas.php?id=<?= urlencode($row['id']) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data wali kelas ini?');">
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

    var tabel = $('#tabelWaliKelas').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],

        // Urutkan berdasarkan nama guru (kolom kedua)
        order: [[1, 'asc']],

        // Nomor mengikuti urutan dan halaman tabel
        columnDefs: [
            {
                targets: 0,
                orderable: false,
                searchable: false
            },
            {
                targets: 6,
                orderable: false,
                searchable: false
            }
        ],

        language: {
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Data wali kelas tidak ditemukan",
            emptyTable: "Belum ada data wali kelas",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            search: "Cari wali kelas:",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });

    // Perbarui nomor setiap tabel digambar ulang
    tabel.on('order.dt search.dt draw.dt', function () {
        var nomorAwal = tabel.page.info().start;

        tabel.column(0, { search: 'applied', order: 'applied' })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = nomorAwal + i + 1;
            });
    }).draw();

});
</script>

</body>
</html>
```