<?php
require_once('connection.php');
$idxUser = $_SESSION['idxUser'];
$order_id = $_SESSION['order_id'];
$dtrans = $conn->query("SELECT * From dtrans where order_id = '$order_id'")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['login'])) {
    // echo("test");
    header('Location:login.php');
    // http_redirect('login.php');
}

if(isset($_POST['back'])){
    header('Location: historyUser.php')
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

</head>

<body>
    <?php include('header.php'); ?>
    <div class="back">
        <!-- <button class="btn btn-primary" value="login" name="login">Login Now</button> -->
        <button class="btn btn-primary" value="back" name="back" ><< BACK</button>
    </div>
    <div class="container">
        <div class="text-dark my-3 font-weight-bold" style="font-size: 2em;">History Transaction</div>
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
                <tr>
                    <td colspan="3" class="font-weight-bold text-danger" style="text-align: right;">TOTAL</td>
                    <td class="font-weight-bold h5">Rp. <?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>