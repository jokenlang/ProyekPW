<?php
require_once('connection.php');

if (isset($_POST['logout'])) {
    unset($_SESSION['idxUser']);
    header('Location:index.php');
}

if (isset($_POST['login'])) {
    // echo("test");
    header('Location:login.php');
    // http_redirect('login.php');
}

?>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <!-- <img src="asset/logo.png" width="30" height="30" alt=""> -->
            <div class="h2 text-white">AUTHENTICAL</div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto text-light">
                <li class="nav-item">
                    <a class="nav-link text-light" href="admin.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="reportAdmin.php">Transaction</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="#">
                <button class="btn btn-danger" value="logout" name="logout">Logout</button>
            </form>

        </div>
    </div>

</nav>