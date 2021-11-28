<?php
require_once('connection.php');
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
    <?php include('headerAdmin.php') ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Month</th>
                <th scope="col">Total items</th>
                <th scope="col">Last Month</th>
                <th scope="col">This Month</th>
                <th scope="col">Change</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 12; $i++) { ?>
                <tr>
                    <td><?= date("F", strtotime('00-' . $i . '-01')); ?></td>
                    <td>
                        <?php
                        $stmt = $conn->query("select sum(qty) as jumlah from dtrans d, htrans h where d.order_id = h.order_id and month(h.transaction_time) = '$i' group by month(h.transaction_time)");
                        $sum = $stmt->fetch_assoc();
                        if ($sum['jumlah'] == null) {
                            echo 0;
                        } else {
                            echo $sum['jumlah'];
                        }
                        ?>
                        Items
                    </td>
                    <td>

                    </td>
                </tr>
            <?php } ?>
            <!-- <?php
                    $total = 0;
                    $total_item = 0;
                    ?>
            <?php if ($cart != null) { ?>
                <?php foreach ($cart as $key => $value) { ?>
                    <tr>
                        <td>
                            <img src="<?= $value['url_gambar'] ?>" alt="" style="width: 50px;height: 50px;">
                            <?= strtoUpper($value['nama_produk']) ?>
                        </td>
                        <td class="d-none d-md-block"><?= $value['desc_produk'] ?></td>
                        <td><?= $value['qty'] ?></td>
                        <td>Rp. <?= number_format($value['subtotal'], 0, '.', '.') ?></td>
                        <?php $total += $value['subtotal']; ?>
                        <?php $total_item += $value['qty']; ?>
                    </tr>
                <?php } ?>
            <?php } ?>
            <tr>
                <td colspan="3" class="font-weight-bold text-danger" style="text-align:right">TOTAL</td>
                <td class="font-weight-bold h5">Rp. <?= number_format($total, 0, ',', '.') ?></td>
            </tr> -->
        </tbody>
    </table>

</body>

</html>