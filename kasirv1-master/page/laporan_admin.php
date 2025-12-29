<?php
include '../config.php';
$data = mysqli_query($dbconnect, "
    SELECT laporan_keuangan.*, user.nama 
    FROM laporan_keuangan 
    JOIN user ON laporan_keuangan.id_kasir = user.id_user
    ORDER BY tanggal DESC
");
?>

<h3>Laporan Keuangan Kasir</h3>

<table class="table table-bordered">
<tr>
    <th>Judul</th>
    <th>Kasir</th>
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th>File</th>
</tr>

<?php while($row = mysqli_fetch_array($data)) { ?>
<tr>
    <td><?= $row['judul'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['tanggal'] ?></td>
    <td><?= $row['keterangan'] ?></td>
    <td>
        <a href="laporan/<?= $row['file'] ?>" target="_blank" class="btn btn-success btn-sm">
            Download
        </a>
    </td>
</tr>
<?php } ?>
</table>
