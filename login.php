
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Pelanggaran Siswa</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
</head>

<body class="bg-light">

<?php
session_start();

if (isset($_SESSION['pesan_error'])) {
    $pesan_error = $_SESSION['pesan_error'];
    unset($_SESSION['pesan_error']);
}
?>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container">
        <span class="navbar-brand mb-0 h1">
            📚 Pelanggaran Siswa
        </span>
    </div>
</nav>

<!-- HALAMAN LOGIN -->
<div class="container">
    <div class="row justify-content-center align-items-center"
         style="min-height: 85vh;">

        <div class="col-12 col-sm-10 col-md-7 col-lg-5">

            <div class="card shadow border-0 rounded-lg">

                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="font-weight-bold mb-2">
                        🔐 Login
                    </h3>

                    <p class="mb-0">
                        Aplikasi Pelanggaran Siswa
                    </p>
                </div>

                <div class="card-body p-4">

                    <p class="text-center text-muted mb-4">
                        Silakan login untuk melanjutkan
                    </p>

                    <!-- PESAN ERROR -->
                    <?php if (isset($pesan_error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($pesan_error); ?>
                        </div>
                    <?php } ?>

                    <!-- FORM LOGIN -->
                    <form action="proses_login.php" method="POST">

                        <div class="form-group">
                            <label for="email" class="font-weight-bold">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control form-control-lg"
                                placeholder="Masukkan email"
                                required
                                autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bold">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control form-control-lg"
                                placeholder="Masukkan password"
                                required>
                        </div>

                        <button type="submit"
                                class="btn btn-primary btn-lg btn-block mt-4">
                            Login
                        </button>

                    </form>

                </div>

                <div class="card-footer text-center text-muted">
                    <small>
                        Sistem Informasi Pelanggaran Siswa
                    </small>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

</body>
</html>
