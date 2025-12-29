<?php
$data = $dbconnect->query("SELECT * FROM user");
?>

<div class="container-fluid mt-4">

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">👤 Manajemen Pengguna</h3>
    <a href="user_add.php" class="btn btn-primary btn-sm">
      ➕ Tambah User
    </a>
  </div>

  <!-- CARD -->
  <div class="card shadow-sm">
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th width="5%">#</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Password</th>
              <th width="20%">Aksi</th>
            </tr>
          </thead>

          <tbody>
          <?php 
          $no = 1;
          while ($row = $data->fetch_assoc()) { 
          ?>
            <tr>
              <td class="text-center"><?= $no++; ?></td>
              <td><?= htmlspecialchars($row['nama']); ?></td>
              <td><?= htmlspecialchars($row['username']); ?></td>
              <td>
                <span class="badge badge-secondary">
                  <?= htmlspecialchars($row['password']); ?>
                </span>
              </td>
              <td class="text-center">
                <a href="user_edit.php?id=<?= $row['id_user']; ?>" 
                   class="btn btn-warning btn-sm">
                   ✏ Edit
                </a>
                <a href="user_hapus.php?id=<?= $row['id_user']; ?>" 
                   onclick="return confirm('Yakin hapus user ini?')" 
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

</div>
