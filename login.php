<?php
require_once('connection.php');
$listUser = $conn->query("SELECT * From user")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['register'])) {
    header('Location: register.php');
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "admin" && $password == "admin") {
        header('Location:admin.php');
    } else {
        $idxUser = -1;
        foreach ($listUser as $key => $val) {
            if ($username == $val['username_user'] && $password == $val['password_user']) {
                $idxUser = $val['kode_user'];
            }
        }
        if ($idxUser != -1) {
            header('Location:user.php');
            $_SESSION['idxUser'] = $idxUser;
        }
    }
}

if(isset($_POST['home'])){
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="banner">
        <div class="bangunan"></div>
        <div class="container">
            <div class="apalah">
                <div class="atas">
                    <!-- <div class="kiri"></div> -->
                    <h1>Login</h1>
                    <div class="kanan">
                    </div>
                </div>
                <div class="cb"></div>
                <div class="bawah">
                    <form action="" method="post">
                    <label for="">Username :</label>
                    <br>
                    <input type="text" name="username" id="" placeholder="username">
                    <br><br>
                    <label for="">Password :</label>
                    <br><input type="password" name="password" id="" placeholder="password">
                    <br>
                    <div class="button">
                        <!-- <input type="submit" value="Login" name="login" class="login"> -->
                        <button value="Login" name="login" class="login"><span>Login</span></button>
                        <button name="register" value="register" class="register"><span>Register </span></button>
                        <button name="home" value="home" class="home"><span>Home </span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>