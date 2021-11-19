<?php
require_once('connection.php');

?>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand px-4" href="#">
                <img src="asset/logo.png" width="30" height="30" alt="">
                <div class="h2 text-white">AUTHENTICAL</div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-link" href="allProduct.php">All Products</a>
                    <a class="nav-link" href="#">About Us</a>
                    <a class="nav-link" href="login.php">Log In</a>
                    <a class="nav-link" href="register.php">Register</a>
                    <a class="nav-link" href="cart.php">Cart</a>
                    <?php
                    if (isset($_SESSION['idxUser'])) {
                        $idxUser = $_SESSION['idxUser'];
                        $stmt = $conn->query("SELECT * FROM user WHERE kode_user='$idxUser'");
                        $user = $stmt->fetch_assoc();
                    ?>
                        <a class="nav-link" href="">Welcome, <?= $user['nama_user'] ?></a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>
</nav>