<?php
require_once('connection.php');
$produk = $listUser = $conn->query("SELECT * From produk")->fetch_all(MYSQLI_ASSOC);
/*if (isset($_POST['searchName'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * From produk where nama_produk like'%$keyword%'";
    $hasil = mysqli_query($conn, $query);
}*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="jquery-3.4.1.min.js"></script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand bg-light px-2" href="#">
                    <img src="asset/logo.png" width="30" height="30" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-link active" href="allProduct.php">All Products</a>
                        <a class="nav-link" href="#">About Us</a>
                        <a class="nav-link" href="login.php">Log In</a>
                    </div>
                </div>
            </nav>
        </div>
    </nav>

    <div class="container">
        <span class="text-dark my-3 font-weight-bold" style="font-size: 2em;">Products</span>
        <form class="form-inline my-3" method="POST" style="float: right;">
            <input class="form-control mr-sm-2" style="float: right;" type="search" placeholder="Search" aria-label="Search" id="search">
            <button class="btn btn-primary my-2 my-sm-0" type="submit" name="searchName">Search</button>
        </form>
    </div>

    <!-- <div class="container">
        <div class="row">
            <?php foreach ($produk as $key => $value) { ?>
                <div class="card col-md-4" style="width: 18rem;">
                    <img class="card-img-top" src="<?= $value['url_gambar'] ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $value['nama_produk'] ?></h5>
                        <p class="card-text"><?= $value['desc_produk'] ?></p>
                        <a href="#" class="btn btn-primary" value="<?= $value['kode_produk'] ?>">Add to Cart</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div> -->

    <div class="table-responsive" id="dynamic_content">

    </div>



    <footer class="bg-dark text-center text-lg-start">
        <div class="text-center p-3 text-light" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-light" href="">220116900,220116922</a>
        </div>
    </footer>
    <script>
        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        $('#dynamic_content').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search').val();
                load_data(page, query);
            });

            $('#search').keyup(function() {
                var query = $('#search').val();
                load_data(1, query);
            });
        });
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> -->
</body>

</html>