<?php
require_once('connection.php');

$user = $conn->query("SELECT * From user")->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['register'])) {
    print_r($_POST);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $found = false;
    foreach ($user as $val) {
        if ($val['username_user'] == $username) {
            $found =  true;
        }
    }
    if ($username == "admin") {
        $found = true;
    }
    if ($found) {
        alert('Username telah terpakai');
    } else if ($confirm != $password) {
        alert('Password dan Confirm Password harus sama');
    } else if ($username == "" || $confirm == "" || $password == "" || $email == "" || $nama == "") {
        alert('Semua Field harus diisi');
    } else {
        $saldo = 1000000;
        $stmt = $conn->prepare("INSERT INTO `user` (`kode_user`, `username_user`, `password_user`, `nama_user`, `email_user`,`saldo_user`) VALUES ('', ?,?,?,?,?)");
        $stmt->bind_param("ssssi", $username, $password, $nama, $email, $saldo);
        $result = $stmt->execute();
        if ($result) {
            alert('Berhasil Register');
        } else {
            alert('Gagal Register');
        }
    }
}

if (isset($_POST['login'])) {
    header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Register</h1>
    <form action="" method="post">
        Username : <input type="text" name="username" id="">
        <br>
        Nama : <input type="text" name="nama" id="">
        <br>
        Password : <input type="text" name="password" id="">
        <br>
        Confirm Password : <input type="text" name="confirm" id="">
        <br>
        Email : <input type="text" name="email" id="">
        <br>
        <input type="submit" value="Register" name="register">
        <br>
        <button value="login" name="login">Login</button>
    </form>
</body>

</html>