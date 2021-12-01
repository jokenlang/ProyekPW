<?php
require_once('connection.php');
$idxUser = $_SESSION['idxUser'];
$order_id = $_SESSION['order_id'];
$dtrans = $conn->query("SELECT * From dtrans where order_id = '$order_id'")->fetch_all(MYSQLI_ASSOC);
$htrans = $conn->query("SELECT * From htrans h,user u where h.kode_user = u.kode_user and order_id = '$order_id'")->fetch_assoc();
$arrayVA = json_decode($htrans['va_number'], true);
if (isset($_POST['login'])) {
    // echo("test");
    header('Location:login.php');
    // http_redirect('login.php');
}
if (isset($_POST['logout'])) {
    unset($_SESSION['idxUser']);
    unset($_SESSION['cart']);
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>
    <?php include('header.php'); ?>


    <div class="container font-weight-bold">
        <a href="historyUser.php">
            <button type="button" value="back" class="btn btn-light" style="margin-top:25px; background-color:transparent">
                << BACK</button>
        </a>
        <div class="text-dark my-3 h2" style="font-size: 2em;">History Transaction</div>
        <div class="text-dark mb-3 card-text">Order ID : <?= $order_id ?></div>
        <div class="text-dark mb-3 card-text">Time : <?= $htrans['transaction_time'] ?></div>
        <div class="text-dark mb-3 card-text">Bank : <?= strtoUpper($arrayVA[0]['bank']) ?></div>
        <div class="text-dark mb-3 card-text">Virtual Account Number : <?= $arrayVA[0]['va_number'] ?></div>
        <div class="text-dark mb-3 card-text">Customer : <?= strtoUpper($htrans['nama_user']) ?></div>
    </div>

    <div class="container">
        <table class="table">
            <thead class="bg-info text-light">
                <tr>
                    <th scope="col">MERK</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php if ($dtrans != null) { ?>
                    <?php foreach ($dtrans as $key => $value) { ?>
                        <?php
                        $kode_produk = $value['kode_produk'];
                        $stmt = $conn->query("SELECT * FROM produk WHERE kode_produk = '$kode_produk'");
                        $produk = $stmt->fetch_assoc();
                        ?>
                        <tr>
                            <td>
                                <img src="<?= $produk['url_gambar'] ?>" alt="" style="width: 50px;height: 50px;">
                                <?= strtoUpper($produk['nama_produk']) ?>
                            </td>
                            <td><?= $produk['desc_produk'] ?></td>
                            <td><?= $value['qty'] ?></td>
                            <?php $subtotal = $value['qty'] * $produk['harga_produk'] ?>
                            <td>Rp. <?= number_format($subtotal, 0, '.', '.') ?></td>
                            <?php $total += $subtotal; ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <div class="text-right h3 mb-3"><b class=" text-danger">Total : </b> Rp. <?= number_format($total, 0, ',', '.') ?></div>
    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>