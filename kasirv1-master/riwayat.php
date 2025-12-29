<?php

include 'config.php';
session_start();

include 'authcheckkasir.php';

/* =========================
   LOGIKA HAPUS TRANSAKSI
   ========================= */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($dbconnect, "DELETE FROM transaksi_detail WHERE id_transaksi='$id'");
    mysqli_query($dbconnect, "DELETE FROM transaksi WHERE id_transaksi='$id'");

    $_SESSION['success'] = "Transaksi berhasil dihapus";
    header("Location: riwayat_transaksi.php");
    exit;
}

$view = $dbconnect->query('SELECT * FROM transaksi');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Transaksi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">

	<?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>
		<div class="alert alert-success" role="alert">
			<?= $_SESSION['success'] ?>
		</div>
	<?php
        }
        $_SESSION['success'] = '';
    ?>

    <h1>Riwayat Transaksi</h1>
    <a href="/">Kembali</a>

	<table class="table table-bordered">
		<tr>
			<th>#Nomor</th>
			<th>Tanggal</th>
			<th>Total</th>
			<th>Kasir</th>
			<th>Aksi</th>
		</tr>

		<?php while ($row = $view->fetch_array()) { ?>
		<tr>
			<td><?= $row['nomor'] ?></td>
			<td><?= $row['tanggal_waktu'] ?></td>
			<td><?= $row['total'] ?></td>
			<td><?= $row['nama'] ?></td>
			<td>
				<a href="unduh_struk.php?idtrx=<?= $row['id_transaksi'] ?>" 
				   class="btn btn-primary btn-sm">
				   Lihat
				</a>

				<a href="?hapus=<?= $row['id_transaksi'] ?>" 
				   class="btn btn-danger btn-sm"
				   onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
				   Hapus
				</a>
			</td>
		</tr>
		<?php } ?>

	</table>
</div>
</body>
</html>
