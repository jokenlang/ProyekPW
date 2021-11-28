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
    <div class="container">
        <h1 class="my-4 card-title text-center">Report in 2021</h1>
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
                            $stmt = $conn->query("select sum(qty) as item from dtrans d, htrans h where d.order_id = h.order_id and month(h.transaction_time) = '$i' group by month(h.transaction_time);");
                            $sum = $stmt->fetch_assoc();
                            if (isset($sum['item'])) {
                                echo $sum['item'];
                            } else {
                                echo 0;
                            }
                            ?>
                            Items
                        </td>
                        <td>
                            Rp.
                            <?php
                            if ($i == 1) {
                                echo 0;
                            } else {
                                $min = $i - 1;
                                $stmt = $conn->query("select d.qty, p.harga_produk from dtrans d,htrans h, produk p where d.order_id = h.order_id and d.kode_produk = p.kode_produk and month(h.transaction_time) = '$min'");
                                $detail = $stmt->fetch_all(MYSQLI_ASSOC);
                                $total = 0;
                                foreach ($detail as $value) {
                                    $total += ($value['qty'] * $value['harga_produk']);
                                }
                                echo number_format($total, 0, '.', '.');
                            }
                            ?>
                        </td>
                        <td>
                            Rp.
                            <?php
                            $stmt = $conn->query("select d.qty, p.harga_produk from dtrans d,htrans h, produk p where d.order_id = h.order_id and d.kode_produk = p.kode_produk and month(h.transaction_time) = '$i'");
                            $detail = $stmt->fetch_all(MYSQLI_ASSOC);
                            $total = 0;
                            foreach ($detail as $value) {
                                $total += ($value['qty'] * $value['harga_produk']);
                            }
                            echo number_format($total, 0, '.', '.');
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalLM = 0;
                            $totalTM = 0;
                            //last month
                            if ($i == 1) {
                                $totalLM = 0;
                            } else {
                                $min = $i - 1;
                                $stmt = $conn->query("select d.qty, p.harga_produk from dtrans d,htrans h, produk p where d.order_id = h.order_id and d.kode_produk = p.kode_produk and month(h.transaction_time) = '$min'");
                                $detail = $stmt->fetch_all(MYSQLI_ASSOC);
                                foreach ($detail as $value) {
                                    $totalLM += ($value['qty'] * $value['harga_produk']);
                                }
                            }
                            //this month
                            $stmt = $conn->query("select d.qty, p.harga_produk from dtrans d,htrans h, produk p where d.order_id = h.order_id and d.kode_produk = p.kode_produk and month(h.transaction_time) = '$i'");
                            $detail = $stmt->fetch_all(MYSQLI_ASSOC);
                            foreach ($detail as $value) {
                                $totalTM += ($value['qty'] * $value['harga_produk']);
                            }
                            if ($totalTM == 0 && $totalLM == 0) {
                                echo "<div class='text-success'>+ 0%</div>";
                            } else if ($totalTM > 0) {
                                if (floor(($totalTM - $totalLM) / $totalTM * 100) >= 100) {
                                    echo "<div class='text-success'>+ 100%</div>";
                                } else if (floor(($totalTM - $totalLM) / $totalTM * 100) <= -100) {
                                    echo "<div class='text-danger'>- 100%</div>";
                                } else {
                                    $change = floor(($totalTM - $totalLM) / $totalTM * 100);
                                    if ($change >= 0) {
                                        echo "<div class='text-success'>+ $change%</div>";
                                    } else {
                                        "<div class='text-danger'>- $change%</div>";
                                    }
                                }
                            } else {
                                $totalTM = 1;
                                if (floor(($totalTM - $totalLM) / $totalTM * 100) >= 100) {
                                    echo "<div class='text-success'>+ 100%</div>";
                                } else if (floor(($totalTM - $totalLM) / $totalTM * 100) <= -100) {
                                    echo "<div class='text-danger'>- 100%</div>";
                                } else {
                                    $change = floor(($totalTM - $totalLM) / $totalTM * 100);
                                    if ($change >= 0) {
                                        echo "<div class='text-success'>+ $change%</div>";
                                    } else {
                                        "<div class='text-danger'>- $change%</div>";
                                    }
                                }
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    

</body>

</html>