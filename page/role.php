<?php
$view = $dbconnect->query("SELECT * FROM role");
?>

<div class="container-fluid mt-4">

  <!-- JUDUL & TOMBOL -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">👥 Daftar Peran</h3>
    <a href="role_add.php" class="btn btn-primary btn-sm">
      ➕ Tambah Data
    </a>
  </div>

  <!-- CARD -->
  <div class="card shadow-sm">
    <div class="card-body">

      <table class="table table-hover table-bordered align-middle">
        <thead class="thead-dark text-center">
          <tr>
            <th width="15%">ID Peran</th>
            <th>Nama Peran</th>
            <th width="20%">Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php while ($row = $view->fetch_assoc()) { ?>
          <tr>
            <td class="text-center"><?= $row['id_role']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td class="text-center">
              <a href="role_edit.php?id=<?= $row['id_role']; ?>" 
                 class="btn btn-warning btn-sm">
                 ✏ Edit
              </a>
              <a href="role_hapus.php?id=<?= $row['id_role']; ?>"
                 onclick="return confirm('Yakin hapus peran ini?')"
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
