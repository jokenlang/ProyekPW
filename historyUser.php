<?php
require_once('connection.php');
$idxUser = $_SESSION['idxUser'];
$htrans = $conn->query("SELECT * From htrans where kode_user = '$idxUser' order by transaction_time desc")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['detailOrder'])) {
    $_SESSION['order_id'] = $_POST['detailOrder'];
    header('Location:detailHistoryUser.php');
}

if (isset($_POST['login'])) {
    header('Location: login.php');
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
    <div class="container">
        <div class="text-dark my-3 font-weight-bold" style="font-size: 2em;">History Transaction</div>
    </div>
    <form action="" method="post">
        <div class="container">
            <?php if ($htrans != null) { ?>
                <?php foreach ($htrans as $key => $value) { ?>
                    <div class="card my-2" style="border-radius: 20px;">
                        <?php if (strtoUpper($value['transaction_status']) == "PENDING") { ?>
                            <div class="card-header bg-danger text-light" style="border-radius:18px;">
                            <?php } else if (strtoUpper($value['transaction_status']) == "EXPIRE") { ?>
                                <div class="card-header bg-dark text-light" style="border-radius:18px;">
                                <?php } else { ?>
                                    <div class="card-header bg-success text-light" style="border-radius:18px;">
                                    <?php } ?>
                                    Order ID : <?= $value['order_id'] ?>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $order_id = $value['order_id'];
                                        $dtrans = $conn->query("SELECT * From dtrans where order_id = '$order_id'")->fetch_all(MYSQLI_ASSOC);
                                        $total = count($dtrans);
                                        ?>
                                        <h5 class="card-title">Total Items : <?= $total ?></h5>
                                        <p class="card-text">Time : <?= $value['transaction_time'] ?></p>
                                        <?php
                                        $arrayVA = json_decode($value['va_number'], true);
                                        $bank = strtoUpper($arrayVA[0]['bank']);
                                        $va_number = $arrayVA[0]['va_number'];
                                        ?>
                                        <p class="card-text">Bank : <?= $bank ?></p>
                                        <p class="card-text">Virtual Account Number : <?= $va_number ?></p>
                                        <p class="card-text">Status : <?= strtoUpper($value['transaction_status']) ?></p>
                                        <p class="card-text">Subtotal : <b> Rp. <?= number_format($value['gross_amount'], 0, '.', '.') ?></b></p>
                                        <button name="detailOrder" value="<?= $value['order_id'] ?>" class="btn float-right text-dark" style="color: white;">Detail >> </button>
                                        <?php if (strtoUpper($value['transaction_status']) == "PENDING") { ?>
                                            <a href="https://simulator.sandbox.midtrans.com/bca/va/index" class="btn btn-info float-right" target="_blank">Pay Now</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                            </div>
    </form>

    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>