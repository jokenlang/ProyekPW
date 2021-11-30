<?php
require_once('connection.php');

if (isset($_POST['change'])) {
    $bulan = $_POST['bulan'];
} else {
    $bulan = 1;
}

$htrans = $conn->query("SELECT * From htrans where month(transaction_time) = '$bulan' order by transaction_time desc")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['detailOrder'])) {
    $_SESSION['order_id'] = $_POST['detailOrder'];
    header('Location:detailReportAdmin.php');
}
if (isset($_POST['logout'])) {
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="jquery-3.4.1.min.js"></script>
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

        <hr>
    </div>
    <div class="container my-4">
        <h2>Report by Month</h2>
        <form action="" method="POST">
            <div class="row">
                <select name="bulan" id="bulan" class="col-8 m-3 form-control">
                    <?php for ($i = 1; $i <= 12; $i++) {
                        if ($i == $bulan) { ?>
                            <option value="<?= $i ?>" selected><?= date("F", strtotime('00-' . $i . '-01')); ?></option>
                        <?php } else { ?>
                            <option value="<?= $i ?>"><?= date("F", strtotime('00-' . $i . '-01')); ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <button value="c" name="change" class="btn btn-info m-3 col-3">Change</button>
            </div>
        </form>
    </div>
    <div class="container my-4">
        <div class="row">
            <div id="dataBulan" class="col-12 col-lg-8">
                <?php $total_item = 0; ?>
                <?php $total_income = 0; ?>
                <?php if ($htrans != null) { ?>
                    <?php foreach ($htrans as $key => $value) { ?>
                        <div class="card my-2" style="border-radius: 20px;">
                            <div class="card-header bg-success text-light" style="border-radius: 20px;">
                                Order ID : <?= $value['order_id'] ?>
                            </div>
                            <div class="card-body">
                                <?php
                                $order_id = $value['order_id'];
                                $dtrans = $conn->query("SELECT * From dtrans where order_id = '$order_id'")->fetch_all(MYSQLI_ASSOC);
                                $total = count($dtrans);
                                $total_item += $total;
                                ?>
                                <h5 class="card-title">Total Items : <?= $total ?></h5>
                                <p class="card-text">Time : <?= $value['transaction_time'] ?></p>
                                <!-- <p class="card-text">Status : <?= strtoUpper($value['transaction_status']) ?></p> -->
                                <?php
                                $kode_user = $value['kode_user'];
                                $user = $conn->query("SELECT * From user where kode_user = '$kode_user'")->fetch_assoc();
                                $total_income += $value['gross_amount'];
                                ?>
                                <p class="card-text">Customer : <?= strtoUpper($user['nama_user']) ?></p>
                                <p class="card-text">Subtotal : <b> Rp. <?= number_format($value['gross_amount'], 0, '.', '.'); ?></b></p>
                                <form action="" method="post">
                                    <button name="detailOrder" value="<?= $value['order_id'] ?>" class="btn float-right text-dark" style="color: white;">Detail >> </button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <h3 class="text-secondary">No Transaction Found</h3>
                <?php } ?>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card my-4" style="background-color: lightgray;">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold my-2">Summary</h2>
                        <hr>
                        <div class="row my-4">
                            <div class="col-6 card-text text-left">Items sold : </div>
                            <div class="col-6 card-text text-right"><?= $total_item ?> Items</div>
                        </div>
                        <div class="row my-4">
                            <div class="col-6 card-text text-left">Total income : </div>
                            <div class="col-6 card-text text-right">Rp. <?= number_format($total_income, 0, '.', '.') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>