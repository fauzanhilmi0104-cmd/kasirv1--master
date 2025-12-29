<?php
include 'config.php';
session_start();

if (isset($_POST['masuk'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($dbconnect, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $data  = mysqli_fetch_assoc($query);
    $check = mysqli_num_rows($query);

    if ($check == 0) {
        $_SESSION['error'] = 'Username atau password salah';
    } else {
        $_SESSION['userid']  = $data['id_user'];
        $_SESSION['nama']    = $data['nama'];
        $_SESSION['role_id'] = $data['role_id'];
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Sistem Kasir</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <style>
        body {
            min-height: 100vh;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            max-width: 700px;
            width: 100%;
        }
        .info-box {
            background: #e9f5ff;
            padding: 20px;
            border-radius: 10px;
        }
        .form-signin {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,.1);
        }
    </style>
</head>

<body>

<div class="login-box">
    <div class="row">

        <!-- INFORMASI APLIKASI -->
        <div class="col-md-7 mb-3">
            <div class="info-box">
                <h4>Aplikasi Kasir</h4>
                <p>

Aplikasi ini digunakan untuk mencatat transaksi penjualan, mengelola data barang, dan menyimpan laporan keuangan secara digital agar lebih rapi dan mudah diakses.
                </p>
                <ul>
            Silahkan Login➜

                </ul>
            </div>
        </div>

        <!-- FORM LOGIN -->
        <div class="col-md-5">
            <form method="post" class="form-signin">

                <?php if (!empty($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; ?>
                    </div>
                <?php } $_SESSION['error'] = ''; ?>

                <h4 class="mb-3 text-center">Login</h4>

                <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                <button class="btn btn-primary btn-block" type="submit" name="masuk">
                    Masuk
                </button>

                <p class="mt-3 mb-0 text-muted text-center">
                    &copy; 2025 Ahmad Fauzan Hilmi
                </p>
            </form>
        </div>

    </div>
</div>

</body>
</html>
