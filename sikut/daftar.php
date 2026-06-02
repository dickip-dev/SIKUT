<?php
require_once 'koneksi.php';

$keyword = '';
$sql     = "SELECT * FROM buku_tamu ORDER BY tanggal DESC, waktu DESC";

if (!empty($_GET['cari'])) {
    $keyword = trim($_GET['cari']);
    $stmt    = mysqli_prepare($conn,
        "SELECT * FROM buku_tamu
         WHERE nama LIKE ? OR instansi LIKE ?
         ORDER BY tanggal DESC, waktu DESC"
    );
    $like = '%' . $keyword . '%';
    mysqli_stmt_bind_param($stmt, "ss", $like, $like);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, $sql);
}

$total       = mysqli_num_rows($result);
$total_semua = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM buku_tamu"))['total'];
$hari_ini    = date('Y-m-d');
$total_hari  = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) as total FROM buku_tamu WHERE tanggal = '$hari_ini'"
))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKUT — Daftar Tamu</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-sikut navbar-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">
            <img src="img/logo.png" alt="SIKUT" height="42">
        </a>
        <a href="index.php" class="btn btn-outline-light btn-sm px-3">
            ✏️ Form Tamu
        </a>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>📄 Daftar Tamu</h1>
        <p>Riwayat seluruh kunjungan yang telah tercatat</p>
    </div>
</div>

<div class="container pb-5">

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert"
         style="background:#F5F2E8;border:1.5px solid #9BAAB8;color:#2D3155;">
        ✅ Data <strong><?= htmlspecialchars($_GET['nama'] ?? '') ?></strong>
        berhasil disimpan, tercatat pukul <?= date('H:i') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="row mt-4 mb-4 g-3">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div>
                    <div class="stat-value"><?= $total_semua ?></div>
                    <div class="stat-label">Total Semua Tamu</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div>
                    <div class="stat-value"><?= $total_hari ?></div>
                    <div class="stat-label">Tamu Hari Ini</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">🔍</div>
                <div>
                    <div class="stat-value"><?= $total ?></div>
                    <div class="stat-label">
                        <?= $keyword ? 'Hasil Pencarian' : 'Menampilkan Data' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-sikut">
        <div class="card-body p-0">

            <div class="d-flex align-items-center justify-content-between p-3 toolbar-sikut flex-wrap gap-2">
                <h6 class="fw-bold mb-0" style="color:#2D3155">
                    📋 Data Kunjungan
                    <?php if ($keyword): ?>
                        <span style="color:#9BAAB8;font-weight:400;font-size:.85rem">
                            — "<?= htmlspecialchars($keyword) ?>"
                        </span>
                    <?php endif; ?>
                </h6>
                <form method="GET" action="daftar.php" class="d-flex gap-2">
                    <input type="text" name="cari" class="search-box"
                           placeholder="🔍  Cari nama/instansi..."
                           value="<?= htmlspecialchars($keyword) ?>">
                    <button type="submit" class="btn btn-sikut btn-sm px-3">Cari</button>
                    <?php if ($keyword): ?>
                        <a href="daftar.php" class="btn btn-sm btn-outline-secondary">✕ Reset</a>
                    <?php endif; ?>
                </form>
            </div>

            <?php if ($total > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover table-sikut mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Tujuan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)):
                        $tgl = date('d M Y', strtotime($row['tanggal']));
                        $wkt = date('H:i', strtotime($row['waktu']));
                    ?>
                        <tr>
                            <td style="color:#9BAAB8;font-size:.8rem"><?= $no++ ?></td>
                            <td style="font-weight:600;color:#2D3155">
                                <?= htmlspecialchars($row['nama']) ?>
                            </td>
                            <td>
                                <span class="badge-instansi">
                                    <?= htmlspecialchars($row['instansi']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge-tujuan" title="<?= htmlspecialchars($row['tujuan']) ?>">
                                    <?= htmlspecialchars($row['tujuan']) ?>
                                </span>
                            </td>
                            <td style="font-size:.85rem;color:#2D3155">
                                <?= $tgl ?>
                            </td>
                            <td style="font-size:.85rem;font-weight:600;color:#2D3155">
                                <?= $wkt ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <?php else: ?>
            <div class="text-center py-5">
                <div style="font-size:3rem">📭</div>
                <h6 class="mt-3 fw-bold" style="color:#2D3155">
                    <?= $keyword ? 'Tidak ada hasil untuk "' . htmlspecialchars($keyword) . '"' : 'Belum ada data tamu' ?>
                </h6>
                <p style="color:#9BAAB8;font-size:.875rem">
                    <?= $keyword ? 'Coba kata kunci lain.' : 'Data akan muncul setelah tamu mengisi form.' ?>
                </p>
                <?php if (!$keyword): ?>
                <a href="index.php" class="btn btn-sikut btn-sm mt-2 px-4">✏️ Isi Form Tamu</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="footer-sikut">
        Tugas UTS SIKUT — Sistem Informasi Buku Tamu
    </div>

</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($stmt)) mysqli_stmt_close($stmt);
mysqli_free_result($result);
mysqli_close($conn);
?>