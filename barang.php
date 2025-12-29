<?php
include 'config.php';
session_start();
include 'authcheck.php';

$view = $dbconnect->query("SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">

    <!-- CSS TAMBAHAN -->
    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 15px;
        }
        .btn {
            border-radius: 6px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <!-- ALERT -->
    <?php if (!empty($_SESSION['success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $_SESSION['success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php $_SESSION['success'] = ''; } ?>

    <!-- CARD -->
    <div class="card shadow-sm">

        <!-- CARD HEADER -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📦 Daftar Barang</h5>
            <div>
                <a href="/barang_add.php" class="btn btn-light btn-sm me-1">➕ Tambah Data</a>
                <a href="/barang_cetak_barcode.php" class="btn btn-success btn-sm">🖨 Cetak Barcode</a>
            </div>
        </div>

        <!-- CARD BODY -->
        <div class="card-body">

            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php while ($row = $view->fetch_array()) { ?>
                    <tr>
                        <td class="text-center"><?= $row['id_barang']; ?></td>
                        <td><?= $row['kode_barang']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td class="text-center">
                            <?php if ($row['jumlah'] > 0) { ?>
                                <span class="badge bg-success"><?= $row['jumlah']; ?></span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a href="/barang_edit.php?id=<?= $row['id_barang']; ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                            <a href="/barang_hapus.php?id=<?= $row['id_barang']; ?>"
                               onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                               class="btn btn-danger btn-sm">🗑 Hapus</a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>

        </div>
        <!-- END CARD BODY -->

    </div>
    <!-- END CARD -->

</div>

</body>
</html>
