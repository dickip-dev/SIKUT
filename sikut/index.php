<?php
require_once 'koneksi.php';

$error  = "";
$sukses = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama     = trim($_POST['nama']);
    $instansi = trim($_POST['instansi']);
    $tujuan   = trim($_POST['tujuan']);
    $tanggal  = $_POST['tanggal'];
    $waktu    = date('H:i:s');

    if (empty($nama) || empty($instansi) || empty($tujuan) || empty($tanggal)) {
        $error = "Semua field wajib diisi!";
    } else {

        $stmt = mysqli_prepare($conn,
            "INSERT INTO buku_tamu (nama, instansi, tujuan, tanggal, waktu)
             VALUES (?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $instansi, $tujuan, $tanggal, $waktu);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: daftar.php?status=sukses&nama=" . urlencode($nama));
            exit;
        } else {
            $error = "Gagal menyimpan data: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKUT — Form Tamu</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-sikut navbar-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">
            <img src="img/logo.png" alt="SIKUT" height="42">
        </a>
        <a href="daftar.php" class="btn btn-outline-light btn-sm px-3">
            📄 Daftar Tamu
        </a>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>👋 Selamat Datang</h1>
        <p>Silakan isi buku tamu digital sebelum melanjutkan kunjungan Anda</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                ⚠️ <?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="card card-sikut mt-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-1" style="color:#2D3155">📝 Data Kunjungan</h5>
                    <p style="color:#9BAAB8; font-size:.875rem; margin-bottom:24px">
                        Lengkapi semua data di bawah ini
                    </p>

                    <form method="POST" action="index.php">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control"
                                   placeholder="Masukkan nama lengkap Anda"
                                   value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Instansi / Asal <span class="text-danger">*</span></label>
                            <input type="text" name="instansi" class="form-control"
                                   placeholder="contoh: Unsia"
                                   value="<?= htmlspecialchars($_POST['instansi'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tujuan Kedatangan <span class="text-danger">*</span></label>
                            <textarea name="tujuan" class="form-control" rows="3"
                                      placeholder="Jelaskan keperluan kunjungan Anda"><?= htmlspecialchars($_POST['tujuan'] ?? '') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Kedatangan <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control"
                                       value="<?= $_POST['tanggal'] ?? '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Kedatangan</label>
                                <div class="waktu-box">
                                    <span>🕐</span>
                                    <div>
                                        <div class="waktu-value" id="jamSekarang">--:--:--</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-sikut btn-lg">
                                💾 Simpan Data Kunjungan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="footer-sikut">
                Tugas UTS SIKUT — Sistem Informasi Buku Tamu
            </div>

        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script>
    function updateJam() {
        const now = new Date();
        const jam = String(now.getHours()).padStart(2, '0');
        const mnt = String(now.getMinutes()).padStart(2, '0');
        const dtk = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('jamSekarang').textContent = jam + ':' + mnt + ':' + dtk;
    }
    updateJam();
    setInterval(updateJam, 1000);
</script>
</body>
</html>