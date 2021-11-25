<?php
require_once('ahihi.php');
require_once('connection.php');

if (isset($_SESSION['idxProduk'])) {
    $idxProduk = $_SESSION['idxProduk'];
    $qty = 1;
} else {
    header('Location:allProduct.php');
}
$stmt = $conn->query("SELECT * FROM PRODUK WHERE kode_produk = '$idxProduk'");
$produk = $stmt->fetch_assoc();
$url = $produk['url_gambar'];
$nama = strtoUpper($produk['nama_produk']);
$desc = $produk['desc_produk'];
$harga = number_format($produk['harga_produk'], 0, '.', '.');

if (isset($_POST['tambahQty'])) {
    $qty = $_POST['qty'];
    $qty++;
} else if (isset($_POST['kurangiQty'])) {
    $qty = $_POST['qty'];
    if ($qty > 1) {
        $qty--;
    }
}

if (isset($_POST['add'])) {
    $kode_produk = $_POST['add'];
    $q = $conn->query("SELECT * FROM produk WHERE kode_produk='$kode_produk'");
    $produk = $q->fetch_assoc();
    $qty = $_POST['qty'];
    $_SESSION['cart'][] = [
        'kode_produk' => $kode_produk,
        'nama_produk' => $produk['nama_produk'],
        'desc_produk' => $produk['desc_produk'],
        'harga_produk' => (int)($produk['harga_produk']),
        'url_gambar' => $produk['url_gambar'],
        'qty' => $qty,
        'subtotal' => $produk['harga_produk']
    ];
    header('Location:cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .card-horizontal {
            display: flex;
            flex: 1 1 auto;
        }
    </style>
</head>

<body>
    <?php include('header.php') ?>

    <div class="container">
        <div class="card my-4 bg-dark">
            <div class="row text-light">
                <div class="img-square-wrapper col-12 col-md-6">
                    <img src="<?= $url ?>" alt="Card image cap" style="width:508px;height:508px">
                </div>
                <div class="card-body col-12 col-md-6 text-sm-center text-md-left" style="margin-top:150px; ">
                    <h4 class="card-title"><?= $nama ?></h4>
                    <p class="card-text"><?= $desc ?></p>
                    <p class="card-text h3 mb-4">Rp. <?= $harga ?></p>
                    <form action="" method="POST">
                        <input type="hidden" name="qty" value="<?= $qty ?>">
                        <button name="kurangiQty" value="<?= $qty ?>" class="btn btn-light">-</button>
                        <button class="btn  mx-0" style="color:white; background-color:transparent"><?= $qty ?></button>
                        <button name="tambahQty" value="<?= $qty ?>" class="btn btn-light">+</button>
                        <button class="btn btn-success ml-2" name="add" value="<?= $idxProduk ?>">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>