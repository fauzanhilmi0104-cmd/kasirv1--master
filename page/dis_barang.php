<?php
// JOIN supaya dapat kode & nama barang
$view = $dbconnect->query("
  SELECT d.id, d.qty, d.potongan, b.kode_barang, b.nama
  FROM disbarang d
  JOIN barang b ON d.barang_id = b.id_barang
");
?>

<div class="container-fluid mt-4">

  <!-- JUDUL -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">🏷️ Diskon Barang</h3>
    <a href="dis_barang_add.php" class="btn btn-primary btn-sm">➕ Tambah Diskon</a>
  </div>

  <!-- CARD -->
  <div class="card shadow-sm">
    <div class="card-body">

      <table class="table table-hover table-bordered align-middle">
        <thead class="thead-dark text-center">
          <tr>
            <th width="5%">ID</th>
            <th>Barang</th>
            <th width="15%">Minimal Beli</th>
            <th width="20%">Potongan</th>
            <th width="18%">Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php while ($row = $view->fetch_assoc()) { ?>
          <tr>
            <td class="text-center"><?= $row['id']; ?></td>

            <td>
              <strong><?= $row['kode_barang']; ?></strong><br>
              <small class="text-muted"><?= $row['nama']; ?></small>
            </td>

            <td class="text-center">
              <span class="badge badge-info"><?= $row['qty']; ?></span>
            </td>

            <td>
              Rp <?= number_format($row['potongan'], 0, ',', '.'); ?>
            </td>

            <td class="text-center">
              <a href="dis_barang_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                ✏ Edit
              </a>
              <a href="dis_barang_hapus.php?id=<?= $row['id']; ?>"
                 onclick="return confirm('Yakin hapus diskon ini?')"
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
