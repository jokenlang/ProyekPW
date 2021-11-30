<?php
require_once('connection.php');
$kategori = $conn->query("SELECT * From kategori")->fetch_all(MYSQLI_ASSOC);
$produk = $conn->query("SELECT * From produk LIMIT 10")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['pilihCat'])) {
    $_SESSION['idxKategori'] = $_POST['pilihCat'];
    header('Location:allProductfromCat.php');
}
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
            $cart[$key]['subtotal'] = $cart[$key]['qty'] * $cart[$key]['harga_produk'];
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
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .kategori {
            transition: 0.8s;
        }

        .kategori:hover {
            transform: skewY(3deg);
        }

        .scrolling-wrapper {
            overflow-x: auto;
        }
    </style>
</head>

<body class="bg-light">
    <?php include('header.php'); ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" style="height:700px" src="asset/imgSlide1.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block bg-dark mb-4">
                        <h5>Make your room better</h5>
                        <p>We prepare a good furniture to make your room comfortable</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" style="height:700px" src="asset/imgSlide2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block bg-dark mb-4">
                        <h5>High Quality and Quantity</h5>
                        <p>We are always use the best material</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" style="height:700px" src="asset/imgSlide3.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block bg-dark mb-4">
                        <h5>Best value price with Usability</h5>
                        <p>Our price are always consistent with the market and the quality of product</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev" id="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next" id="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="text-dark my-3 font-weight-bold" style="font-size: 2em;">Categories</div>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ($kategori as $key => $value) { ?>
                <form action="" method="POST" class="card col-12 col-md-4 my-4 kategori" style="border:none;background-color:transparent">
                    <button name="pilihCat" value="<?= $value['kode_kategori'] ?>">
                        <img class="card-img-top my-2" src="asset/cat<?= $key ?>.jpg" alt="Card image cap" style="border-radius: 100%;width:100%;height:250px">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $value['nama_kategori'] ?></h5>
                        </div>
                    </button>
                </form>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <div class="text-dark my-3 font-weight-bold" style="font-size: 2em;">Featured Products</div>
    </div>
    <div class="container mb-4">
        <div class="scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4 pt-2">
            <?php foreach ($produk as $key => $value) { ?>
                <div class='card col-12 col-md-3 m-4'>
                    <img class='card-img-top' src="<?= $value['url_gambar'] ?>" alt='Card image cap'>
                    <div class='card-body'>
                        <h5 class='card-title'><?= strtoUpper($value['nama_produk']) ?></h5>
                        <p class='card-text'><?= $value['desc_produk'] ?></p>
                        <p class='card-text font-weight-bold'>Rp. <?= number_format($value['harga_produk'], 0, '.', '.') ?></p>
                        <form method='post'>
                            <button href='#' class='btn btn-dark' value="<?= $value['kode_produk'] ?>" name='detail'>Detail</button>
                            <button href='#' class='btn btn-success' value="<?= $value['kode_produk'] ?>" name='add'>Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>