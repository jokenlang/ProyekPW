<?php
require_once('ahihi.php');
require_once('connection.php');
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = null;
}
if (isset($_POST['login'])) {
    // echo("test");
    header('Location:login.php');
    // http_redirect('login.php');
}
if (isset($_POST['remove'])) {
    $key = $_POST['remove'];
    unset($_SESSION['cart'][$key]);
    unset($cart[$key]);
}

if (isset($_POST['tambahQty'])) {
    $key = $_POST['tambahQty'];
    if ($cart[$key]['qty'] < 9) {
        $cart[$key]['qty']++;
        $cart[$key]['subtotal'] = $cart[$key]['qty'] * $cart[$key]['harga_produk'];
        $_SESSION['cart'] = $cart;
    }
}

if (isset($_POST['kurangiQty'])) {
    $key = $_POST['kurangiQty'];
    if ($cart[$key]['qty'] > 1) {
        $cart[$key]['qty']--;
        $cart[$key]['subtotal'] = $cart[$key]['qty'] * $cart[$key]['harga_produk'];
        $_SESSION['cart'] = $cart;
    }
}

if (isset($_POST['checkout'])) {
    if (isset($_SESSION['idxUser'])) {
        header('Location:snap/checkout-process.php');
    } else {
        header('Location:login.php');
    }
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
</head>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <div class="h2 my-4">Cart</div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Merk</th>
                    <th scope="col">Desc</th>
                    <th scope="col-5">Qty</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php if ($cart != null) { ?>
                    <?php foreach ($cart as $key => $value) { ?>
                        <tr>
                            <td>
                                <img src="<?= $value['url_gambar'] ?>" alt="" style="width: 50px;height: 50px;">
                                <?= strtoUpper($value['nama_produk']) ?>
                            </td>
                            <td><?= $value['desc_produk'] ?></td>
                            <td>
                                <form action="" method="POST" class="row">
                                    <button name="kurangiQty" value="<?= $key ?>" class="btn btn-dark col-3 text-center">-</button>
                                    <button class="btn col-3 p-1"><?= $value['qty'] ?></button>
                                    <button name="tambahQty" value="<?= $key ?>" class="btn btn-dark col-3">+</button>
                                </form>
                            </td>
                            <td>Rp. <?= number_format($value['subtotal'], 0, '.', '.') ?></td>
                            <td>
                                <form action="" method="POST">
                                    <button class="btn btn-danger" value="<?= $key ?>" name="remove">Remove</button>
                                </form>
                            </td>
                            <?php $total += $value['subtotal']; ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <tr>
                    <td colspan="3" class="font-weight-bold text-danger" style="text-align:right">TOTAL</td>
                    <td colspan="2" class="font-weight-bold h5 text-left">Rp. <?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="text text-right">Total : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $total ?></div> -->

        <div class="container">
            <form action="" method="POST">
                <button id="pay-button" name="checkout" value="checkout" class="btn btn-dark float-right my-3">>> Checkout</button>
                <?php
                $_SESSION['total'] = $total;
                ?>
                <!-- <input type="hidden" name="amount" value="<?= $total ?>"> -->
            </form>
        </div>
        <div style="clear:both"></div>
    </div>

    <?php include('footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>

</html>