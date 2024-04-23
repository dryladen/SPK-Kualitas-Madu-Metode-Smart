<!DOCTYPE html>
<html lang="en">

<?php
include('components/koneksi.php');
$_SESSION['success'] = "";
$username = "";

if (isset($_POST['submit'])) {
    session_start();
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    $password = md5($pass);
    $queryUser = mysqli_query($koneksi, "SELECT * FROM users WHERE username ='$username' AND password ='$password'");
    $cekUser = mysqli_num_rows($queryUser);
    $dataUser = mysqli_fetch_array($queryUser);
    if ($cekUser == 0) {
        echo "<script>alert('Username atau Password Anda salah. Silahkan coba lagi!')</script>";
    } else if ($cekUser > 0) {
        // Storing username in session variable
        $_SESSION['id'] = $dataUser['id_admin'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $dataUser['role'];
        $_SESSION['success'] = "You have logged in!";
        header('Location: pages/beranda.php');
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>SPK Pemilihan Kualitas Madu</title>
</head>

<body>
    <div class='container-login'>
        <div class="box-login">
            <h2>Login</h2>
            <form action="" method="POST">
                <input class="input-login" type="text" name="username" placeholder="Username">
                <input class="input-login" type="password" name="password" placeholder="Password">
                <input class="btn-submit" type="submit" name="submit" value="Masuk">
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>