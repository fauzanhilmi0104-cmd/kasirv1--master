<?php
session_start();
include 'config.php';
include 'authcheckkasir.php';

/* =========================
   HAPUS TRANSAKSI
   ========================= */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($dbconnect, "DELETE FROM transaksi_detail WHERE id_transaksi='$id'");
    mysqli_query($dbconnect, "DELETE FROM transaksi WHERE id_transaksi='$id'");

    $_SESSION['success'] = "Transaksi berhasil dihapus";
    header("Location: riwayat_transaksi.php");
    exit;
}

// Ambil data transaksi
$view = mysqli_query($dbconnect, "SELECT * FROM transaksi ORDER BY tanggal_waktu DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            border-radius: 10px;
        }
        .table th {
            background: #343a40;
            color: #fff;
            text-align: center;
        }
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📑 Riwayat Transaksi</h3>
        <a href="kasir.php" class="btn btn-secondary btn-sm">← Kembali ke Kasir</a>
    </div>

    <!-- ALERT -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $_SESSION['success']; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php $_SESSION['success'] = ''; ?>
    <?php endif; ?>

    <!-- CARD -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Kasir</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (mysqli_num_rows($view) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($view)): ?>
                        <tr>
                            <td><?= $row['nomor']; ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['tanggal_waktu'])); ?></td>
                            <td class="text-right">
                                Rp <?= number_format($row['total']); ?>
                            </td>
                            <td><?= $row['nama']; ?></td>
                            <td>
                                <a href="unduh_struk.php?idtrx=<?= $row['id_transaksi']; ?>"
                                   class="btn btn-primary btn-sm">
                                   🧾 Struk
                                </a>

                                <a href="?hapus=<?= $row['id_transaksi']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                   🗑 Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-muted">Belum ada transaksi</td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
