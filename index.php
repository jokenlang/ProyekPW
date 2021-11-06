<?php
require_once('connection.php');
if (isset($_POST['register'])) {
    header('Location: register.php');
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "admin" && $password == "admin") {
        header('Location:admin.php');
    }
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
    <h1>Login</h1>
    <form action="" method="post">
        <label for="">Username :</label><input type="text" name="username" id="">
        <br>
        <label for="">Password :</label><input type="password" name="password" id="">
        <br>
        <input type="submit" value="Login" name="login">
        <br>
        <button name="register" value="register">Register</button>
    </form>

</body>

</html>