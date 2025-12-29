<?php
include 'config.php';
session_start();
include 'authcheckkasir.php';

if (isset($_POST['upload'])) {
    $judul = $_POST['judul'];
    $ket = $_POST['keterangan'];
    $id_kasir = $_SESSION['id_user']; // sesuaikan session kamu

    $file = $_FILES['file']['name'];
    $tmp  = $_FILES['file']['tmp_name'];

    move_uploaded_file($tmp, "laporan/".$file);

    mysqli_query($dbconnect, "INSERT INTO laporan_keuangan 
        (id_kasir, judul, file, keterangan, tanggal)
        VALUES 
        ('$id_kasir','$judul','$file','$ket',NOW())");

    header("Location: upload_laporan.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Laporan Keuangan</title>
</head>
<body>

<h2>Upload Rekapan / Catatan Keuangan</h2>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="judul" placeholder="Judul laporan" required><br><br>

    <input type="file" name="file" required><br><br>

    <textarea name="keterangan" placeholder="Keterangan"></textarea><br><br>

    <button type="submit" name="upload">Upload</button>
</form>

</body>
</html>
