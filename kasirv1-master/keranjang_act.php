<?php
include 'config.php';
session_start();
include 'authcheckkasir.php';

// ============================
// Pastikan $_SESSION['cart'] sudah ada dan berupa array
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// ============================

if (isset($_POST['kode_barang'])) {
    $kode_barang = $_POST['kode_barang'];
    $qty = 1;

    // Ambil data barang dari database
    $data = mysqli_query($dbconnect, "SELECT * FROM barang WHERE kode_barang='$kode_barang'");
    $b = mysqli_fetch_assoc($data);

    // Jika barang tidak ditemukan, redirect kembali
    if (!$b) {
        $_SESSION['error'] = "Barang dengan kode $kode_barang tidak ditemukan!";
        header('Location:kasir.php');
        exit;
    }

    // Ambil diskon barang jika ada
    $disbarang = mysqli_query($dbconnect, "SELECT * FROM disbarang WHERE barang_id='{$b['id_barang']}'");
    $disb = mysqli_fetch_assoc($disbarang);

    // ============================
    // Cek apakah barang sudah ada di keranjang
    // ============================
    $key = array_search($b['id_barang'], array_column($_SESSION['cart'], 'id'));

    if ($key !== false) {
        // Jika ada, tambahkan qty
        $_SESSION['cart'][$key]['qty'] += $qty;

        // Hitung diskon jika ada
        if ($disb && $disb['qty'] && $_SESSION['cart'][$key]['qty'] >= $disb['qty']) {
            $mod = $_SESSION['cart'][$key]['qty'] % $disb['qty'];
            $d = ($mod == 0) ? ($_SESSION['cart'][$key]['qty'] / $disb['qty']) :
                                 (($_SESSION['cart'][$key]['qty'] - $mod) / $disb['qty']);
            $_SESSION['cart'][$key]['diskon'] = $d * $disb['potongan'];
        }
    } else {
        // Jika belum ada, tambahkan barang baru
        $_SESSION['cart'][] = [
            'id' => $b['id_barang'],
            'nama' => $b['nama'],
            'harga' => $b['harga'],
            'qty' => $qty,
            'diskon' => 0
        ];
    }

    // Redirect kembali ke halaman kasir
    header('Location:kasir.php');
    exit;
}
?>
