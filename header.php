<?php
require_once('connection.php');

if (isset($_POST['logout'])) {
    unset($_SESSION['idxUser']);
}

if (isset($_POST['login'])) {
    header('Location:login.php');
}

?>
<!--
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
                        <form action="" method="POST">
                            <button class="btn btn-primary" value="logout" name="logout">Logout</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>
</nav>-->

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="asset/logo.png" width="30" height="30" alt="">
            <div class="h2 text-white">AUTHENTICAL</div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto text-light">
                <li class="nav-item">
                    <a class="nav-link text-light" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="allProduct.php">All Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="aboutUs.php">About Us</a>
                </li>
            </ul>
            <a href="cart.php" class="nav-link text-light"><img src="asset/cart.png" alt=""></a>
            <?php
            if (isset($_SESSION['idxUser'])) {
                $idxUser = $_SESSION['idxUser'];
                $stmt = $conn->query("SELECT * FROM user WHERE kode_user='$idxUser'");
                $user = $stmt->fetch_assoc();
            ?>
                <a class="nav-link text-light" href="">Welcome, <?= $user['nama_user'] ?></a>
                <form action="" method="POST">
                    <button class="btn btn-danger" value="logout" name="logout">Logout</button>
                </form>
            <?php } else { ?>
                <form action="" method="POST">
                    <button class="btn btn-primary" value="login" name="login">Login Now</button>
                </form>
            <?php } ?>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
    </div>

</nav>