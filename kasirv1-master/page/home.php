<?php
include '../config.php';

// Cek apakah table memiliki kolom tanggal
$cek_kolom = mysqli_query($dbconnect, "SHOW COLUMNS FROM transaksi LIKE 'tanggal'");
$punya_kolom_tanggal = mysqli_num_rows($cek_kolom);

// Total Barang
$total_barang = mysqli_num_rows(mysqli_query($dbconnect, "SELECT * FROM barang"));

// Total User
$total_user = mysqli_num_rows(mysqli_query($dbconnect, "SELECT * FROM user"));

// Total transaksi hari ini (aman meskipun tidak ada kolom tanggal)
if ($punya_kolom_tanggal) {
    $total_transaksi_hari_ini = mysqli_num_rows(
        mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE DATE(tanggal) = CURDATE()")
    );
} else {
    // Kalau tidak punya kolom tanggal → tampilkan total transaksi saja
    $total_transaksi_hari_ini = mysqli_num_rows(mysqli_query($dbconnect, "SELECT * FROM transaksi"));
}
?>

<div class="row">
    <div class="col-md-12">
       <h3>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h3>
        <p class="text-muted">Dashboard Sistem Kasir - <?php echo date('d F Y'); ?></p>
    </div>
</div>

<!-- Statistik Cards -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Barang</h5>
                <h2><?php echo $total_barang; ?></h2>
                <p class="card-text">Produk tersedia</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Total User</h5>
                <h2><?php echo $total_user; ?></h2>
                <p class="card-text">User terdaftar</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $punya_kolom_tanggal ? 'Transaksi Hari Ini' : 'Total Transaksi'; ?>
                </h5>
                <h2><?php echo $total_transaksi_hari_ini; ?></h2>
                <p class="card-text">Data transaksi</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Stok Menipis</h5>
                <h2>0</h2>
                <p class="card-text">Perlu restock</p>
            </div>
        </div>
    </div>
</div>
