<?php
require_once('connection.php');
$cart = $_SESSION['cart'];
// print_r($cart);
// print_r($_SESSION['cart']);
if (isset($_POST['remove'])) {
    $key = $_POST['remove'];
    unset($_SESSION['cart'][$key]);
    unset($cart[$key]);
}

if (isset($_POST['tambahQty'])) {
    $key = $_POST['tambahQty'];
    $cart[$key]['qty']++;
    $_SESSION['cart'] = $cart;
}

if (isset($_POST['kurangiQty'])) {
    $key = $_POST['kurangiQty'];
    if ($cart[$key]['qty'] > 1) {
        $cart[$key]['qty']--;
        $_SESSION['cart'] = $cart;
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
    <h2>Cart</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Desc</th>
                <th scope="col">Qty</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($cart as $key => $value) { ?>
                <tr>
                    <td>
                        <img src="<?= $value['url_gambar'] ?>" alt="" style="width: 50px;height: 50px;">
                        <?= $value['nama_produk'] ?>
                    </td>
                    <td><?= $value['desc_produk'] ?></td>
                    <td>
                        <form action="" method="POST">
                            <button name="kurangiQty" value="<?= $key ?>">-</button>
                            <?= $value['qty'] ?>
                            <button name="tambahQty" value="<?= $key ?>">+</button>
                        </form>
                    </td>
                    <td><?= $value['qty'] * $value['harga_produk'] ?></td>
                    <td>
                        <form action="" method="POST">
                            <button value="<?= $key ?>" name="remove">Remove</button>
                        </form>
                    </td>
                    <?php $total += $value['qty'] * $value['harga_produk']; ?>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4">Total</td>
                <td><?= $total ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>