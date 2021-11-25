<?php
require_once('ahihi.php');
require_once('connection.php');
$produk = $conn->query("SELECT * From produk")->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['login'])) {
    // echo("test");
    header('Location:login.php');
    // http_redirect('login.php');
}
if (isset($_POST['add'])) {
    $kode_produk = $_POST['add'];
    $ketemu = false;
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($kode_produk == $value['kode_produk']) {
            $ketemu = true;
            $cart = $_SESSION['cart'];
            $cart[$key]['qty']++;
            $_SESSION['cart'] = $cart;
        }
    }
    if (!$ketemu) {
        $q = $conn->query("SELECT * FROM produk WHERE kode_produk='$kode_produk'");
        $produk = $q->fetch_assoc();
        $_SESSION['cart'][] = [
            'kode_produk' => $kode_produk,
            'nama_produk' => $produk['nama_produk'],
            'desc_produk' => $produk['desc_produk'],
            'harga_produk' => (int)($produk['harga_produk']),
            'url_gambar' => $produk['url_gambar'],
            'qty' => 1,
            'subtotal' => $produk['harga_produk']
        ];
    }
    header('Location:cart.php');
}

if (isset($_POST['detail'])) {
    $_SESSION['idxProduk'] = $_POST['detail'];
    header('Location:detailProduct.php');
}
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
    <?php include('header.php') ?>

    <div class="container">
        <span class="text-dark my-3 font-weight-bold" style="font-size: 2em;">Products</span>
        <form class="form-inline my-3" method="POST" style="float: right;">
            <!-- <input class="form-control mr-sm-2" style="float: right;" type="search" placeholder="Search" aria-label="Search" id="search">
            <button class="btn btn-primary my-2 my-sm-0" type="submit" name="searchName">Search</button> -->
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

    <?php include('footer.php') ?>

    <script>
        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url: "fetchFromCat.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        $('#dynamic_content').html(data);
                        // console.log(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search').val();
                load_data(page, query);
            });
        });
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> -->
</body>

</html>