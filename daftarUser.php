<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | WarungModern</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Form Daftar</h2>
        <form action="" method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" required> 
            <input type="email" name="email" placeholder="Email" class="input-control" required>
            <input type="text" name="username" placeholder="Username" class="input-control" required>
            <input type="password" name="password" placeholder="Password" class="input-control" required>
            <input type="submit" name="submit" value="Daftar" class="btn">
        </form>
        <?php 
            if (isset($_POST['submit'])) {
                include 'db.php';

                $nama = mysqli_real_escape_string($conn, $_POST['nama']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = MD5($_POST['password']);

                // Periksa apakah username sudah terdaftar
                $checkUser = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
                if (mysqli_num_rows($checkUser) > 0) {
                    echo '<script>alert("Username sudah terdaftar, gunakan username lain.")</script>';
                } else {
                    // Simpan data ke database
                    $insert = mysqli_query($conn, "INSERT INTO user (Nama, Email, username, password) 
                                                    VALUES ('$nama', '$email', '$username',  '$password')");

                    if ($insert) {
                        echo '<script>alert("Pendaftaran berhasil! Silakan login."); window.location="loginUser.php";</script>';
                    } else {
                        echo '<script>alert("Gagal mendaftar, coba lagi.")</script>';
                    }
                }
            }
        ?>
    </div>
</body>
</html>
