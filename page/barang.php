<?php
// file: page/barang.php
$view = $dbconnect->query("SELECT * FROM barang");
?>

<div class="container-fluid mt-4">

  <!-- JUDUL -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">📦 Data Barang</h3>
    <div>
      <a href="barang_add.php" class="btn btn-primary btn-sm">➕ Tambah Data</a>
      <a href="barang_cetak_barcode.php" class="btn btn-success btn-sm">🖨 Cetak Barcode</a>
    </div>
  </div>

  <!-- CARD -->
  <div class="card shadow-sm">
    <div class="card-body">

      <table class="table table-hover table-bordered align-middle">
        <thead class="thead-dark text-center">
          <tr>
            <th width="5%">ID</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th width="15%">Harga</th>
            <th width="10%">Stok</th>
            <th width="18%">Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php while ($row = $view->fetch_assoc()) { ?>
          <tr>
            <td class="text-center"><?= $row['id_barang']; ?></td>
            <td><?= $row['kode_barang']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td class="text-center">
              <?php if ($row['jumlah'] > 0) { ?>
                <span class="badge badge-success"><?= $row['jumlah']; ?></span>
              <?php } else { ?>
                <span class="badge badge-danger">Habis</span>
              <?php } ?>
            </td>
            <td class="text-center">
              <a href="barang_edit.php?id=<?= $row['id_barang']; ?>" class="btn btn-warning btn-sm">
                ✏ Edit
              </a>
              <a href="barang_hapus.php?id=<?= $row['id_barang']; ?>"
                 onclick="return confirm('Yakin hapus data ini?')"
                 class="btn btn-danger btn-sm">
                🗑 Hapus
              </a>
            </td>
          </tr>
        <?php } ?>

        </tbody>
      </table>

    </div>
  </div>

</div>
