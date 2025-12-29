<?php
// ===============================
// KASIR.PHP - FINAL
// ===============================

session_start();
include 'config.php';
include 'authcheckkasir.php';

// Ambil data barang (jika perlu)
$barang = mysqli_query($dbconnect, 'SELECT * FROM barang');

// Hitung total
$sum = 0;
if (!empty($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $value) {
    $sum += ($value['harga'] * $value['qty']) - $value['diskon'];
  }
}

// Nama user aman
$nama = $_SESSION['nama'] ?? 'Kasir';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kasir</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <!-- CSS Dashboard Global -->
  <link rel="stylesheet" href="assets/css/dashboard.css">

  <style>
    .pos-input {
      font-size: 20px;
      padding: 14px;
    }
    .total-box {
      background: #007bff;
      color: #fff;
      border-radius: 8px;
      padding: 20px;
    }
    .total-box h2 {
      font-size: 32px;
      margin: 0;
    }
    .cart-table td {
      vertical-align: middle;
    }
  </style>
</head>

<body class="bg-light">

<div class="container-fluid">
  <!-- HEADER -->
  <div class="row mb-3 align-items-center">
    <div class="col-md-8">
      <h3>🧾 Kasir</h3>
      <small>Hai, <?= htmlspecialchars($nama); ?></small>
    </div>
    <div class="col-md-4 text-right">
      <a href="riwayat.php" class="btn btn-outline-secondary btn-sm">Riwayat</a>
      <a href="keranjang_reset.php" class="btn btn-outline-danger btn-sm">Reset</a>
      <a href="logout.php" class="btn btn-outline-dark btn-sm">Logout</a>
    </div>
  </div>

  <div class="row">
    <!-- KIRI -->
    <div class="col-md-8">
      <form method="post" action="keranjang_act.php">
        <input type="text" name="kode_barang"
               class="form-control pos-input mb-3"
               placeholder="Scan / Ketik Kode Barang"
               autofocus>
      </form>

      <form method="post" action="keranjang_update.php">
        <table class="table table-bordered table-hover cart-table">
          <thead class="thead-dark text-center">
            <tr>
              <th>Barang</th>
              <th width="15%">Harga</th>
              <th width="10%">Qty</th>
              <th width="20%">Subtotal</th>
              <th width="5%"></th>
            </tr>
          </thead>
          <tbody>

          <?php if (!empty($_SESSION['cart'])): ?>
          <?php foreach ($_SESSION['cart'] as $key => $value): ?>
            <tr>
              <td>
                <strong><?= htmlspecialchars($value['nama']); ?></strong><br>
                <?php if (!empty($value['diskon'])): ?>
                  <span class="badge badge-danger">
                    Diskon Rp <?= number_format($value['diskon']); ?>
                  </span>
                <?php endif; ?>
              </td>

              <td class="text-right">
                Rp <?= number_format($value['harga']); ?>
              </td>

              <td>
                <input type="number"
                       name="qty[<?= $key ?>]"
                       value="<?= $value['qty']; ?>"
                       class="form-control text-center">
              </td>

              <td class="text-right">
                Rp <?= number_format(($value['qty'] * $value['harga']) - $value['diskon']); ?>
              </td>

              <td class="text-center">
                <a href="keranjang_hapus.php?id=<?= $value['id']; ?>"
                   class="btn btn-danger btn-sm">✕</a>
              </td>
            </tr>
          <?php endforeach; endif; ?>

          </tbody>
        </table>

        <button type="submit" class="btn btn-success btn-sm">
          🔄 Perbarui
        </button>
      </form>
    </div>

    <!-- KANAN -->
    <div class="col-md-4">
      <div class="total-box mb-3">
        <h5>Total</h5>
        <h2>Rp <?= number_format($sum); ?></h2>
      </div>

      <form action="transaksi_act.php" method="POST">
        <input type="hidden" name="total" value="<?= $sum; ?>">

        <div class="form-group">
          <label>Bayar</label>
          <input type="text" id="bayar" name="bayar"
                 class="form-control form-control-lg" required>
        </div>

        <button type="submit"
                class="btn btn-primary btn-lg btn-block">
          ✅ Selesaikan Transaksi
        </button>
      </form>
    </div>
  </div>
</div>

<script>
const bayar = document.getElementById('bayar');
bayar.addEventListener('keyup', function () {
  this.value = this.value.replace(/\D/g, '')
    .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});
</script>

</body>
</html>
